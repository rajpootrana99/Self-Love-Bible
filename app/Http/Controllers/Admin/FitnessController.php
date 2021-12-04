<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\GeneralTrait;
use App\Models\Fitness;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class FitnessController extends Controller
{
    use GeneralTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('fitness.index');
    }

    public function fetchFitnesses(){
        $fitnesses = Fitness::with('category')->get();
        if ($fitnesses){
            return response()->json([
                'status' => true,
                'fitnesses' => $fitnesses,
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
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'category_id' => 'required',
            'description' => 'required',
            'duration' => 'required|numeric',
            'type' => 'required',
            'media' => 'required|file',
            'thumbnail' => 'required|image|max:1024',
        ]);
        if (!$validator->passes()){
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        }

        $fitness = Fitness::create($request->all());
        $this->storeMedia($fitness);
        if ($fitness){
            return response()->json(['status' => 1, 'message' => 'Fitness Added Successfully']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fitness  $fitness
     * @return \Illuminate\Http\Response
     */
    public function show(Fitness $fitness)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fitness  $fitness
     * @return \Illuminate\Http\Response
     */
    public function edit($fitness)
    {
        $fitness = Fitness::find($fitness);
        if ($fitness){
            return response()->json([
                'status' => 200,
                'fitness' => $fitness,
            ]);
        }
        else{
            return response()->json([
                'status' => 404,
                'message' => 'Fitness not found'
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fitness  $fitness
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $fitness)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'category_id' => 'required',
            'description' => 'required',
            'duration' => 'required|numeric',
            'type' => 'required',
            'media' => 'required|file',
            'thumbnail' => 'required|image|max:1024',
            'information' => 'required',
        ]);
        if (!$validator->passes()){
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        }

        $fitness = Fitness::find($fitness);
        $fitness->update($request->all());
        $this->storeMedia($fitness);
        if ($fitness){
            return response()->json(['status' => 1, 'message' => 'Fitness Updated Successfully']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fitness  $fitness
     * @return \Illuminate\Http\Response
     */
    public function destroy($fitness)
    {
        $fitness = Fitness::find($fitness);
        if (!$fitness){
            return response()->json([
                'status' => 0,
                'message' => 'Fitness not exist'
            ]);
        }
        $fitness->delete();
        return response()->json([
            'status' => 1,
            'message' => 'Fitness Deleted Successfully'
        ]);
    }

    public function storeMedia($fitness){
        $fitness->update([
            'media' => $this->imagePath('media', 'fitness', $fitness),
            'thumbnail' => $this->imagePath('thumbnail', 'fitness', $fitness),
        ]);
    }
}
