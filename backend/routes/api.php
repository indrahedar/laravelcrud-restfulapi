<?php

Route::group(['middleware' => ['api']], function (){

    Route::get('/profile', 'ProfileController@index');
    Route::get('/profile/{id}', 'ProfileController@show');
    Route::post('/profile', 'ProfileController@store');
    Route::post('/profile/edit', 'ProfileController@update');
    Route::post('/profile/delete/{id}', 'ProfileController@destroy');

});
