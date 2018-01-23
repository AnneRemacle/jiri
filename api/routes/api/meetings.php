<?php
    Route::group(["prefix" => "meetings"], function() {
        Route::post("/create", [
            "as" => "meetings.create",
            "uses" => "MeetingController@create"
        ]);

        Route::get("/{meeting}/show", [
            "as" => "meeting.show",
            "uses" => "MeetingController@show"
        ]);

        Route::post("/{meeting}/updateScores", [
            "as" => "meeting.updateScores",
            "uses" => "MeetingController@updateScores"
        ]);
    });
