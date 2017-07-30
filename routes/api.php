<?php

use Illuminate\Http\Request;

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

Route::get('/', function () {
    return view('api');
});

Route::group(['prefix' => 'minutes/{admin}-{period}-{session}-{round}'], function () {
  Route::get('/', [
      'as' => 'api.minutes',
      'uses' => 'MinuteController@getMinutes'
  ]);

  Route::get('/cases/{case_id}', [
      'as' => 'api.minutes.cases',
      'uses' => 'MinuteController@getCaseFromMinute'
  ]);
});

Route::group(['prefix' => 'cases/{case_id}'], function () {
  Route::get('/', [
      'as' => 'api.cases',
      'uses' => 'CaseController@getCases'
  ]);
});
