<?php


Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', 'HomeController@index')->name('home');

    Route::prefix('admin')->group(function () {
        Route::resource('/user', 'AdminController');
        Route::resource('/organizer', 'OrganizerController');
    });

    Route::prefix('organizer')->group(function () {
        Route::resource('/events', 'EventController');
        Route::resource('/posts', 'PostController');
        Route::resource('/candidates', 'CandidateController');
        Route::get('/voters', 'CandidateController@voters');
        Route::get('/voter/status/{id}', 'CandidateController@voterStatus');
    });


    Route::prefix('voter')->group(function () {
        Route::get('/events', 'VoterController@index');
        Route::get('/event/details/{id}', 'VoterController@eventShow');
    });

});