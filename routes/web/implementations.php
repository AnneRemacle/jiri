<?php
    Route::group(["prefix" => "implementations"], function() {
        Route::post("/updateOrStore/{event}", [
            "as" => "implementations.updateOrStore",
            "uses" => "ImplementationController@updateOrStore",
            "middleware" => "can:administrate"
        ]);
    });
