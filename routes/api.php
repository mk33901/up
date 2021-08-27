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


    Route::get('category', 'CategoriesController@index');
    Route::post('category', 'CategoriesController@store');
    Route::post('category/search', 'CategoriesController@search');
    Route::post('category/{id}', 'CategoriesController@show');
    Route::post('category/{id}/update', 'CategoriesController@update');
    Route::post('category/{id}/remove', 'CategoriesController@destroy');

    Route::get('certificate', 'CategoriesController@index');
    Route::post('certificate', 'CategoriesController@store');
    Route::post('certificate/search', 'CategoriesController@search');
    Route::post('certificate/{id}', 'CategoriesController@show');
    Route::post('certificate/{id}/update', 'CategoriesController@update');
    Route::post('certificate/{id}/remove', 'CategoriesController@destroy');

    Route::get('education', 'EducationController@index');
    Route::post('education', 'EducationController@store');
    Route::post('education/search', 'EducationController@search');
    Route::post('education/{id}', 'EducationController@show');
    Route::post('education/{id}/update', 'EducationController@update');
    Route::post('education/{id}/remove', 'EducationController@destroy');

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

    Route::get('favourite', 'FavouriteController@index');
    Route::post('favourite', 'FavouriteController@store');
    Route::post('favourite/search', 'FavouriteController@search');
    Route::post('favourite/{id}', 'FavouriteController@show');
    Route::post('favourite/{id}/update', 'FavouriteController@update');
    Route::post('favourite/{id}/remove', 'FavouriteController@destroy');

    
    Route::get('jobs', 'JobsController@index');
    Route::post('jobs', 'JobsController@store');
    Route::post('jobs/search', 'JobsController@search');
    Route::post('jobs/{id}', 'JobsController@show');
    Route::post('jobs/{id}/update', 'JobsController@update');
    Route::post('jobs/{id}/remove', 'JobsController@destroy');

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

    Route::get('skills', 'SkillsController@index');
    Route::post('skills', 'SkillsController@store');
    Route::post('skills/search', 'SkillsController@search');
    Route::post('skills/{id}', 'SkillsController@show');
    Route::post('skills/{id}/update', 'SkillsController@update');
    Route::post('skills/{id}/remove', 'SkillsController@destroy');

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
            
});

