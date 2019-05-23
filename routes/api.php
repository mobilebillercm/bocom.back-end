<?php

use Illuminate\Http\Request;

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

Route::post('register', 'AuthController@register');
Route::post('login', 'AuthController@login');
Route::post('recover', 'AuthController@recover');

Route::get('stations', 'FreeController@getAllStation');

Route::get('stations/{id}/image0', 'FreeController@getImage0');
Route::get('stations/{id}', 'FreeController@getStationById');
Route::get('stations/{id}/details', 'FreeController@getDetailsOfStation');

Route::get('produitpetroliers/{id}/logo', 'FreeController@getLogoProduitPetrolier');

Route::get('services/{id}/logo', 'FreeController@getLogoService');

Route::get('lubrifiants/{id}/logo', 'FreeController@getLogoLubrifiant');

Route::get('lubrifiants/{id}/logo', 'FreeController@getLogoLubrifiant');

Route::get('stations/{p}/{f}', 'FreeController@getStationImage');

Route::get('paymentmethods/{id}/logo', 'FreeController@getLogoPaymentmethods');

Route::get('products/{id}/logo', 'FreeController@getLogoProduct');


Route::get('products', 'FreeController@getAllProducts');

Route::get('stations-products/{id}', 'FreeController@getStationsByProduct');

Route::get('stations-services/{id}', 'FreeController@getStationsByService');

Route::get('stations-paymentmethods/{id}', 'FreeController@getStationsByPaymentMethod');

Route::get('services', 'FreeController@getAllServices');

Route::get('paymentmethods', 'FreeController@getAllPaymentmethods');



Route::group(['middleware' => ['jwt.auth']], function() {
    Route::post('logout', 'AuthController@logout');
    Route::put('stations/{id}', 'ApiController@updateStation');
    Route::put('users/{id}', 'ApiController@updateUser');
    Route::get('test', function(){
        return response()->json(['foo'=>'bar']);
    });
});



