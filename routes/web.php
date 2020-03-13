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


// Route::get('/', function () {
//     return view('welcome');
// });

/*Knight*/
Route::post('/login-user', [
	'as' => 'postLogin',
	'uses' => 'LoginController@postLogin'
]);
Route::get('/logout-user', [
	'as' => 'getLogout',
	'uses' => 'LoginController@getLogout'
]);

Route::post('/edit-infor-user', [
	'as' => 'postEditUserFrondEnd',
	'uses' => 'UserController@postEditUserFrondEnd'
]);
Route::post('/edit-user-pass', [
	'as' => 'postEditUserPassFrondEnd',
	'uses' => 'UserController@postEditUserPassFrondEnd'
]);

Route::post('/create-business', [
	'as' => 'postCreateBusiness',
	'uses' => 'BusinessController@postCreateBusiness'
]);
/*end Knight*/
// hungpro
	// Route::get('/home', 'HomeController@index')->name('home');
	Route::get('/', [
		'as' => 'index',
		'uses' => 'HomeController@home'
	]);
	Route::get('/search', [
		'as' => 'search',
		'uses' => 'HomeController@search'
	]);
	Route::get('/myprofile', [
		'as' => 'myprofile',
		'uses' => 'HomeController@myprofile'
	]);
	Route::get('/setting', [
		'as' => 'mysetting',
		'uses' => 'HomeController@mysetting'
	]);
	Route::get('/register', [
		'as' => 'register',
		'uses' => 'HomeController@register'
	]);
	Route::get('/login', [
		'as' => 'login',
		'uses' => 'HomeController@login'
	]);
	Route::get('/forgot-password', [
		'as' => 'forgot_password',
		'uses' => 'HomeController@forgot_password'
	]);
	Route::get('/advertise', [
		'as' => 'advertise',
		'uses' => 'HomeController@advertise'
	]);
	Route::get('/contact-us', [
		'as' => 'contact',
		'uses' => 'HomeController@contact'
	]);
	Route::get('/privacy-policy', [
		'as' => 'privacy_policy',
		'uses' => 'HomeController@privacy_policy'
	]);
	Route::get('/create-business', [
		'as' => 'create_business',
		'uses' => 'HomeController@create_business'
	]);
	Route::get('/add-business', [
		'as' => 'add_business',
		'uses' => 'HomeController@add_business'
	]);
	Route::get('/business-management', [
		'as' => 'business_management',
		'uses' => 'HomeController@business_management'
	]);
	
// end hungpro
