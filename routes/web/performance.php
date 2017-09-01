<?php
    Route::group(["prefix" => "performances"], function() {
        Route::put("/update/{performance}", [
            "as" => "performances.update",
            "uses" => "PerformanceController@update",
            "middleware" => "can:administrate"
        ]);
    });
