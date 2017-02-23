<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Sellers
Route::get('sellers', 'SellerController@index');
Route::get('sellers/{seller_id}','SellerController@show');
Route::post('sellers','SellerController@store');
Route::post('sellers/{seller_id}/address', 'SellerController@attach_address_seller');
Route::put('sellers/{seller_id}','SellerController@update');
Route::patch('sellers/{seller_id}','SellerController@update');
Route::delete('sellers/{seller_id}','SellerController@destroy');

//Address
Route::post('addresses', 'SellerAddressController@store');

//Product
Route::get('products', 'ProductController@index');
Route::get('products/{id}', 'ProductController@show');
Route::post('products', 'ProductController@store');
Route::put('products/{id}', 'ProductController@update');
Route::patch('products/{id}', 'ProductController@update');
Route::post('products/{id}/reviews', 'ProductController@addReview');
Route::delete('products/{id}', 'ProductController@destroy');

//Reviews
Route::get('products/{id}/reviews', 'ReviewsController@show');
Route::get('reviews', 'ReviewsController@index');
Route::delete('reviews/{id}', 'ReviewsController@destroy');









