<?php

use Illuminate\Support\Facades\Route;

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
            Route::get('/', function () {
                return redirect('admin-login');
            });
            Route::get('/__clear__', function(){

            Artisan::call('cache:clear');
            //Artisan::call('route:clear');
            Artisan::call('config:clear');
            Artisan::call('route:cache');
            Artisan::call('config:cache');
            Artisan::call('view:clear');



return 'cache cleard';
});



Route::get('/merchant_maxboost','App\Http\Controllers\API\UserController@merchant_maxboost')->name('merchant_maxboost');
Route::get('/client_maxboost','App\Http\Controllers\API\UserController@client_maxboost')->name('client_maxboost');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/add-mer', [App\Http\Controllers\HomeController::class, 'addMerchant'])->name('add_mer');

Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home')->middleware('auth');

        Route::group(['middleware' => 'auth'], function () {
    	
    		Route::get('icons', ['as' => 'pages.icons', 'uses' => 'App\Http\Controllers\PageController@icons']);
    		Route::get('maps', ['as' => 'pages.maps', 'uses' => 'App\Http\Controllers\PageController@maps']);
    		Route::get('notifications', ['as' => 'pages.notifications', 'uses' => 'App\Http\Controllers\PageController@notifications']);
    		Route::get('rtl', ['as' => 'pages.rtl', 'uses' => 'App\Http\Controllers\PageController@rtl']);
    		Route::get('tables', ['as' => 'pages.tables', 'uses' => 'App\Http\Controllers\PageController@tables']);
    		Route::get('typography', ['as' => 'pages.typography', 'uses' => 'App\Http\Controllers\PageController@typography']);
    		Route::get('upgrade', ['as' => 'pages.upgrade', 'uses' => 'App\Http\Controllers\PageController@upgrade']);
        
            
        });



Route::post('DeleteMerchantUsers','App\Http\Controllers\MerchantsDataController@DeleteMerchantUsers')->name('DeleteMerchantUsers');



//Route::post('addNewMerchantUser', 'MerchantsDataController@addNewMerchantUser');  
Route::post('addNewMerchantUser','App\Http\Controllers\MerchantsDataController@addNewMerchantUser')->name('addNewMerchantUser');


Route::post('do_verify','App\Http\Controllers\UserController@do_verify')->name('do_verify');


Route::post('do_login','App\Http\Controllers\UserController@do_login')->name('do_login');
Route::get('admin-login','App\Http\Controllers\UserController@admin_login')->name('admin_login');

Route::post('forgot-password','App\Http\Controllers\UserController@reset_password')->name('forgot-password');
Route::get('forgot-password','App\Http\Controllers\UserController@reset_link')->name('reset-password');
Route::post('update-password','App\Http\Controllers\UserController@update')->name('update-password');
Route::get('change-password','App\Http\Controllers\UserController@update_form')->name('change-password');
Route::post('merchant/changePassword','App\Http\Controllers\UserController@merchantChangePassword'); 		//By Muhammad Waqar


Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
// ClientDataController





    Route::get('client-edit/{id}','App\Http\Controllers\ClientDataController@clientEdit')->name('clientEdit');
    Route::get('add-client','App\Http\Controllers\ClientDataController@addClient')->name('addClient');
    Route::post('create-client','App\Http\Controllers\ClientDataController@createClient')->name('createClient');
    Route::post('update-client/{id}','App\Http\Controllers\ClientDataController@updateClient')->name('updateClient');
    Route::get('client-delete/{id}','App\Http\Controllers\ClientDataController@clientDelete')->name('clientDelete');

// MerchantsDataController

    Route::get('add-merchant','App\Http\Controllers\MerchantsDataController@addMerchant')->name('addMerchant');
    Route::post('createMerchant','App\Http\Controllers\MerchantsDataController@createMerchant')->name('createMerchant');
    Route::get('edit-merchant/{id}','App\Http\Controllers\MerchantsDataController@editMerchant')->name('editMerchant');
    Route::post('update-merchant/{id}','App\Http\Controllers\MerchantsDataController@updateMerchant')->name('updateMerchant');
    Route::get('merchant-delete/{id}','App\Http\Controllers\MerchantsDataController@merchantDelete')->name('merchantDelete');

// FundingNodeController

    Route::get('funding-home-view','App\Http\Controllers\FundingNodeController@fundingHomeView')->name('fundingHomeView');
    Route::get('edit-funding/{id}','App\Http\Controllers\FundingNodeController@editFunding')->name('editFunding');
    Route::post('update-funding/{id}','App\Http\Controllers\FundingNodeController@updateFunding')->name('updateFunding');


// RoutingNodeController

    Route::get('routing-home-view','App\Http\Controllers\RoutingNodeController@routingHomeView')->name('routingHomeView');
    Route::get('edit-routing/{id}','App\Http\Controllers\RoutingNodeController@editRouting')->name('editRouting');
    Route::post('update-routing/{id}','App\Http\Controllers\RoutingNodeController@updateRouting')->name('updateRouting');
    
    
    // AdminInfo Route 
     Route::get('show-admin-info','App\Http\Controllers\RoutingNodeController@showAdminInfo')->name('showAdminInfo');
      Route::post('update-admin-email','App\Http\Controllers\RoutingNodeController@updateAdminEmail')->name('updateAdminEmail');
     
// TransactionController 
    Route::get('get-transactions','App\Http\Controllers\TransactionController@getTransactions')->name('getTransactions');
    Route::get('filter-transections','App\Http\Controllers\TransactionController@filterTransections')->name('filterTransections');


//  TransectionAlphaController
    Route::get('get-transactions-alpha','App\Http\Controllers\TransectionAlphaController@getTransactionsalpha')->name('getTransactionsalpha');
    Route::get('filter-transection','App\Http\Controllers\TransectionAlphaController@filterTransection')->name('filterTransection');
});

// Email Beta 
Route::get('/send-mail','App\Http\Controllers\MailController@send_mail')->name('send_mail');
Route::get('/daily_mails','App\Http\Controllers\MailController@daily_mails')->name('daily_mails');
Route::get('/weekly_mails','App\Http\Controllers\MailController@weekly_mails')->name('weekly_mails');
Route::get('/monthly_mails','App\Http\Controllers\MailController@monthly_mails')->name('monthly_mails');



// Daily Manual Email Route
Route::post('/daily-manual-email','App\Http\Controllers\MailController@dailyManualEmail')->name('dailyMail');
// Weekly Manual Email Route
Route::post('/weekly-manual-email','App\Http\Controllers\MailController@weeklyManualEmail')->name('weeklyMail');
// Monthly Manual Email Route

Route::any('/change-status','App\Http\Controllers\MailController@changeStatus');



// E-mail Alpha
Route::post('/is-email-allow','App\Http\Controllers\MailController@isEmailAllow');
Route::post('/boot-email','App\Http\Controllers\MailController@bootManualEmail');
Route::get('/merchant/requestNewMemberToken/{id}','App\Http\Controllers\MailController@merchantRequestNewMemberToken');		//By Muhammad Waqar
Route::post('/merchant/verify2faCode','App\Http\Controllers\MailController@merchantVerify2faCode');		//By Muhammad Waqar



Route::get('/daily_alpha_mails','App\Http\Controllers\MailController@daily_alpha_mails')->name('daily_alpha_mails');
Route::get('/weekly_alpha_mails','App\Http\Controllers\MailController@weekly_alpha_mails')->name('weekly_alpha_mails');
Route::get('/monthly_alpha_mails','App\Http\Controllers\MailController@monthly_mails')->name('monthly_alpha_mails');

Route::get('/password-change','App\Http\Controllers\ProfileController@password_2fa')->name('password-change');
Route::get('/password-change/2fa','App\Http\Controllers\ProfileController@verify_2fa')->name('password-change.2fa');
Route::post('/admin-password/update','App\Http\Controllers\ProfileController@admin_password_update')->name('admin-password.update');

