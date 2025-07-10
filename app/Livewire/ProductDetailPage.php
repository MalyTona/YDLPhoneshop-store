<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Product Detail - YDLPhonesop')]
class ProductDetailPage extends Component
{
    public $slug;


    public function mount($slug)
    {
        $this->slug = $slug;
    }

    public function addToCart($productSlug)
    {
        $product = Product::where('slug', $productSlug)->firstOrFail();

        // Check if product is available
        if (!$product->is_active || !$product->in_stock) {
            session()->flash('error', 'ផលិតផលនេះមិនអាចបន្ថែមទៅកន្ត្រកបានទេ។');
            return;
        }

        // Add your cart logic here
        // Example: 
        // $cart = session()->get('cart', []);
        // $cart[$product->id] = [
        //     'name' => $product->name,
        //     'price' => $product->price,
        //     'quantity' => 1,
        //     'image' => $product->images[0] ?? null
        // ];
        // session()->put('cart', $cart);

        session()->flash('message', 'ផលិតផលត្រូវបានបន្ថែមទៅកន្ត្រកដោយជោគជ័យ!');
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
