<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Month;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MonthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('calender.month.index');
    }

    public function fetchMonths(){
        $months = Month::with('topic')->get();
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
            'name' => 'required',
            'topic_id' => 'required'
        ]);
        if (!$validator->passes()){
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        }

        $month = Month::create($request->all());
        if ($month){
            return response()->json(['status' => 1, 'message' => 'Month Added Successfully']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Month  $month
     * @return \Illuminate\Http\Response
     */
    public function show(Month $month)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Month  $month
     * @return \Illuminate\Http\Response
     */
    public function edit($month)
    {
        $month = Month::find($month);
        $topics = Topic::all();
        if ($month){
            return response()->json([
                'status' => 200,
                'month' => $month,
                'topics' => $topics,
            ]);
        }
        else{
            return response()->json([
                'status' => 404,
                'message' => 'Appointment not found'
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Month  $month
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $month)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'topic_id' => 'required'
        ]);
        if (!$validator->passes()){
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        }

        $month = Month::find($month);
        $month->update($request->all());
        if ($month){
            return response()->json(['status' => 1, 'message' => 'Month Updated Successfully']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Month  $month
     * @return \Illuminate\Http\Response
     */
    public function destroy($month)
    {
        $month = Month::find($month);
        if (!$month){
            return response()->json([
                'status' => 0,
                'message' => 'Month not exist'
            ]);
        }
        $month->delete();
        return response()->json([
            'status' => 1,
            'message' => 'Month Deleted Successfully'
        ]);
    }
}
