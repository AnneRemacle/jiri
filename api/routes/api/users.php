<?php
    Route::group(["prefix" => "user"], function(){
        Route::get('/authenticate', [
            "as" => "user.authenticate",
            "uses" => "UserController@authenticate"
        ]);

        Route::get('/', [
            "as" => "user.index",
            "uses" => "UserController@index"
        ]);

        Route::get("/getAuthenticatedUser", [
            "as" => "user.details",
            "uses" => "UserController@getAuthenticatedUser"
        ]);

        Route::get('/{user}', [
            "as" => "user.show",
            "uses" => "UserController@show"
        ]);

        Route::get("/{user}/events", [
            "as" => "user.events",
            "uses" => "UserController@getUserEvents"
        ]);

        Route::post('/addOrStore', [
            "as" => "users.addOrStore",
            "uses" => "UserController@addOrStore"
        ]);

        Route::post("/{user}/update", [
            "as" => "users.update",
            "uses" => "UserController@update"
        ]);
    });
