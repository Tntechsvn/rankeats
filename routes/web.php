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
	Route::prefix("/")->middleware(['frontendLogin','verified'])->group(function(){
		Route::get('/myprofile', [
			'as' => 'myprofile',
			'uses' => 'HomeController@myprofile'
		]);
		Route::get('/setting', [
			'as' => 'mysetting',
			'uses' => 'HomeController@mysetting'
		]);
		Route::get('/bookmark', [
			'as' => 'bookmark',
			'uses' => 'HomeController@bookmark'
		]);
		Route::get('/business-management', [
			'as' => 'business_management',
			'uses' => 'HomeController@business_management'
		]);
		
		Route::get('/create-advertise', [
			'as' => 'create_advertise',
			'uses' => 'HomeController@create_advertise'
		]);
		Route::get('/eat-reviews', [
			'as' => 'eat_reviews',
			'uses' => 'HomeController@eat_reviews'
		]);
		Route::get('/eat-rank', [
			'as' => 'eat_rank',
			'uses' => 'HomeController@eat_rank'
		]);
		Route::get('/business-rank', [
			'as' => 'business_rank',
			'uses' => 'HomeController@business_rank'
		]);
		Route::get('/business-review', [
			'as' => 'business_review',
			'uses' => 'HomeController@business_review'
		]);
		Route::get('/my-businesses/{business_id}', [
			'as' => 'my_businesses',
			'uses' => 'HomeController@my_businesses'
		]);
		Route::get('/my-eat', [
			'as' => 'my_eat',
			'uses' => 'HomeController@my_eat'
		]);
	});
	
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
	
	Route::get('/menu-management', [
		'as' => 'menu-management',
		'uses' => 'HomeController@menu_management'
	]);
	Route::get('/review-management', [
		'as' => 'review-management',
		'uses' => 'HomeController@review_management'
	]);
	Route::get('/info-management', [
		'as' => 'info-management',
		'uses' => 'HomeController@info_management'
	]);
	Route::get('/single-business/{id_business}', [
		'as' => 'single_business',
		'uses' => 'HomeController@single_business'
	]);
	Route::post('/ajax-bookmark', [
		'as' => 'ajax-bookmark',
		'uses' => 'HomeController@ajax_bookmark'
	]);
	Route::post('/post-ajax-login', [
		'as' => 'postAjaxLogin',
		'uses' => 'LoginController@postAjaxLogin'
	]);
	Route::post('/post-ajax-vote', [
		'as' => 'vote_ajax',
		'uses' => 'HomeController@vote_ajax'
	]);
	Route::post('/rank-join', [
		'as' => 'rank-join',
		'uses' => 'UserController@postSignUp'
	]);
	Route::post('/ajaxcitystate', [
		'as' => 'ajaxcitystate',
		'uses' => 'HomeController@ajaxcitystate'
	]);
	Route::post('/ajax-unvoted', [
		'as' => 'ajax_unvoted',
		'uses' => 'HomeController@ajax_unvoted'
	]);
	Route::post('/ajax-reaction', [
		'as' => 'reaction_review',
		'uses' => 'HomeController@reaction_review'
	]);
	
// end hungpro
