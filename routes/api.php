<?php

use App\Http\Middleware\AuthJWT;
use App\Http\Middleware\VerifyContentType;
use Illuminate\Http\Request;

Route::namespace('Api')
    ->prefix('v1')
    ->group(
        //['middleware' => VerifyContentType::class],
        function () {
            Route::group(['middleware' => VerifyContentType::class], function () {

                Route::get('messages/{message}/relations/creator', ['as' => 'messages.relationships.creator']);
                Route::get('messages/{message}/creator', ['as' => 'messages.creator']);

                Route::get('sessions/{session}/relations/creator', ['as' => 'sessions.relationships.creator']);
                Route::get('sessions/{session}/creator', ['as' => 'sessions.creator']);

                Route::resource(
                    'sessions',
                    'SessionController',
                    ['only' => ['store', 'show']]
                );

                Route::resource(
                    'users',
                    'UserController',
                    ['only' => ['show']]
                );

                Route::group(['middleware' => AuthJWT::class], function () {
                    Route::resource(
                        'messages',
                        'MessageController',
                        ['only' => ['index', 'store', 'show']]
                    );
                });
            });

    });
