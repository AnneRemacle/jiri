<?php
    Route::group(["prefix" => "events"], function() {
        Route::get("/", [
            "as" => "events.index",
            "uses" => "EventController@index",
            "middleware" => ["auth","can:administrate"]
        ]);

        Route::get("/create", [
            "as" => "events.create",
            "uses" => "EventController@create",
            "middleware" => ["auth","can:administrate"]
        ]);

        Route::post("/store", [
            "as" => "events.store",
            "uses" => "EventController@store",
            "middleware" => ["auth","can:administrate"]
        ]);
    });
