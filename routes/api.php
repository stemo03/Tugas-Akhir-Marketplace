<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
//Route::get('register/check','\App\Http\Controllers\Auth\RegisterController@check')->name('api-register-check');
Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'check'])
    ->name('api-register-check');


Route::get('provinces', [App\Http\Controllers\API\LocationController::class,'provinces'])
    ->name('api-provinces');
Route::get('regencies/{provinces_id}', [App\Http\Controllers\API\LocationController::class,'regencies'])
    ->name('api-regencies');

Route::post('/checkout/callback', [App\Http\Controllers\CheckoutController::class, 'callback'])
    ->name('midtrans-callback');
