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
/*********************Front End***********************************/
/*Knight*/
Route::post('/sign-up', [
	'as' => 'postSignUp',
	'uses' => 'UserController@postSignUp'
]);

Route::post('/login-user', [
	'as' => 'postLogin',
	'uses' => 'LoginController@postLogin'
]);

Route::get('/logout-user', [
	'as' => 'getLogout',
	'uses' => 'LoginController@getLogout'
]);
Route::prefix("/")->middleware(['frontendLogin'])->group(function(){
	Route::post('/edit-infor-user', [
		'as' => 'postEditUserFrondEnd',
		'uses' => 'UserController@postEditUserFrondEnd'
	]);
	Route::post('/edit-user-pass', [
		'as' => 'postEditUserPassFrondEnd',
		'uses' => 'UserController@postEditUserPassFrondEnd'
	]);
	Route::post('/edit-business/{id_business}', [
		'as' => 'postEditBusiness',
		'uses' => 'BusinessController@postEditBusiness'
	]);
	/*postReviewFrontEnd*/
	Route::post('/post-review', [
		'as' => 'postReviewFrontEnd',
		'uses' => 'ReviewsController@postReviewFrontEnd'
	]);
	/*payment_plan_advertisement*/
	Route::post('/payment-plan-advertisement', [
		'as' => 'payment_plan_advertisement',
		'uses' => 'PaymentController@payment_plan_advertisement'
	]);

});
Route::post('/create-business', [
	'as' => 'postCreateBusiness',
	'uses' => 'BusinessController@postCreateBusiness'
]);


/*end Knight*/
/***************end front end******************/

Route::prefix("admincp")->group(function(){
	Route::get('/', [
		'as' => 'getLogin',
		'uses' => 'AdminController@getLogin'
	]);
});
Route::prefix("/")->middleware(['verified','adminLogin'])->group(function(){
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
			Route::get('/approve-business/{id_business}', [
				'as' => 'approvedBusinesses',
				'uses' => 'BusinessController@approvedBusinesses'
			]);
			Route::get('/edit-business/{id_business}', [
				'as' => 'getEditBusiness',
				'uses' => 'BusinessController@getEditBusiness'
			]);
			
		});
		Route::prefix("reviews")->group(function(){
			Route::get('/', [
				'as' => 'getListReviews',
				'uses' => 'ReviewsController@getListReviews'
			]);
		});
		Route::prefix("payments-plans")->group(function(){
			Route::get('/plans-detail', [
				'as' => 'getListPlanDetail',
				'uses' => 'PlanController@getListPlanDetail'
			]);
			Route::post('/plans-detail', [
				'as' => 'postPaymentPlan',
				'uses' => 'PlanController@postPaymentPlan'
			]);
		});

	});
});

