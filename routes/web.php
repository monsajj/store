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


Route::get('/logout', 'Auth\LoginController@logout');
Route::get('/login', 'Auth\LoginController@showLoginForm');
Route::get('/register', 'Auth\RegisterController@register');
Auth::routes();

Route::namespace('Front')->group(function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/locale/{locale}', 'HomeController@setLocale')->name('set.locale');
    Route::resource('category', 'CategoryController');
    Route::resource('product', 'ProductController');

//    Route::get('/product/{product}', 'ProductController@show')->name('product.show');

    Route::get('/cart', 'CartController@index')->name('cart.index');
    Route::get('/cart', 'CartController@show')->name('cart.show')->middleware('empty.cart');

    Route::post('/cart', 'CartController@store')->name('cart.store');
    Route::get('/cart/clear', 'CartController@clear')->name('cart.clear');
    Route::get('/cart/delete/{id}', 'CartController@delete')->name('cart.delete');

    Route::post('/comment', 'CommentController@store')->name('comment.store');

});
