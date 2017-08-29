<?php
    Route::group(["prefix" => "meetings"], function() {
        Route::get("/create/{event}", [
            "as" => "meetings.create",
            "uses" => "MeetingController@create",
            "middleware" => "can:administrate"
        ]);

        Route::post("/store/{event}", [
            "as" => "meetings.store",
            "uses" => "MeetingController@store",
            "middleware" => "can:administrate"
        ]);
    } );
