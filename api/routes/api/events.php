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

        Route::get("/{event}/projects", [
            "as" => "event.projects",
            "uses" => "EventController@projects"
        ]);

        Route::get("/{event}/removeProject/{project}", [
            "as" => "events.removeProject",
            "uses" => "EventController@removeProject"
        ]);

        Route::get("/{event}/students", [
            "as" => "event.students",
            "uses" => "EventController@students"
        ]);

        Route::get("/{event}/removeStudent/{student}", [
            "as" => "events.removeStudent",
            "uses" => "EventController@removeStudent"
        ]);
    });
