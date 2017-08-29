<?php
    Route::group(["prefix" => "projects"], function() {
        Route::get("/create/{event}", [
            "as" => "projects.create",
            "uses" => "ProjectController@create",
            "middleware" => "can:administrate"
        ]);

        Route::post("/store/{event}", [
            "as" => "projects.addOrStore",
            "uses" => "ProjectController@addOrStore",
            "middleware" => "can:administrate"
        ]);
    });
