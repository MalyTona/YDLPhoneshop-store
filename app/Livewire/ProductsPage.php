<?php

namespace App\Livewire;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Products - YDLPhoneshop')]
class ProductsPage extends Component
{
    use WithPagination;

    #[Url()]
    public $selected_categories = [];

    #[Url()]
    public $selected_brands = [];

    //is_featured
    #[Url()]
    public $featured;

    //on_sale
    #[Url()]
    public $on_sale;

    //in_stock
    #[Url()]
    public $in_stock;

    //price_rang
    #[Url()]
    public $price_range = 2000;

    //sort
    #[Url()]
    public $sort;

    public function render()
    {
        $productQuery = Product::query()->where('is_active', 1);
        //click filter by category
        if (!empty($this->selected_categories)) {
            $productQuery->whereIn('category_id', $this->selected_categories);
        }
        //click filter by product
        if (!empty($this->selected_brands)) {
            $productQuery->whereIn('brand_id', $this->selected_brands);
        }

        //បើផលិតផលពេញនិយម​ filter | is_featured filter
        if ($this->featured) {
            $productQuery->where('is_featured', 1);
        }
        //on_sale filter
        if ($this->on_sale) {
            $productQuery->where('on_sale', 1);
        }
        //in_stock filter
        if ($this->in_stock) {
            $productQuery->where('in_stock', 1);
        }

        //query get price_range
        if ($this->price_range) {
            $productQuery->whereBetween('price', [0, $this->price_range]);
        }

        // Sort
        if ($this->sort == 'latest') {
            $productQuery->latest(); // equivalent to orderBy('created_at', 'desc')
        }

        if ($this->sort == 'highest_price') {
            $productQuery->orderBy('price', 'desc');
        }

        if ($this->sort == 'lowest_price') {
            $productQuery->orderBy('price', 'asc');
        }

        if ($this->sort == 'a_z_name') {
            $productQuery->orderBy('name', 'asc');
        }

        if ($this->sort == 'z_a_name') {
            $productQuery->orderBy('name', 'desc');
        }

        return view('livewire.products-page', [
            'products' => $productQuery->paginate(6),
            'brands' => Brand::where('is_active', 1)->get(['id', 'name', 'slug']),
            'categories' => Category::where('is_active', 1)->get(['id', 'name', 'slug']),
        ]);
    }
}
