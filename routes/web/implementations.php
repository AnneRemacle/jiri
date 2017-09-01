<?php
    Route::group(["prefix" => "implementations"], function() {
        Route::put("/update/{event}", [
            "as" => "implementations.update",
            "uses" => "ImplementationController@update",
            "middleware" => "can:administrate"
        ]);
    });
