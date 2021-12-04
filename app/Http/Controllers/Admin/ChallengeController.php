<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Challenge;
use App\Models\Day;
use App\Models\Month;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ChallengeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('calender.challenge.index');
    }

    public function fetchChallenges(){
        $challenges = Challenge::with('topic', 'month', 'day')->get();
        if ($challenges){
            return response()->json([
                'status' => true,
                'challenges' => $challenges,
            ]);
        }
    }

    public function fetchSpecificDays($month){
        $days = Day::where('month_id', $month)->get();
        if ($days){
            return response()->json([
                'status' => true,
                'days' => $days,
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'detail' => 'required',
            'topic_id' => 'required',
            'month_id' => 'required',
            'day_id' => 'required',
        ]);
        if (!$validator->passes()){
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        }

        $challenge = Challenge::create($request->all());
        if ($challenge){
            return response()->json(['status' => 1, 'message' => 'Challenge Added Successfully']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Challenge  $challenge
     * @return \Illuminate\Http\Response
     */
    public function show(Challenge $challenge)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Challenge  $challenge
     * @return \Illuminate\Http\Response
     */
    public function edit($challenge)
    {
        $challenge = Challenge::find($challenge);
        $topics = Topic::all();
        $months = Month::where('topic_id', $challenge->topic_id)->get();
        $days = Day::where('month_id', $challenge->month_id)->get();
        if ($days){
            return response()->json([
                'status' => 200,
                'challenge' => $challenge,
                'days' => $days,
                'months' => $months,
                'topics' => $topics,
            ]);
        }
        else{
            return response()->json([
                'status' => 404,
                'message' => 'Challenge not found'
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Challenge  $challenge
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $challenge)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'detail' => 'required',
            'day_id' => 'required',
        ]);
        if (!$validator->passes()){
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        }
        $challenge = Challenge::find($challenge);
        $challenge->update($request->all());
        if ($challenge){
            return response()->json(['status' => 1, 'message' => 'Challenge Updated Successfully']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Challenge  $challenge
     * @return \Illuminate\Http\Response
     */
    public function destroy($challenge)
    {
        $challenge = Challenge::find($challenge);
        if (!$challenge){
            return response()->json([
                'status' => false,
                'message' => 'Challenge not Exist',
            ]);
        }
        $challenge->delete();
        return response()->json([
            'status' => 1,
            'message' => 'Challenge Deleted Successfully'
        ]);
    }
}
