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
/*Route::prefix("/")->middleware(['StateLaunchings','locale'])->group(function(){

});*/
Auth::routes(['verify' => true]);
Route::prefix("admincp")->group(function(){
	Route::get('/', [
		'as' => 'getLogin',
		'uses' => 'AdminController@getLogin'
	]);
});
Route::prefix("/")->middleware(['verified'])->group(function(){
	Route::prefix("admincp")->group(function(){
		/*eat*/
		Route::prefix("eats")->group(function(){
			Route::get('/', [
				'as' => 'getListEats',
				'uses' => 'EatsController@getListEats'
			]);
			Route::post('/create', [
				'as' => 'postCreateEats',
				'uses' => 'EatsController@postCreateEats'
			]);
			Route::get('/edit/{id_eat}', [
				'as' => 'getEditEats',
				'uses' => 'EatsController@getEditEats'
			]);
			Route::post('/edit/{id_eat}', [
				'as' => 'postEditEats',
				'uses' => 'EatsController@postEditEats'
			]);
		});
		/*users*/
		Route::prefix("users")->group(function(){
			Route::get('/reviewers', [
				'as' => 'getListReviewers',
				'uses' => 'UserController@getListReviewers'
			]);
			Route::get('/business-owners', [
				'as' => 'getListBusinessOwners',
				'uses' => 'UserController@getListBusinessOwners'
			]);
			Route::get('/edit-user/{id_user}', [
				'as' => 'getEditUser',
				'uses' => 'UserController@getEditUser'
			]);
			Route::post('/edit-user/{id_user}', [
				'as' => 'postEditUser',
				'uses' => 'UserController@postEditUser'
			]);
		});
		Route::prefix("business-listings")->group(function(){
			Route::get('/list-approved-businesses', [
				'as' => 'getListApprovedBusinesses',
				'uses' => 'BusinessController@getListApprovedBusinesses'
			]);
			
			Route::get('/list-pending-business', [
				'as' => 'getListPendingBusiness',
				'uses' => 'BusinessController@getListPendingBusiness'
			]);
			
			
		});

	});
});

