<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('calender.topic.index');
    }

    public function fetchTopics(){
        $topics = Topic::all();
        return response()->json([
            'status' => true,
            'topics' => $topics,
        ]);
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
            'name' => 'required|unique:topics',
        ]);
        if (!$validator->passes()){
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        }

        $topic = Topic::create($request->all());
        if ($topic){
            return response()->json(['status' => 1, 'message' => 'Topic Added Successfully']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function show(Topic $topic)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function edit($topic)
    {
        $topic = Topic::find($topic);
        if ($topic){
            return response()->json([
                'status' => 200,
                'topic' => $topic,
            ]);
        }
        else{
            return response()->json([
                'status' => 404,
                'message' => 'Topic not found'
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $topic)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:topics',
        ]);
        if (!$validator->passes()){
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        }

        $topic = Topic::find($topic);
        $topic->update($request->all());
        if ($topic){
            return response()->json(['status' => 1, 'message' => 'Topic Updated Successfully']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function destroy($topic)
    {
        $topic = Topic::find($topic);
        if (!$topic){
            return response()->json([
                'status' => 0,
                'message' => 'Topic not exist'
            ]);
        }
        $topic->delete();
        return response()->json([
            'status' => 1,
            'message' => 'Topic Deleted Successfully'
        ]);
    }
}
