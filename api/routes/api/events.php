<?php
    Route::group(["prefix" => "events"], function() {
        Route::post('/store', [
            "as" => 'event.store',
            "uses" => 'EventController@store'
        ]);

        Route::get("/{event}/show", [
            "as" => "event.show",
            "uses" => "EventController@show"
        ]);

        Route::post("/{event}/update", [
            "as" => "event.update",
            "uses" => "EventController@update"
        ]);

        Route::post("/{event}/delete", [
            "as" => "event.delete",
            "uses" => "EventController@delete"
        ]);
    });
