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
	Route::get('/privacy-policy', [
		'as' => 'privacy_policy',
		'uses' => 'HomeController@privacy_policy'
	]);
	Route::get('/create-business', [
		'as' => 'create_business',
		'uses' => 'HomeController@create_business'
	]);
	
// end hungpro
