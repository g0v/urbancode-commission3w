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

Route::group(['prefix' => 'minutes'], function() {
    Route::get('/', function () {
        return view('minutes');
    });
    // Route::get('/{admin}-{period}-{session}-{round}',
    Route::group(['prefix' => '{admin}-{period}-{session}-{round}'], function () {
            Route::get('/', function($admin, $period, $session, $round) {
                return view('minutes', ['admin' => $admin,
                                        'period' => $period,
                                        'session' => $session,
                                        'round' => $round]);
            });

            Route::get('/cases/{case_id}', function($admin, $period, $session, $round, $caseId) {
                return view('cases', ['admin' => $admin,
                                        'period' => $period,
                                        'session' => $session,
                                        'round' => $round,
                                        'caseId' => $caseId]);
            });
    });
});
