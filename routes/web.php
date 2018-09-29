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


Route::get('/getotp','HomeController@index')->name('home.index');
Route::post('/getOTP','HomeController@getOTP')->name('getOTP.store');
Route::post('/getToken','HomeController@getToken')->name('getToken.store');

Auth::routes();
Route::get('/dashboard','DashboardController@GetView')->name('dashboard.index');
Route::get('/404','HomeController@getView404')->name('page404.index');
Route::get('/403','HomeController@getView403')->name('page403.index');
Route::group(['middleware' => ['auth', 'permissions'] , 'prefix' => 'dashboard'], function () {
	// Route::get('/','DashboardController@GetView')->name('dashboard.index');
	
	Route::group(['prefix' => 'viettel'], function () {
		Route::get('/','CheckSeriViettelController@GetView')->name('checkseriviettel.create');
		Route::post('/checkseri','CheckSeriViettelController@checkSeri')->name('checkseriviettel.store');

		
	});

	Route::group(['prefix' => 'mobi'], function () {
		//seri
		Route::get('/checkseri','CheckSeriMobiController@GetView')->name('checkserimobi.create');
		Route::post('/checkseri','CheckSeriMobiController@checkSeri')->name('checkserimobi.store');
		//blance

		//bill
		Route::get('/paybill','MobiPayBillController@GetView')->name('paybillmobi.create');
		Route::post('/topup','MobiPayBillController@TopUp')->name('paybillmobi.store');
		Route::post('/checkphone','MobiPayBillController@checkPhone')->name('checkPhonemobi.store');
		Route::post('/getOTP','MobiPayBillController@getOTP')->name('getOTPmobi.store');
		Route::post('/verify','MobiPayBillController@getToken')->name('getTokenmobi.store');
		
		//data phone

		
	});
	Route::group(['prefix' => 'dataphone'], function () {
		Route::get('/','DataPhoneController@getView')->name('dataphonemobi.create');
		Route::post('/getToken','DataPhoneController@getToken')->name('dataphonemobigetoken.store');
		Route::post('/','DataPhoneController@addPhone')->name('dataphonemobiaddphone.store');

	});

	Route::group(['prefix' => 'vina'], function () {
		Route::get('/checkseri','CheckSeriVinaController@GetView')->name('checkserivina.create');

		Route::get('/paybill','VinaPayBillController@getView')->name('paybillvina.create');
		Route::post('/topup','VinaPayBillController@TopUp')->name('paybillvina.store');

	});
});

Route::group(['middleware' => ['auth', 'permissions'] , 'prefix' => 'manager'], function () {
	Route::group(['prefix' => 'user'], function () {
				Route::get('/add','UserController@getViewAddUser')->name('adduser.create');
				Route::post('/add','UserController@addUser')->name('adduser.store');
				Route::get('/list','UserController@getViewListUser')->name('listuser.create');
	});
});
