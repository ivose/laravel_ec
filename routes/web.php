<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
Route::get('/b1', fn () => view('layouts/base1'));

Route::get('/', function () {
    return view('layouts/base');
});
*/

Route::get('/', \App\Http\Livewire\HomeComponent::class)->name('home');
Route::get('/shop', \App\Http\Livewire\ShopComponent::class)->name('get.shop');
Route::get('/cart', \App\Http\Livewire\CartComponent::class)->name('get.cart');
Route::get('/checkout', \App\Http\Livewire\CheckoutComponent::class)->name('get.checkout');
Route::get('/product/{slug}', \App\Http\Livewire\DetailsComponent::class)->name('product.details');

/*
v1, v2.
composer create-project --prefer-dist laravel/laravel ecommerce; cd ecommerce
composer require livewire/livewire; db paika;

//https://www.youtube.com/playlist?list=PLz_YkiqIHesvWMGfavV8JFDQRJycfHUvD
väljapoole pea div'i ei saa panna <!--..--> komme
v3:composer require laravel/Jetstream; php artisan jetstream:install livewire;npm install; npm run dev;
PA make:middleware AuthAdmmin; kelneris routemiddlewarele authadmin
//RouteServiceProvideris Home='/';
/vendor/laravel/fortify/src/action/AttemptToAuth::attempt if(quard..):
    if (Auth::user()->utype === 'ADM') {
                session(['utype' => 'ADM']);
                return redirect(RouteServiceProvider::HOME);
            } elseif (Auth::user()->utype === 'USR') {
                session(['utype' => 'USR']);
                return redirect(RouteServiceProvider::HOME);
            }
make:livewire admin/AdminDashboardComponen;...UserDashboardComponen

v82:
PAM:model Category/Product -m, teha migrades veerud, PAM:factory [Category,Model]Factory --model=(C/P)
Vastavad faktorid teha, ja databaseseedris need sisse lülitada ja siis PA db:seed
v83 PAM:livewire DetailComponent
v84 composer require hardevine/shoppingchart config/app: providers>Gloudemans\Shoppingcart\ShoppingcartServiceProvider::class, aliases>'Cart' => \Gloudemans\Shoppingcart\Cart::class,
PA vendor:publish --provider="Gloudemans\Shoppingcart\ShoppingcartServiceProvider" --tag="config"
*/


//Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//    return view('dashboard');
//})->name('dashboard');

Route::middleware('auth:sanctum', 'verified')->group(function () {
    Route::get('/user/dashboard', \App\Http\Livewire\User\UserDashboardComponent::class)->name('user.dashboard');
});
Route::middleware('auth:sanctum', 'verified', 'authadmin')->group(function () {
    Route::get('/admin/dashboard', \App\Http\Livewire\Admin\AdminDashboardComponent::class)->name('admin.dashboard');
});
