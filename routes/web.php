<?php

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
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes();



Route::namespace('Front')->group(function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::resource('category', 'CategoryController');
    Route::resource('cart', 'CartController');
    Route::resource('product', 'ProductController');

    Route::get("category/{slug}", 'CategoryController@getCategory')->name('front.category.slug');
    Route::get("{product}", 'ProductController@show')->name('front.get.product');
    Route::get("product/{slug}", 'ProductController@getProduct')->name('front.product.slug');
});
