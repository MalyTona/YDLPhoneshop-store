<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Livewire\Partials\Navbar;
use App\Models\Product;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Product Detail - YDLPhonesop')]
class ProductDetailPage extends Component
{
    public $slug;
    public $quantity = 1;

    public function mount($slug)
    {
        $this->slug = $slug;
    }

    public function increaseQty()
    {
        if ($this->quantity < 99) {
            $this->quantity++;
        }
    }
    public function DecreaseQty()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }
    // add product to cart method
    public function addToCart($product_id)
    {
        $total_count = CartManagement::addItemsToCartWithQty($product_id, $this->quantity);

        $this->dispatch('update-cart-count', total_count: $total_count)->to(Navbar::class);
        LivewireAlert::title('បានបន្ថែមទៅកន្ត្រកដោយជោគជ័យ')
            ->text('ផលិតផលរបស់អ្នកត្រូវបានបន្ថែមទៅក្នុងកន្ត្រក។')
            ->position('bottom-end')
            ->timer(3000)
            ->success()
            ->toast()
            ->show();
    }
    public function addToWishlist($productSlug)
    {
        $product = Product::where('slug', $productSlug)->firstOrFail();

        // Add your wishlist logic here
        // Example: 
        // $wishlist = session()->get('wishlist', []);
        // $wishlist[$product->id] = $product->id;
        // session()->put('wishlist', $wishlist);

        session()->flash('message', 'ផលិតផលត្រូវបានបន្ថែមទៅបញ្ជីចង់បានដោយជោគជ័យ!');
    }

    public function render()
    {
        return view('livewire.product-detail-page', [
            'product' => Product::with(['category', 'brand'])
                ->where('slug', $this->slug)
                ->firstOrFail(),
        ]);
    }
}
