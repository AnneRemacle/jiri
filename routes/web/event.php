<?php
    Route::group(["prefix" => "events"], function() {
        Route::get("/create", [
            "as" => "events.create",
            "uses" => "EventController@create",
            "middleware" => "can:administrate"
        ]);

        Route::post("/store", [
            "as" => "events.store",
            "uses" => "EventController@store"
        ]);

        Route::delete("/{event}/delete", [
            "as" => "events.delete",
            "uses" => "EventController@destroy"
        ]);

        Route::get("/{event}/show", [
            "as" => "events.show",
            "uses" => "EventController@show"
        ]);

        Route::put("/{event}/update", [
            "as" => "events.update",
            "uses" => "EventController@update",
            "middleware" => "can:administrate"
        ]);

        Route::post("/{event}/addOrStoreStudent", [
            "as" => "events.addOrStoreStudent",
            "uses" => "EventController@addOrStoreStudent"
        ]);

        Route::get("/{event}/removeStudent/{student}", [
            "as" => "events.removeStudent",
            "uses" => "EventController@removeStudent"
        ]);

        Route::get("/{event}/inviteJury", [
            "as" => "events.inviteJury",
            "uses" => "EventController@inviteJury"
        ]);

        Route::post("/{event}/addOrStoreJury", [
            "as" => "events.addOrStoreJury",
            "uses" => "EventController@addOrStoreJury"
        ]);

        Route::get("/{event}/removeJury/{jury}", [
            "as" => "events.removeJury",
            "uses" => "EventController@removeJury"
        ]);

        Route::get("/{event}/student/{student}", [
            "as" => "events.showStudent",
            "uses" => "EventController@showStudent"
        ]);

        Route::get("/{event}/meeting/{meeting}", [
            "as" => "events.meetingShow",
            "uses" => "EventController@meetingShow"
        ]);

        Route::get("/{event}/removeProject/{project}", [
            "as" => "events.removeProject",
            "uses" => "EventController@removeProject"
        ]);
    });
