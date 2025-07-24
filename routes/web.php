<?php

use App\Http\Controllers\InvoiceController;
use App\Livewire\AboutPage;
use App\Livewire\Auth\ForgotPassword;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Auth\ResetPassword;
use App\Livewire\BlogPage;
use App\Livewire\CancelPage;
use App\Livewire\HomePage;
use App\Livewire\CategoryPage;
use App\Livewire\PostDetailPage;
use App\Livewire\ProductsPage;
use App\Livewire\CartPage;
use App\Livewire\ProductDetailPage;
use App\Livewire\CheckoutPage;
use App\Livewire\MyAccount;
use App\Livewire\MyOrderDetailPage;
use App\Livewire\MyOrdersPage;
use App\Livewire\SearchPage;
use App\Livewire\SuccessPage;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

//route for search
Route::get('/search', SearchPage::class)->name('search');

Route::get('/', HomePage::class);
Route::get('/categories', CategoryPage::class);
Route::get('/products', ProductsPage::class);
Route::get('/cart', CartPage::class);
Route::get('/products/{slug}', ProductDetailPage::class);


Route::get('/invoice/download/{order}', [InvoiceController::class, 'download'])->name('invoice.download')->middleware('auth');
Route::get('/about-us', AboutPage::class)->name('about');
Route::get('/blog', BlogPage::class)->name('blog');
Route::get('/blog/{slug}', PostDetailPage::class)->name('post.detail');
// middleware guest
Route::middleware('guest')->group(function () {
    //auth route
    Route::get('/login', Login::class)->name('login');
    Route::get('/register', Register::class);
    Route::get('/forgot', ForgotPassword::class)->name('password.request');
    Route::get('/reset/{token}', ResetPassword::class)->name('password.reset');
});

// middleware login user
Route::middleware('auth')->group(function () {
    Route::get('/logout', function () {

        Auth::logout();
        return redirect('/');
    });

    Route::get('/checkout', CheckoutPage::class);
    Route::get('/my-orders', MyOrdersPage::class);
    Route::get('/my-orders/{order_id}', MyOrderDetailPage::class)->name('my-orders.show');
    Route::get('/my-account', MyAccount::class)->middleware('auth')->name('my-account');
    //suc and cancel route
    Route::get('/success', SuccessPage::class)->name('success');
    Route::get('/cancel', CancelPage::class)->name('cancel');
});
