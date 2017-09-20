<?php

use Illuminate\Http\Request;

Route::namespace('Api')->prefix('api/v1')->group(function () {
    Route::post('sessions', 'SessionController@store');
    Route::post('messages', 'MessagesController@store');
    Route::get('messages', 'MessagesController@index');
});
