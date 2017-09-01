<?php
    Route::group(["prefix" => "scores"], function() {
        Route::put("/update/{score}", [
            "as" => "scores.update",
            "uses" => "ScoreController@update"
        ]);
    });
