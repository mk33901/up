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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('updates', 'APi\AuthController@updatecategory');
Route::group([ 'prefix' => 'auth'], function (){
    Route::group(['middleware' => ['guest:api']], function () {
        Route::post('login', 'Api\AuthController@login');
        Route::post('signup', 'Api\AuthController@signup');
    });
    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('logout', 'Api\AuthController@logout');
        Route::post('getuser', 'Api\AuthController@getUser');
    });
});
Route::get('store/card', 'PaymentOrderController@hook');

Route::post('jobs/getData', 'JobsController@create');
Route::post('validate', 'UserController@validateUser');
Route::group(['middleware' => 'auth:api'], function() {


    // Route::get('category', 'CategoriesController@index');
    // Route::post('category', 'CategoriesController@store');
    // Route::post('category/search', 'CategoriesController@search');
    // Route::post('category/{id}', 'CategoriesController@show');
    // Route::post('category/{id}/update', 'CategoriesController@update');
    // Route::post('category/{id}/remove', 'CategoriesController@destroy');

    // Route::get('certificate', 'CertificateController@index');
    // Route::post('certificate', 'CertificateController@store');
    // Route::post('certificate/search', 'CertificateController@search');
    // Route::post('certificate/{id}', 'CertificateController@show');
    // Route::post('certificate/{id}/update', 'CertificateController@update');
    // Route::post('certificate/{id}/remove', 'CertificateController@destroy');

    // Route::get('specialization', 'SpecializationController@index');
    // Route::post('specialization', 'SpecializationController@store');
    // Route::post('specialization/search', 'SpecializationController@search');
    // Route::post('specialization/{id}', 'SpecializationController@show');
    // Route::post('specialization/{id}/update', 'SpecializationController@update');
    // Route::post('specialization/{id}/remove', 'SpecializationController@destroy');

    // Route::get('education', 'EducationController@index');
    // Route::post('education', 'EducationController@store');
    // Route::post('education/search', 'EducationController@search');
    // Route::post('education/{id}', 'EducationController@show');
    // Route::post('education/{id}/update', 'EducationController@update');
    // Route::post('education/{id}/remove', 'EducationController@destroy');

    Route::get('employement', 'EmployementController@index');
    Route::post('employement', 'EmployementController@store');
    Route::post('employement/search', 'EmployementController@search');
    Route::post('employement/{id}', 'EmployementController@show');
    Route::post('employement/{id}/update', 'EmployementController@update');
    Route::post('employement/{id}/remove', 'EmployementController@destroy');

    Route::get('expirence', 'ExpirenceController@index');
    Route::post('expirence', 'ExpirenceController@store');
    Route::post('expirence/search', 'ExpirenceController@search');
    Route::post('expirence/{id}', 'ExpirenceController@show');
    Route::post('expirence/{id}/update', 'ExpirenceController@update');
    Route::post('expirence/{id}/remove', 'ExpirenceController@destroy');

    Route::get('education', 'UserEducationController@index');
    Route::post('education', 'UserEducationController@store');
    Route::post('education/search', 'UserEducationController@search');
    Route::post('education/{id}', 'UserEducationController@show');
    Route::post('education/{id}/update', 'UserEducationController@update');
    Route::post('education/{id}/remove', 'UserEducationController@destroy');

    Route::get('favourite', 'FavouriteController@index');
    Route::post('favourite', 'FavouriteController@store');
    Route::post('favourite/search', 'FavouriteController@search');
    Route::post('favourite/{id}', 'FavouriteController@show');
    Route::post('favourite/{id}/update', 'FavouriteController@update');
    Route::post('favourite/{id}/remove', 'FavouriteController@destroy');

    Route::get('preference', 'UserPreferenceController@index');
    Route::post('preference', 'UserPreferenceController@store');
    Route::post('preference/search', 'UserPreferenceController@search');
    Route::post('preference/{id}', 'UserPreferenceController@show');
    Route::post('preference/{id}/update', 'UserPreferenceController@update');
    Route::post('preference/{id}/remove', 'UserPreferenceController@destroy');

    Route::get('proposal', 'ProposalsController@index');
    Route::post('proposal', 'ProposalsController@store');
    Route::post('proposal/search', 'ProposalsController@search');
    Route::post('proposal/{id}', 'ProposalsController@show');
    Route::post('proposal/{id}/update', 'ProposalsController@update');
    Route::post('proposal/{id}/remove', 'ProposalsController@destroy');
    Route::post('proposal/{id}/status', 'ProposalsController@status');

    
    Route::get('jobs', 'JobsController@index');
    Route::post('jobs', 'JobsController@store');
    
    Route::post('jobs/search', 'JobsController@search');
    Route::post('jobs/{id}', 'JobsController@show');
    Route::post('jobs/{id}/update', 'JobsController@update');
    Route::post('jobs/{id}/remove', 'JobsController@destroy');
    Route::post('jobs/{id}/bookmark', 'JobsController@bookmark');
    Route::post('jobs/{id}/feedback', 'JobsController@feedback');
    Route::post('job/detail/{id}', 'JobsController@detail');
    Route::post('job/users/{id}', 'JobsController@users');
    Route::post('job/shortlist/{id}', 'JobsController@shortlist');

    Route::get('language', 'LanguageController@index');
    Route::post('language', 'LanguageController@store');
    Route::post('language/search', 'LanguageController@search');
    Route::post('language/{id}', 'LanguageController@show');
    Route::post('language/{id}/update', 'LanguageController@update');
    Route::post('language/{id}/remove', 'LanguageController@destroy');


    Route::get('message', 'MessageController@index');
    Route::post('message', 'MessageController@store');
    Route::post('message/search', 'MessageController@search');
    Route::post('message/{id}', 'MessageController@show');
    Route::post('message/{id}/update', 'MessageController@update');
    Route::post('message/{id}/remove', 'MessageController@destroy');

    Route::get('portfolio', 'PortfolioController@index');
    Route::post('portfolio', 'PortfolioController@store');
    Route::post('portfolio/search', 'PortfolioController@search');
    Route::post('portfolio/{id}', 'PortfolioController@show');
    Route::post('portfolio/{id}/update', 'PortfolioController@update');
    Route::post('portfolio/{id}/remove', 'PortfolioController@destroy');

    // Route::get('skills', 'SkillsController@index');
    // Route::post('skills', 'SkillsController@store');
    // Route::post('skills/search', 'SkillsController@search');
    // Route::post('skills/{id}', 'SkillsController@show');
    // Route::post('skills/{id}/update', 'SkillsController@update');
    // Route::post('skills/{id}/remove', 'SkillsController@destroy');

    Route::get('testimonial', 'TestimonialController@index');
    Route::post('testimonial', 'TestimonialController@store');
    Route::post('testimonial/search', 'TestimonialController@search');
    Route::post('testimonial/{id}', 'TestimonialController@show');
    Route::post('testimonial/{id}/update', 'TestimonialController@update');
    Route::post('testimonial/{id}/remove', 'TestimonialController@destroy');

    
    Route::get('transations', 'TransationsController@index');
    Route::post('transations', 'TransationsController@store');
    Route::post('transations/search', 'TransationsController@search');
    Route::post('transations/{id}', 'TransationsController@show');
    Route::post('transations/{id}/update', 'TransationsController@update');
    Route::post('transations/{id}/remove', 'TransationsController@destroy');

    
    Route::get('client', 'ClientController@index');
    Route::post('client', 'ClientController@store');
    Route::post('client/search', 'ClientController@search');
    Route::post('client/{id}', 'ClientController@show');
    Route::post('client/{id}/update', 'ClientController@update');
    Route::post('client/{id}/remove', 'ClientController@destroy');


    Route::get('timeentry', 'TimeEntryController@index');
    Route::post('timeentry', 'TimeEntryController@store');
    Route::post('timeentry/search', 'TimeEntryController@search');
    Route::post('timeentry/{id}', 'TimeEntryController@show');
    Route::post('timeentry/{id}/update', 'TimeEntryController@update');
    Route::post('timeentry/{id}/remove', 'TimeEntryController@destroy');

    Route::get('timeentry/attachment', 'TimeEntryAttachmentController@index');
    Route::post('timeentry/attachment', 'TimeEntryAttachmentController@store');
    Route::post('timeentry/attachment/search', 'TimeEntryAttachmentController@search');
    Route::post('timeentry/attachment/{id}', 'TimeEntryAttachmentController@show');
    Route::post('timeentry/attachment/{id}/update', 'TimeEntryAttachmentController@update');
    Route::post('timeentry/attachment/{id}/remove', 'TimeEntryAttachmentController@destroy');

    Route::post('user/{id}', 'UserController@show');
    Route::post('profile/{id}', 'UserController@profile');
    
    Route::post('invite', 'InvitesController@store');
    Route::post('contract', 'ContractsController@store');
    Route::get('contract/{id}', 'ContractsController@show');
    Route::get('contract', 'ContractsController@index');
    Route::get('contract/{id}/status', 'ContractsController@status');
    Route::post('getjobs/{id}', 'JobsController@store');
    Route::get('users/all', 'UserController@index');
    Route::get('users/jobs', 'UserController@jobs');
    Route::post('users/search', 'UserController@search');
    Route::get('client/jobs', 'JobsController@client');
    Route::get('job/user/{id}', 'JobsController@loadusers');
    Route::post('users/update', 'UserController@update');
    Route::post('users/find/{search}', 'UserController@search');

    Route::post('users/start', 'UserController@start');

    Route::post('bookmark', 'JobBookmarkController@store');
    Route::post('talent/bookmark', 'JobBookmarkController@userstore');
    Route::post('country', 'CountryController@index');

    Route::get('feedback', 'JobFeedbackController@index');
    Route::post('feedback', 'JobFeedbackController@store');
    Route::post('feedback/search', 'JobFeedbackController@search');
    Route::post('feedback/{id}', 'JobFeedbackController@show');
    Route::post('feedback/{id}/update', 'JobFeedbackController@update');
    Route::post('feedback/{id}/remove', 'JobFeedbackController@destroy');


    Route::get('payment/order', 'PaymentOrderController@index');
    Route::post('payment/order', 'PaymentOrderController@store');
    Route::post('payment/create/order', 'ContractsController@contactOrder');
    Route::post('payment/auth', 'PaymentOrderController@authorizePayment');
    Route::post('payment/pay', 'PaymentOrderController@pay');
    Route::post('payment/card', 'PaymentOrderController@card');
    Route::post('payment/order/search', 'PaymentOrderController@search');
    Route::post('payment/order/{id}', 'PaymentOrderController@show');
    Route::post('payment/order/{id}/update', 'PaymentOrderController@update');
    Route::post('payment/order/{id}/remove', 'PaymentOrderController@destroy');


    Route::post('payout/save', 'PaymentOrderController@beneficiary');
    Route::post('payout/transfer', 'PaymentOrderController@transfer');
    Route::post('payout/bank', 'PaymentOrderController@getbeneficiary');
    Route::post('payout/subscribe', 'PaymentOrderController@subscribe');
    Route::post('payout/getpayment', 'PaymentOrderController@getPayment');

    Route::post('widrow', 'WidrowController@index');
    Route::post('widrow/save', 'WidrowController@store');
    Route::post('widrow/{id}/update', 'WidrowController@update');
    Route::post('widrow/{id}/remove', 'WidrowController@destroy');


    Route::get('jobtransations', 'JobTransactionsController@index');
    Route::post('jobtransations', 'JobTransactionsController@store');
    Route::post('jobtransations/search', 'JobTransactionsController@search');
    Route::post('jobtransations/{id}', 'JobTransactionsController@show');
    Route::post('jobtransations/{id}/update', 'JobTransactionsController@update');
    Route::post('jobtransations/{id}/remove', 'JobTransactionsController@destroy');

    Route::get('get/jobs', 'ContractsController@jobs');

    Route::get('invite', 'InvitesController@index');
    Route::post('invite/{id}', 'InvitesController@update');
    Route::post('review', 'JobReviewController@store');
});

