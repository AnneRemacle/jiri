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

        Route::get("/{event}/inviteStudent", [
            "as" => "events.inviteStudent",
            "uses" => "EventController@inviteStudent"
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

    });
