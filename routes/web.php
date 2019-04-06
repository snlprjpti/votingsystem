<?php


Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', 'HomeController@index')->name('home');

    Route::prefix('admin')->group(function () {
        Route::resource('/organizer', 'OrganizerController');
    });

    Route::prefix('organizer')->group(function () {
        Route::resource('/events', 'EventController');
        Route::resource('/voters', 'VoterController');
    });


    Route::prefix('admin')->group(function () {
        Route::resource('/organizer', 'OrganizerController')->middleware('verified');
    });

});