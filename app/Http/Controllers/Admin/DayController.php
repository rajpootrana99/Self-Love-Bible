<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Day;
use App\Models\Month;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('calender.day.index');
    }

    public function fetchDays(){
        $days = Day::with('topic', 'month')->get();
        if ($days){
            return response()->json([
                'status' => true,
                'days' => $days,
            ]);
        }
    }

    public function fetchSpecificMonths($topic){
        $months = Month::where('topic_id', $topic)->get();
        if ($months){
            return response()->json([
                'status' => true,
                'months' => $months,
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
            'day' => 'required',
            'detail' => 'required',
            'topic_id' => 'required',
            'month_id' => 'required'
        ]);
        if (!$validator->passes()){
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        }

        $day = Day::create($request->all());
        if ($day){
            return response()->json(['status' => 1, 'message' => 'Day Added Successfully']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Day  $day
     * @return \Illuminate\Http\Response
     */
    public function show(Day $day)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Day  $day
     * @return \Illuminate\Http\Response
     */
    public function edit($day)
    {
        $day = Day::find($day);
        $topics = Topic::all();
        $months = Month::where('topic_id', $day->topic_id)->get();
        if ($day){
            return response()->json([
                'status' => 200,
                'day' => $day,
                'months' => $months,
                'topics' => $topics,
            ]);
        }
        else{
            return response()->json([
                'status' => 404,
                'message' => 'Day not found'
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Day  $day
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $day)
    {
        $validator = Validator::make($request->all(), [
            'day' => 'required',
            'detail' => 'required',
            'month_id' => 'required'
        ]);
        if (!$validator->passes()){
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        }

        $day = Day::find($day);
        $day->update($request->all());
        if ($day){
            return response()->json(['status' => 1, 'message' => 'Day Updated Successfully']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Day  $day
     * @return \Illuminate\Http\Response
     */
    public function destroy($day)
    {
        $day = Day::find($day);
        if (!$day){
            return response()->json([
                'status' => 0,
                'message' => 'Day not exist'
            ]);
        }
        $day->delete();
        return response()->json([
            'status' => 1,
            'message' => 'Day Deleted Successfully'
        ]);
    }
}
