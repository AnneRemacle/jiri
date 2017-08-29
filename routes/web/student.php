<?php
    Route::group(["prefix" => "students"], function() {
        Route::get("/create/{event}", [
            "as" => "students.create",
            "uses" => "StudentController@create"
        ]);

        Route::post("/store/{event}", [
            "as" => "students.addOrStore",
            "uses" => "StudentController@addOrStore"
        ]);
    });
