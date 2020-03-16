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
	Route::get('/sign-up', [
		'as' => 'sign_up',
		'uses' => 'HomeController@sign_up'
	]);
	Route::get('/sign-in', [
		'as' => 'sign_in',
		'uses' => 'HomeController@sign_in'
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
	Route::get('/bookmark', [
		'as' => 'bookmark',
		'uses' => 'HomeController@bookmark'
	]);
	Route::get('/create-advertise', [
		'as' => 'create_advertise',
		'uses' => 'HomeController@create_advertise'
	]);
	Route::get('/eat-reviews', [
		'as' => 'eat_reviews',
		'uses' => 'HomeController@eat_reviews'
	]);
	Route::get('/single-restaurent', [
		'as' => 'single_restaurent',
		'uses' => 'HomeController@single_restaurent'
	]);
	Route::post('/ajax-bookmark', [
		'as' => 'ajax-bookmark',
		'uses' => 'HomeController@ajax_bookmark'
	]);
	Route::post('/post-ajax-login', [
		'as' => 'postAjaxLogin',
		'uses' => 'LoginController@postAjaxLogin'
	]);
	
// end hungpro
