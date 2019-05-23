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

Route::get('/', 'FreeController@home');
Route::get('/regle-utilisation-bocom-mobile', 'FreeController@regle_utilisation_bocom_mobile');

Route::get('register', function (){
    return view('auth.register');
});

Route::post('register', 'FreeController@register');

Route::get('login', function (){
    return view('auth.login');
});

Route::post('login', 'FreeController@login')->name('login'); //->name('login');

//Route::group(['middleware' => ['jwt.auth']], function() {
    Route::get('logout', 'HomeController@logout');
    Route::get('/home', 'HomeController@index');//->name('home');

    Route::get('test', function(){
        return response()->json(['foo'=>'bar']);
    });
//});

Route::get('user/verify/{verification_code}', 'AuthController@verifyUser');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.request');
Route::post('password/reset', 'Auth\ResetPasswordController@postReset')->name('password.reset');

Route::get('nouveau-produit-petrolier', 'HomeController@nouveauProduitPetrolierForm');
Route::post('nouveau-produit-petrolier', 'HomeController@nouveauProduitPetrolier');

Route::get('produitpetroliers/{id}/logo', 'HomeController@getLogoProduitPetrolier');

Route::get('nouveau-produit-lubrifiant', 'HomeController@nouveauProduitLubrifiantForm');
Route::post('nouveau-produit-lubrifiant', 'HomeController@nouveauProduitLubrifiant');

Route::get('lubrifiants/{id}/logo', 'HomeController@getLogoProduitLubrifiant');

Route::get('services', 'HomeController@services');

Route::get('nouveau-service', 'HomeController@nouveauServiceForm');
Route::post('nouveau-service', 'HomeController@nouveauService');

Route::get('service/{id}/logo', 'HomeController@getLogoService');


Route::get('stations', 'HomeController@stations');

Route::get('nouvelle-station', 'HomeController@nouvelleStationForm');
Route::post('nouvelle-station', 'HomeController@nouvelleStation');

Route::get('station/{id}/image0', 'HomeController@getStationImage0');

Route::get('stations/{id}', 'HomeController@getStationById');

Route::get('stations/{p}/{f}', 'HomeController@getStationImage');

Route::get('stations-images/{id}/add-image', 'HomeController@addImageToStationForm');

Route::post('stations/{id}/add-image', 'HomeController@addImageToStation');

Route::get('stations-contacts/{id}/add-contacts', 'HomeController@addContactToStationForm');

Route::post('stations/{id}/add-contacts', 'HomeController@addContactToStation');

Route::get('stations-petroleumproducts/{id}/add-petroleumproducts', 'HomeController@addPetroleumproductToStationForm');

Route::post('stations/{id}/add-petroleumproducts', 'HomeController@addPetroleumproductToStation');

Route::get('stations-lubrifiants/{id}/add-lubrifiants', 'HomeController@addLubrifiantToStationForm');

Route::post('stations/{id}/add-lubrifiants', 'HomeController@addLubrifiantToStation');

Route::get('stations-services/{id}/add-services', 'HomeController@addServiceToStationForm');

Route::post('stations/{id}/add-services', 'HomeController@addServiceToStation');

Route::get('stations-paymentmethods/{id}/add-paymentmethods', 'HomeController@addPaymentmethodToStationForm');

Route::post('stations/{id}/add-paymentmethods', 'HomeController@addPaymentmethodToStation');

Route::post('paymentmethods', 'HomeController@createPaymentMethod');

Route::get('recover', 'FreeController@recoverForm');
Route::post('recover', 'FreeController@recover');

Route::get('reset-password/{id}', 'FreeController@resetForm');
Route::post('reset-password/{id}', 'FreeController@reset');

Route::get('change-password/{id}', 'HomeController@changePasswordForm');
Route::post('change-password/{id}', 'HomeController@changePassword');

//paymentmethods
//Auth::routes();

