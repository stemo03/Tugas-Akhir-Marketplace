<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\Auth;
// use App\Http\Controllers\HomeController;
// use App\Http\Controllers\CategoryController;
// use App\Http\Controllers\DetailController;
// use App\Http\Controllers\CartController;
// use App\Http\Controllers\Auth\RegisterController;
// use App\Http\Controllers\DashboardController;
// use App\Http\Controllers\DashboardProductController;
// use App\Http\Controllers\DashboardTransactionController;
// use App\Http\Controllers\DashboardSettingController;

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
Auth::routes(['verify'=>true]);

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/call', [App\Http\Controllers\HomeController::class, 'callcenter'])->name('callcanter');
Route::get('/profil', [App\Http\Controllers\HomeController::class, 'profil'])->name('profil');


Route::get('/categories', [App\Http\Controllers\CategoryController::class, 'index'])->name('categories');
Route::get('/categories/{id}', [App\Http\Controllers\CategoryController::class, 'detail'])->name('categories-detail');

Route::get('/details/{id}', [App\Http\Controllers\DetailController::class, 'index'])->name('detail');
Route::post('/details/{id}', [App\Http\Controllers\DetailController::class, 'add'])->name('detail-add');

Route::get('/success', [App\Http\Controllers\CartController::class, 'success'])->name('success');

// Route::post('/checkout/callback', [App\Http\Controllers\CheckoutController::class, 'callback'])
//     ->name('midtrans-callback');







Route::group(['middleware' => ['auth','verified']], function () {
    Route::get('/successRegister', [ App\Http\Controllers\Auth\RegisterController::class, 'success'])
    ->name('register-success');

    Route::get('/success', [App\Http\Controllers\CartController::class, 'success'])->name('success');
    Route::get('/cart', [App\Http\Controllers\CartController::class, 'index'])->name('cart');
    Route::delete('/cart/{id}', [App\Http\Controllers\CartController::class,'delete'])
        ->name('cart-delete');    

    Route::post('/checkout', [App\Http\Controllers\CheckoutController::class, 'process'])->name('checkout');

    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    Route::get('/dashboard/products', [App\Http\Controllers\DashboardProductController::class, 'index'])    
        ->name('dashboard-product');
    Route::post('/dashboard/products', [App\Http\Controllers\DashboardProductController::class, 'store'] )
        ->name('dashboard-product-store');
    Route::get('/dashboard/products/create', [App\Http\Controllers\DashboardProductController::class, 'create']) ->name('dashboard-product-create');

    Route::get('/dashboard/products/{id}', [App\Http\Controllers\DashboardProductController::class, 'details'])
        ->name('dashboard-product-details');
    Route::post('/dashboard/products/{id}', [App\Http\Controllers\DashboardProductController::class, 'update'])
        ->name('dashboard-product-update');

    Route::post('/dashboard/products/gallery/upload', [App\Http\Controllers\DashboardProductController::class, 'uploadGallery'])
        ->name('dashboard-product-gallery-upload');

    Route::get('/dashboard/products/gallery/delete/{id}',[App\Http\Controllers\DashboardProductController
    ::class, 'deleteGallery'])
        ->name('dashboard-product-gallery-delete');


    Route::get('/dashboard/transactions', [App\Http\Controllers\DashboardTransactionController::class, 'index'])
        ->name('dashboard-transaction');
    Route::get('/dashboard/transactions/{id}', [App\Http\Controllers\DashboardTransactionController::class, 'details'])
        ->name('dashboard-transaction-details');
    Route::post('/dashboard/transactions/{id}', [App\Http\Controllers\DashboardTransactionController::class,'update'])
        ->name('dashboard-transaction-update');

    Route::get('/dashboard/settings', [App\Http\Controllers\DashboardSettingController::class, 'store'])
        ->name('dashboard-settings-store');
    Route::get('/dashboard/account', [App\Http\Controllers\DashboardSettingController::class, 'account'])
        ->name('dashboard-settings-account');
    Route::post('/dashboard/update/{redirect}', [App\Http\Controllers\DashboardSettingController::class, 'update'])
        ->name('dashboard-settings-redirect');

    Route::get('/print', [App\Http\Controllers\DashboardController::class, 'print'])->name('print');
    Route::get('/shop/{id}', [App\Http\Controllers\DetailController::class, 'shop'])->name('shop');

    Route::POST('comentar-user',[App\Http\Controllers\Admin\ProductController::class,'comment'])->name('commentar');

    Route::post('/cart-dec/{id}', [App\Http\Controllers\CartController::class,'decrement'])
        ->name('dec');
Route::post('/cart-in/{id}', [App\Http\Controllers\CartController::class,'increment'])
        ->name('in');
});


Route::prefix('admin')
                ->namespace('Admin')
                ->middleware(['auth','admin'])
                ->group(function(){
    Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin-dashboard');
    // Route::get('/print', [App\Http\Controllers\Admin\TransactionController::class, 'print'])->name('print_admin');
    // Route::resource('category', 'App\Http\Controllers\Admin\CategoryController@index');
    Route::resource('category','\App\Http\Controllers\Admin\CategoryController');
    Route::resource('blog','\App\Http\Controllers\Admin\BlogController');
    Route::resource('user','\App\Http\Controllers\Admin\UserController');
    Route::resource('product','\App\Http\Controllers\Admin\ProductController');
    Route::resource('product-gallery','\App\Http\Controllers\Admin\ProductGalleryController'); 
    Route::resource('transaction', '\App\Http\Controllers\Admin\TransactionController');
    Route::resource('print', '\App\Http\Controllers\Admin\PrintController');
});
Auth::routes();


