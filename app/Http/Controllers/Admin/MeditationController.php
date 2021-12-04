<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\GeneralTrait;
use App\Models\Meditation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MeditationController extends Controller
{
    use GeneralTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('meditation.index');
    }

    public function fetchMeditations(){
        $meditations = Meditation::all();
        if ($meditations){
            return response()->json([
                'status' => true,
                'meditations' => $meditations,
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
        $validator = tap(Validator::make($request->all(),[
            'information' => 'required',
        ]), function (){
            if(request()->hasFile(request()->image)){
                Validator::make(request()->all(),[
                    'media' => 'required|file',
                ]);
            }
        });
        if (!$validator->passes()){
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        }

        $meditation = Meditation::create($request->all());
        $this->storeMedia($meditation);
        if ($meditation){
            return response()->json(['status' => 1, 'message' => 'Meditation Added Successfully']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Meditation  $meditation
     * @return \Illuminate\Http\Response
     */
    public function show(Meditation $meditation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Meditation  $meditation
     * @return \Illuminate\Http\Response
     */
    public function edit($meditation)
    {
        $meditation = Meditation::find($meditation);
        if ($meditation){
            return response()->json([
                'status' => 200,
                'meditation' => $meditation,
            ]);
        }
        else{
            return response()->json([
                'status' => 404,
                'message' => 'Meditation not found'
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Meditation  $meditation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $meditation)
    {
        $validator = tap(Validator::make($request->all(),[
            'information' => 'required',
        ]), function (){
            if(request()->hasFile(request()->image)){
                Validator::make(request()->all(),[
                    'media' => 'required|file',
                ]);
            }
        });
        if (!$validator->passes()){
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        }

        $meditation = Meditation::find($meditation);
        $meditation->update($request->all());
        $this->storeMedia($meditation);
        if ($meditation){
            return response()->json(['status' => 1, 'message' => 'Meditation Updated Successfully']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Meditation  $meditation
     * @return \Illuminate\Http\Response
     */
    public function destroy($meditation)
    {
        $meditation = Meditation::find($meditation);
        if (!$meditation){
            return response()->json([
                'status' => 0,
                'message' => 'Meditation not exist'
            ]);
        }
        $meditation->delete();
        return response()->json([
            'status' => 1,
            'message' => 'Meditation Deleted Successfully'
        ]);
    }

    public function storeMedia($meditation){
        $meditation->update([
            'media' => $this->imagePath('media', 'meditation', $meditation),
        ]);
    }
}
