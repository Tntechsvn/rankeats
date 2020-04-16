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

Route::get('page/{id_page}', [
	'as' => 'getPages',
	'uses' => 'HomeController@getPages'
]);

Route::post('/fetchCategory', [
	'as' => 'fetchCategory',
	'uses' => 'HomeController@fetchCategory'
]);
Route::post('/fetch-city-state', [
	'as' => 'fetchCityState',
	'uses' => 'HomeController@fetchCityState'
]);
Route::post('/ajaxCity', [
	'as' => 'ajaxCity',
	'uses' => 'HomeController@ajaxCity'
]);
Route::post('/vote-review-eats', [
	'as' => 'voteReviewEat_ajax',
	'uses' => 'HomeController@voteReviewEat_ajax'
]);
Route::get('/get-rank', [
	'as' => 'getRankBusiness',
	'uses' => 'HomeController@getRankBusiness'
]);
Route::post('/create-business-category', [
	'as' => 'createBusinessCategory',
	'uses' => 'EatsController@createBusinessCategory'
]);

Route::post('/send-mail-follwers', [
	'as' => 'sendMailFollwers',
	'uses' => 'MailController@sendMailFollwers'
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
	Route::post('/edit-user-image', [
		'as' => 'postEditUserImgFrondEnd',
		'uses' => 'UserController@postEditUserImgFrondEnd'
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
	Route::post('/submit-payment-advertisement', [
		'as' => 'submit.payment',
		'uses' => 'PaymentController@submitPayment'
	]);
	Route::get('/process-payment', [
		'as' => 'process.payment',
		'uses' => 'PaymentController@processPayment'
	]);
	/*postCreateEatsFrontEnd*/
	Route::post('/creat-eat', [
		'as' => 'postCreateEatsFrontEnd',
		'uses' => 'EatsController@postCreateEatsFrontEnd'
	]);

});
Route::post('/create-business', [
	'as' => 'postCreateBusiness',
	'uses' => 'BusinessController@postCreateBusiness'
]);

Route::post('/delete-eat-business', [
	'as' => 'deleteEatBusiness',
	'uses' => 'BusinessController@deleteEatBusiness'
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
			Route::get('list-pending-eats', [
				'as' => 'getListPendingEats',
				'uses' => 'EatsController@getListPendingEats'
			]);
			Route::get('approve-eat/{eat_id}', [
				'as' => 'approvedEat',
				'uses' => 'EatsController@approvedEat'
			]);
			Route::post('/delete-eat', [
				'as' => 'deleteEat',
				'uses' => 'EatsController@deleteEat'
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
			Route::post('/send-email-all-reviewers', [
				'as' => 'SendEmailAllReviewers',
				'uses' => 'MailController@SendEmailAllReviewers'
			]);
			Route::post('/send-email-all-business-owners', [
				'as' => 'SendEmailAllBusinessOwners',
				'uses' => 'MailController@SendEmailAllBusinessOwners'
			]);
			Route::post('delete-user', [
				'as' => 'deleteUser',
				'uses' => 'UserController@deleteUser',
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
			Route::post('/send-email-manager-business', [
				'as' => 'SendEmailManagerBusiness',
				'uses' => 'MailController@SendEmailManagerBusiness'
			]);
			Route::post('delete-business', [
				'as' => 'deleteBusiness',
				'uses' => 'BusinessController@deleteBusiness',
			]);
			
		});
		Route::prefix("reviews")->group(function(){
			Route::get('/list-business-reviews', [
				'as' => 'getListBusinessReviews',
				'uses' => 'ReviewsController@getListBusinessReviews'
			]);
			Route::get('/list-eat-reviews', [
				'as' => 'getListEatReviews',
				'uses' => 'ReviewsController@getListEatReviews'
			]);
			Route::post('delete-review', [
				'as' => 'deleteReview',
				'uses' => 'ReviewsController@deleteReview',
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
		/*cms*/
		Route::prefix("pages")->group(function(){
			Route::get('/', [
				'as' => 'getListPage',
				'uses' => 'PageController@getListPage'
			]);
			/*create page*/
			Route::get('/create-page', [
				'as' => 'getCreatePage',
				'uses' => 'PageController@getCreatePage'
			]);
			Route::post('/create-page', [
				'as' => 'postCreatePage',
				'uses' => 'PageController@postCreatePage'
			]);
			/*edit page*/
			Route::get('/edit-page/{id_page}', [
				'as' => 'getEditPage',
				'uses' => 'PageController@getEditPage'
			]);
			Route::post('/edit-page/{id_page}', [
				'as' => 'postEditPage',
				'uses' => 'PageController@postEditPage'
			]);
			Route::post('/delete-page', [
				'as' => 'deletePages',
				'uses' => 'PageController@deletePages'
			]);
		});
		/*Countries*/
		Route::prefix("country")->group(function(){
			Route::get('/', [
				'as' => 'getListCountry',
				'uses' => 'LocationController@getListCountry'
			]);
			Route::post('/create', [
				'as' => 'postCreateCountry',
				'uses' => 'LocationController@postCreateCountry'
			]);
			Route::get('/edit/{country_id}', [
				'as' => 'getEditCountry',
				'uses' => 'LocationController@getEditCountry'
			]);
			Route::post('/edit/{country_id}', [
				'as' => 'postEditCountry',
				'uses' => 'LocationController@postEditCountry'
			]);
		
		});
		/*state*/
		Route::prefix("state")->group(function(){
			Route::get('/', [
				'as' => 'getListState',
				'uses' => 'LocationController@getListState'
			]);
			Route::post('/create', [
				'as' => 'postCreateState',
				'uses' => 'LocationController@postCreateState'
			]);
			Route::get('/edit/{state_id}', [
				'as' => 'getEditState',
				'uses' => 'LocationController@getEditState'
			]);
			Route::post('/edit/{state_id}', [
				'as' => 'postEditState',
				'uses' => 'LocationController@postEditState'
			]);
		
		});
		Route::prefix("city")->group(function(){
			Route::get('/', [
				'as' => 'getListCity',
				'uses' => 'LocationController@getListCity'
			]);
			Route::post('/create', [
				'as' => 'postCreateCity',
				'uses' => 'LocationController@postCreateCity'
			]);
			Route::get('/edit/{city_id}', [
				'as' => 'getEditCity',
				'uses' => 'LocationController@getEditCity'
			]);
			Route::post('/edit/{city_id}', [
				'as' => 'postEditCity',
				'uses' => 'LocationController@postEditCity'
			]);
		
		});
		Route::prefix("language-reviews")->group(function(){
			Route::get('/', [
				'as' => 'getListLanguageReviews',
				'uses' => 'LanguageController@getListLanguageReviews'
			]);
			Route::post('/create', [
				'as' => 'postCreateLanguageReview',
				'uses' => 'LanguageController@postCreateLanguageReview'
			]);
			Route::post('/delete', [
				'as' => 'postDeleteLanguageReview',
				'uses' => 'LanguageController@postDeleteLanguageReview'
			]);
		
		});
		
		Route::post('/delete-adv', [
				'as' => 'deleteAdv',
				'uses' => 'AdminController@deleteAdv'
			]);
		Route::post('/approve-adv', [
				'as' => 'approvedAdv',
				'uses' => 'AdminController@approvedAdv'
			]);
		/*thienvu*/
		Route::get('advertisements', [
			'as' => 'advertisements',
			'uses' => 'AdminController@advertisements'
		]);

	});
});

