<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Meeting;
use App\Score;

class MeetingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $meeting = Meeting::create([
            "general_evaluation" => 0
        ]);

        $meeting->user()->associate($request->get("user_id"));
        $meeting->student()->associate($request->get("student_id"));
        $meeting->event()->associate($request->get("event_id"));

        $meeting->save();

        return response()->json($meeting->id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Meeting $meeting)
    {
        return response()->json($meeting->load("user","student"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function updateScores(Request $request, Meeting $meeting){
        foreach(json_decode($request->get("data")) as $id => $implementation){
            if(Score::where("implementation_id", $id)->where("meeting_id", $meeting->id)->count()){
                $score = Score::where("implementation_id", $id)->where("meeting_id", $meeting->id)->first();
                $score->score = $implementation->score;
                $score->comment = $implementation->comment;
            }else{
                $score = Score::create([
                    "score" => $implementation->score,
                    "comment" => $implementation->comment,
                ]);
                $score->implementation()->associate($id);
                $score->meeting()->associate($meeting->id);
            }
            $score->save();
        }

        $implementations = $meeting->student->implementations->where("event_id", $meeting->event->id)->load("scores");
        $calculated_score = 0;

        foreach($implementations as $implementation){
            $calculated_score += ($implementation->scores->pluck("score")->sum()/$implementation->scores->count())*$implementation->weight;
        }

        $performance = $meeting->student->performances->where("event_id", $meeting->event->id)->first();
        $performance->calculated_score = $calculated_score;

        $performance->save();

        $meeting->general_evaluation = $request->get("general_evaluation");
        $meeting->save();

       return response()->json("ok");
    }
}
