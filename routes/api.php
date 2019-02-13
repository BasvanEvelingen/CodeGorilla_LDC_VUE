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

Route::group(['middleware' => 'auth:api'], function () {
    //Users
    Route::get('users', 'UserController@index')->middleware('isAdmin');
    Route::get('users/{id}', 'UserController@show')->middleware('isAdminOrSelf');
    Route::delete('users/{id}', 'UserController@delete')->middleware('isAdmin');

    //Questions from LDC API
    Route::get('questions', 'QuestionsController@getQuestions')->middleware('isAdminOrUser');
    Route::post('questions', 'QuestionsController@postAnswers')->middleware('isAdminOrUser');
    Route::get('levels', 'QuestionController@getProfessionLevels')->middleware('isAdminOrUser');
   
   
    //Surveys
    Route::get('surveys', 'SurveysController@indexSurveys')->middleware('isAdminOrUser');
    Route::get('surveys/{id}', 'SurveysController@getSurvey')->middleware('isAdminOrSelf');
    Route::post('surveys', 'SurveysController@storeSurvey')->middleware('isAdminOrUser');
    Route::put('surveys/{id}', 'SurveysController@updateSurvey')->middleware('isAdminOrUser');
    Route::delete('surveys/{id}', 'SurveysController@deleteSurvey')->middleware('isAdmin');
    //Survey_Details
    Route::get('surveyDetail', 'SurveyDetailsController@indexSurveyDetails')->middleware('isAdminOrSelf');
    Route::get('surveyDetail/{id}', 'SurveyDetailsController@getSurveyDetail')->middleware('isAdminOrSelf');
    Route::post('surveyDetail', 'SurveyDetailsController@storeSurveyDetail')->middleware('isAdmin');
    Route::put('surveyDetail', 'SurveyDetailsController@updateSurveyDetail')->middleware('isAdminOrSelf');
    Route::delete('surveyDetail/{id}', 'SurveyDetailsController@deleteSurveyDetail')->middleware('isAdmin');


});
