<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: origin, x-requested-with, content-type, Authorization');
header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS');
header('Access-Control-Expose-Headers: remaining');

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

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

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware(['auth:api','scope:user,admin']);

Route::get('/categories', 'CategoryController@index');

Route::get('/categories/{id}', 'CategoryController@show');

Route::get('/categories/accessories/{id}', 'CategoryController@show');

Route::post('/categories', 'CategoryController@store')
    ->middleware(['auth:api','scope:admin']);

Route::put('/categories/{id}', 'CategoryController@update')
    ->middleware(['auth:api','scope:admin']);

Route::delete('/categories/{id}', 'CategoryController@remove')
    ->middleware(['auth:api','scope:admin']);



Route::get('/makers', 'MakerController@index');

Route::get('/makers/{id}', 'MakerController@show');

Route::post('/makers', 'MakerController@store')
    ->middleware(['auth:api','scope:admin']);

Route::put('/makers/{id}', 'MakerController@update')
    ->middleware(['auth:api','scope:admin']);

Route::delete('/makers/{id}', 'MakerController@remove')
    ->middleware(['auth:api','scope:admin']);


Route::get('/media', 'MediaController@index');

Route::get('/media/{id}', 'MediaController@show');

Route::post('/media', 'MediaController@store')
    ->middleware(['auth:api','scope:admin']);

Route::put('/media/{id}', 'MediaController@update')
    ->middleware(['auth:api','scope:admin']);

Route::delete('/media/{id}', 'MediaController@remove')
    ->middleware(['auth:api','scope:admin']);


Route::get('/tags', 'TagController@index');

Route::get('/tags/{id}', 'TagController@show');

Route::post('/tags', 'TagController@store')
    ->middleware(['auth:api','scope:admin']);

Route::put('/tags/{id}', 'TagController@update')
    ->middleware(['auth:api','scope:admin']);

Route::delete('/tags/{id}', 'TagController@remove')
    ->middleware(['auth:api','scope:admin']);


Route::get('/products', 'ProductController@index');

Route::get('/products/{id}', 'ProductController@show');

Route::post('/products', 'ProductController@store')
    ->middleware(['auth:api','scope:admin']);

Route::put('/products/{id}', 'ProductController@update')
    ->middleware(['auth:api','scope:admin']);

Route::delete('/products/{id}', 'ProductController@remove')
    ->middleware(['auth:api','scope:admin']);




Route::get('/me', 'CustomerController@index')
    ->middleware(['auth:api','scope:admin,user']);

Route::get('/me/profile', 'CustomerController@index')
    ->middleware(['auth:api','scope:admin,user']);

Route::put('/me/profile', 'CustomerController@UpdateProfile')
    ->middleware(['auth:api','scope:admin,user']);



Route::get('/me/cart', 'CartController@MyCart')
    ->middleware(['auth:api','scope:admin,user']);

Route::get('/me/cart/items', 'CartController@MyItemsInCart')
    ->middleware(['auth:api','scope:admin,user']);

Route::get('/me/cart/items/{id}', 'CartController@MyItemInCart')
    ->middleware(['auth:api','scope:admin,user']);

Route::post('/me/cart/items', 'CartController@AddItemToCart')
    ->middleware(['auth:api','scope:admin,user']);

Route::put('/me/cart/items/{id}', 'CartController@updateItemInCart')
    ->middleware(['auth:api','scope:admin,user']);

Route::delete('/me/cart/items/{id}', 'CartController@RemoveItemFromCart')
    ->middleware(['auth:api','scope:admin,user']);


Route::get('/search', 'ProductController@search');


Route::get('/featured-products', 'ProductController@FeatureProducts');


Route::get('/featured-accessories', 'ProductController@FeatureAccessories');


Route::get('products/{id}/related-products', 'ProductController@RelatedProduct');

Route::get('products/{id}/related-accessories', 'ProductController@RelatedAccessory');

Route::post('/me/cart/checkout', 'CartController@checkout')
    ->middleware(['auth:api','scope:admin,user']);


Route::get('/bills', 'BillController@index')
    ->middleware(['auth:api','scope:admin']);

Route::get('/me/bills', 'BillController@indexMe')
    ->middleware(['auth:api','scope:admin,user']);

Route::get('/me/bills/{id}', 'BillController@showMe')
    ->middleware(['auth:api','scope:admin,user']);

Route::get('/bills/{id}', 'BillController@show')
    ->middleware(['auth:api','scope:admin']);

Route::put('/bills/{id}', 'BillController@update')
    ->middleware(['auth:api','scope:admin']);

Route::delete('/bills/{id}', 'BillController@remove')
    ->middleware(['auth:api','scope:admin']);



Route::post('/login', 'Auth@Login');

Route::get('/facebook/login', 'Auth@LoginFacebook');

Route::post('/refresh_token','Auth@RefreshToken');

Route::post('/register','Auth@Register');
