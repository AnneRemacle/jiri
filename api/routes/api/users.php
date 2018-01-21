<?php
    Route::group(["prefix" => "user"], function(){
        Route::get('/authenticate', [
            "as" => "user.authenticate",
            "uses" => "UserController@authenticate"
        ]);

        Route::get("/getAuthenticatedUser", [
            "as" => "user.details",
            "uses" => "UserController@getAuthenticatedUser"
        ]);

        Route::get("/{user}/events", [
            "as" => "user.events",
            "uses" => "UserController@getUserEvents"
        ]);
    });
