<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use App\Helpers\CartManagement;
use App\Livewire\Partials\Navbar;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

#[Title('Search Results - YDLPhoneshop')]
class SearchPage extends Component
{
    use WithPagination;

    #[Url(as: 'q', keep: true)]
    public $search = '';

    #[Url()]
    public $selected_categories = [];

    #[Url()]
    public $selected_brands = [];

    #[Url()]
    public $featured;

    #[Url()]
    public $on_sale;

    #[Url()]
    public $in_stock;

    #[Url()]
    public $price_range = 2000;

    #[Url()]
    public $sort = 'relevance';

    public function mount()
    {
        // Get the search query from URL parameter
        $this->search = request('q', '');
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedSelectedCategories()
    {
        $this->resetPage();
    }

    public function updatedSelectedBrands()
    {
        $this->resetPage();
    }

    public function updatedFeatured()
    {
        $this->resetPage();
    }

    public function updatedOnSale()
    {
        $this->resetPage();
    }

    public function updatedInStock()
    {
        $this->resetPage();
    }

    public function updatedPriceRange()
    {
        $this->resetPage();
    }

    public function updatedSort()
    {
        $this->resetPage();
    }

    public function clearFilters()
    {
        $this->selected_categories = [];
        $this->selected_brands = [];
        $this->featured = null;
        $this->on_sale = null;
        $this->in_stock = null;
        $this->price_range = 2000;
        $this->sort = 'relevance';
        $this->resetPage();
    }

    public function addToCart($product_id)
    {
        $total_count = CartManagement::addItemsToCart($product_id);

        $this->dispatch('update-cart-count', total_count: $total_count)->to(Navbar::class);

        LivewireAlert::title('បានបន្ថែមទៅកន្ត្រកដោយជោគជ័យ')
            ->text('ផលិតផលរបស់អ្នកត្រូវបានបន្ថែមទៅក្នុងកន្ត្រក។')
            ->position('bottom-end')
            ->timer(3000)
            ->success()
            ->toast()
            ->show();
    }

    public function render()
    {
        $products = collect();
        $totalResults = 0;

        if (!empty($this->search)) {
            // Start with search query
            $productQuery = Product::query()
                ->where('is_active', 1)
                ->where(function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('description', 'like', '%' . $this->search . '%')
                        ->orWhere('slug', 'like', '%' . $this->search . '%');
                });

            // Apply category filter
            if (!empty($this->selected_categories)) {
                $productQuery->whereIn('category_id', $this->selected_categories);
            }

            // Apply brand filter
            if (!empty($this->selected_brands)) {
                $productQuery->whereIn('brand_id', $this->selected_brands);
            }

            // Featured filter
            if ($this->featured) {
                $productQuery->where('is_featured', 1);
            }

            // On sale filter
            if ($this->on_sale) {
                $productQuery->where('on_sale', 1);
            }

            // In stock filter
            if ($this->in_stock) {
                $productQuery->where('in_stock', 1);
            }

            // Price range filter
            if ($this->price_range) {
                $productQuery->whereBetween('price', [0, $this->price_range]);
            }

            // Apply sorting
            if ($this->sort == 'latest') {
                $productQuery->latest();
            } elseif ($this->sort == 'highest_price') {
                $productQuery->orderBy('price', 'desc');
            } elseif ($this->sort == 'lowest_price') {
                $productQuery->orderBy('price', 'asc');
            } elseif ($this->sort == 'a_z_name') {
                $productQuery->orderBy('name', 'asc');
            } elseif ($this->sort == 'z_a_name') {
                $productQuery->orderBy('name', 'desc');
            } else { // relevance (default)
                $productQuery->orderByRaw("
                    CASE 
                        WHEN name LIKE ? THEN 1
                        WHEN name LIKE ? THEN 2
                        WHEN description LIKE ? THEN 3
                        ELSE 4
                    END
                ", [
                    $this->search . '%',
                    '%' . $this->search . '%',
                    '%' . $this->search . '%'
                ]);
            }

            $totalResults = $productQuery->count();
            $products = $productQuery->paginate(6);
        }

        return view('livewire.search-page', [
            'products' => $products,
            'totalResults' => $totalResults,
            'brands' => Brand::where('is_active', 1)->get(['id', 'name', 'slug']),
            'categories' => Category::where('is_active', 1)->get(['id', 'name', 'slug']),
        ]);
    }
}
