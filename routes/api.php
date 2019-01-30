<?php

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

/*Route::group(['prefix' => 'api'], function () {
Route::get('register', array('as'=>'register','uses'=>'UserController@getRegister'));;
Route::post('register',array('uses'=>'UserController@postRegister'));
});*/

Route::prefix('auth')->group(function () {
    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login');
    Route::get('refresh', 'AuthController@refresh');

    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('user', 'AuthController@user');
        Route::post('logout', 'AuthController@logout');
    });
});

Route::group(['middleware' => 'auth:api'], function(){
    //Users
    Route::get('users', 'UserController@index')->middleware('isAdmin');
    Route::get('users/{id}', 'UserController@show')->middleware('isAdminOrSelf');
    Route::get('surveys', 'SurveysController@getSurveys')->middleware('isAdmin');
    Route::post('surveys', 'SurveysController@storeSurvey')->middleware('isAdminOrSelf');
    Route::get('questions', 'QuestionsController@getQuestions')->middleware('isAdminOrSelf');
    
});
