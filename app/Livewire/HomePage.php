<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Livewire\Partials\Navbar;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ContactInfo;
use App\Models\Product;
use Livewire\Attributes\Title;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;


#[Title('Homepage - YDLPhoneshop')]

class HomePage extends Component

{
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
        $brands = Brand::where('is_active', 1)->get();
        $categories = Category::where('is_active', 1)->get();
        $contactInfo = ContactInfo::firstOrFail();

        // Add new queries for featured and on-sale products
        $featuredProducts = Product::where('is_active', true)
            ->where('is_featured', true)
            ->take(4)
            ->get();

        $onSaleProducts = Product::where('is_active', true)
            ->where('on_sale', true)
            ->take(4)
            ->get();
        return view('livewire.home-page', [
            'brands' => $brands,
            'categories' => $categories,
            'contactInfo' => $contactInfo,
            'featuredProducts' => $featuredProducts,
            'onSaleProducts' => $onSaleProducts,
        ]);
    }
}
