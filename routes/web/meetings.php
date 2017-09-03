<?php
    Route::group(["prefix" => "meetings"], function() {
        Route::get("/create/{event}", [
            "as" => "meetings.create",
            "uses" => "MeetingController@create",
            "middleware" => "can:administrate"
        ]);

        Route::post("/store/{event}", [
            "as" => "meetings.store",
            "uses" => "MeetingController@store",
            "middleware" => "can:administrate"
        ]);

        Route::post("/updateOrStore/{event}", [
            "as" => "meetings.updateOrStore",
            "uses" => "MeetingController@updateOrStore",
            "middleware" => "can:administrate"
        ]);

        Route::put("/update/{meeting}", [
            "as" => "meetings.update",
            "uses" => "MeetingController@update",
        ]);

        Route::get("/print/{event}", [
            "as" => "meetings.print",
            "uses" => "MeetingController@printMeetings"
        ]);

        Route::get("/getPDF/meetingsByUser/{event}", [
            "as" => "meetings.getUserMeetingsPDF",
            "uses" => "MeetingController@getUserMeetingsPDF"
        ]);

        Route::get("/getPDF/meetingsByStudent/{event}", [
            "as" => "meetings.getStudentMeetingsPDF",
            "uses" => "MeetingController@getStudentMeetingsPDF"
        ]);
    } );
