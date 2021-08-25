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

Route::group(['middleware' => 'auth:api'], function() {
    Route::get('category', 'CategoriesController@store');
    Route::get('category/{id}', 'CategoriesController@update');

    Route::get('certificate', 'CertificateController@store');
    Route::get('certificate/{id}', 'CertificateController@update');

    Route::get('education', 'EducationController@store');
    Route::get('education/{id}', 'EducationController@update');

    Route::get('employement', 'EmployementController@store');
    Route::get('employement/{id}', 'EmployementController@update');

    Route::get('expirence', 'ExpirenceController@store');
    Route::get('expirence/{id}', 'ExpirenceController@update');

    Route::get('favourite', 'FavouriteController@store');
    Route::get('favourite/{id}', 'FavouriteController@update');

    Route::get('jobs', 'JobsController@store');
    Route::get('jobs/{id}', 'JobsController@update');
    
    Route::get('language', 'LanguageController@store');
    Route::get('language/{id}', 'LanguageController@update');
    
    Route::get('message', 'MessageController@store');
    Route::get('message/{id}', 'MessageController@update');
        
    Route::get('portfolio', 'PortfolioController@store');
    Route::get('portfolio/{id}', 'PortfolioController@update');
            
    Route::get('skills', 'SkillsController@store');
    Route::get('skills/{id}', 'SkillsController@update');
                
    Route::get('testimonial', 'TestimonialController@store');
    Route::get('testimonial/{id}', 'TestimonialController@update');
                    
    Route::get('transations', 'TransationsController@store');
    Route::get('transations/{id}', 'TransationsController@update');
});

