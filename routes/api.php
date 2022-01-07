<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//client
Route::post('/clients_login','App\Http\Controllers\API\UserController@clients_login')->name('clients_login');
Route::post('/clients_Edit/{id}','App\Http\Controllers\API\UserController@clients_Edit')->name('clients_Edit');
Route::get('/client_maxboost','App\Http\Controllers\API\UserController@client_maxboost')->name('client_maxboost');
Route::get('/get-client/{id}','App\Http\Controllers\API\UserController@getClients')->name('getClients');
Route::post('/add-client','App\Http\Controllers\API\UserController@addClients')->name('addClients');

Route::post('/get-session','App\Http\Controllers\RoutingNodeController@getGLobal')->name('getGlobal');

Route::post("upload",[App\Http\Controllers\API\UserController::class,'upload']);

// shock_pay
Route::post('/create_shock_pay_contact','App\Http\Controllers\API\UserController@create_shock_pay')->name('shock_pay');
Route::GET('/get_shock_pay_contact/{client_id}','App\Http\Controllers\API\UserController@get_shock_pay')->name('get_shock_pay');

//By Ajmal
Route::post('/delete_shock_pay_contact','App\Http\Controllers\API\UserController@delete_shock_pay')->name('delete_shock_pay');


//merchant

Route::post('/merchants_login','App\Http\Controllers\API\UserController@merchants_login')->name('merchants_login');
Route::post('/merchants_Edit/{id}','App\Http\Controllers\API\UserController@merchants_Edit')->name('merchants_Edit');
Route::get('/merchant_maxboost','App\Http\Controllers\API\UserController@merchant_maxboost')->name('merchant_maxboost');
Route::get('/get-merchants','App\Http\Controllers\API\UserController@getMerchants')->name('getMerchants');

Route::get('/get-clients','App\Http\Controllers\API\UserController@getAllClients')->name('getAllClients');

//apis for merchant ADMIN,CHECKOUT,MERCHANT USER LOGINS

Route::post('/merchantsuser_login','App\Http\Controllers\API\UserController@merchantsuser_login')->name('merchantsuser_login');
Route::post('/merchantsadmin_login','App\Http\Controllers\API\UserController@merchantsadmin_login')->name('merchantsadmin_login');
Route::post('/merchantscheckout_login','App\Http\Controllers\API\UserController@merchantscheckout_login')->name('merchantscheckout_login');

//merchant item imagesgetMerchantFileRecord
Route::post('/add_mercahnt_file', 'App\Http\Controllers\API\AlphaController@addMerchant')->name('add_mer');
Route::post('/delete_mercahnt_file', 'App\Http\Controllers\API\AlphaController@deleteMerchantFile')->name('dlt_merchant');
Route::get('/all_merchant_file/{id}', 'App\Http\Controllers\API\AlphaController@getMerchantFileRecord');
Route::post('/update_merchant_file', 'App\Http\Controllers\API\AlphaController@updateMerchantFile');




//routings
Route::get('/get-routing-nodes','App\Http\Controllers\API\UserController@getRoutingNodes')->name('getRoutingNodes');


// by Muhammad Waqar (routingapiauth1 and routingapiauth2)
Route::post('/routingapiauth1','App\Http\Controllers\API\UserController@routingapiauth1')->name('routingapiauth1');
Route::post('/routingapiauth2','App\Http\Controllers\API\UserController@routingapiauth2')->name('routingapiauth2');


//fundings
Route::get('/get-funding-nodes','App\Http\Controllers\API\UserController@getFundingNodes')->name('getFundingNodes');

//merchant
Route::post('/add-transction','App\Http\Controllers\API\UserController@addTransction')->name('addTransction');
// add instance AHMAD
Route::post('/add-instance','App\Http\Controllers\API\UserController@addInstance')->name('addInstance');

// addAlphaTransction
Route::post('/add-alpha-transction','App\Http\Controllers\API\AlphaController@addAlphaTransction')->name('addAlphaTransction');


// 2fa for merchant
Route::post('/check-merchant','App\Http\Controllers\API\UserController@checkMerchant')->name('checkMerchant');
Route::get('/clients','App\Http\Controllers\API\UserController@clients')->name('clients');
Route::get('/verify-2fa','App\Http\Controllers\API\UserController@clients_2fa')->name('verify');

Route::middleware('auth:api')->get('/user', function (Request $request) {return $request->user();});
