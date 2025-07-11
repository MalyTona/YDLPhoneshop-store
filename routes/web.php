<?php

use App\Livewire\Auth\ForgotPassword;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Auth\ResetPassword;
use App\Livewire\CancelPage;
use App\Livewire\HomePage;
use App\Livewire\CategoryPage;
use App\Livewire\ProductsPage;
use App\Livewire\CartPage;
use App\Livewire\ProductDetailPage;
use App\Livewire\CheckoutPage;
use App\Livewire\MyOrderDetailPage;
use App\Livewire\MyOrdersPage;
use App\Livewire\SearchPage;
use App\Livewire\SuccessPage;
use Illuminate\Support\Facades\Route;

//route for search
Route::get('/search', SearchPage::class)->name('search');

Route::get('/', HomePage::class);
Route::get('/categories', CategoryPage::class);
Route::get('/products', ProductsPage::class);
Route::get('/cart', CartPage::class);
Route::get('/products/{slug}', ProductDetailPage::class);


Route::get('/checkout', CheckoutPage::class);
Route::get('/my-orders', MyOrdersPage::class);
Route::get('/my-orders/{order}', MyOrderDetailPage::class);

//auth route
Route::get('/login', Login::class);
Route::get('/register', Register::class);
Route::get('/forgot', ForgotPassword::class);
Route::get('/reset', ResetPassword::class);

//suc and cancel route
Route::get('/success', SuccessPage::class);
Route::get('/cancel', CancelPage::class);
