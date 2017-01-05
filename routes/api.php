<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: origin, x-requested-with, content-type');
header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS');

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









Route::post('/login', 'Auth@Login');

Route::post('/refresh_token','Auth@RefreshToken');

Route::post('/register','Auth@Register');
