<?php
    Route::group(["prefix" => "students"], function() {
        Route::get('/', [
            "as" => 'students.index',
            "uses" => 'StudentController@index'
        ]);

        Route::get('/{student}', [
            "as" => 'students.show',
            "uses" => 'StudentController@show'
        ]);

        Route::post('/addOrStore', [
            "as" => "students.addOrStore",
            "uses" => "StudentController@addOrStore"
        ]);

        Route::post("/{student}/update", [
            "as" => "students.update",
            "uses" => "StudentController@update"
        ]);

        Route::get("/{student}/getImplementationsForEvent/{event}", [
            "as" => "students.getImplentationsForEvent",
            "uses" => "StudentController@getImplentationsForEvent"
        ]);

        Route::post("/{student}/updateImplementations/{event}", [
            "as" => "students.updateImplementations",
            "uses" => "StudentController@updateImplementations"
        ]);

        Route::get("/{student}/implementations/{event}/meeting/{meeting}", [
            "as" => "students.implementations",
            "uses" => "StudentController@getImplementations"
        ]);

        Route::get("/{student}/calculatedScore/{event}", [
            "as" => "students.calculatedScore",
            "uses" => "StudentController@getCalculatedScore"
        ]);
    });
