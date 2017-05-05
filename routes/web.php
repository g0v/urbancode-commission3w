<?php
use App\Notes;

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

Route::get('/', function () {
    return view('welcome');
});

// Route::group(['prefix' => 'api'], function() {
    // Route::get('/', function () {
    //     return view('api');
    // });
    // Route::get('/minutes/{admin}/{period?}/{session?}', [
    //     'as' => 'api.minutes',
    //     'uses' => 'ApiController@getMinutes'
    // ]);
// });
