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

Route::group(['middleware' => ['api']], function () {
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');
    Route::post('register', 'Auth\RegisterController@register');
});
