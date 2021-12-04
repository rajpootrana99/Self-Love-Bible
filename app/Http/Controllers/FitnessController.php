<?php

namespace App\Http\Controllers;

use App\Models\Fitness;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FitnessController extends Controller
{
    public function fetchFitnesses(Request $request){
        $fitnesses = Fitness::where('category_id', $request->category_id)->get();
        return response([
            'status' => true,
            'fitnesses' => $fitnesses,
        ]);
    }

    public function todayFitnessSugestions(){
        $date = Carbon::now()->format('Y-m-d');
        $suggestedFitness = Fitness::where('created_at', $date)->get();
        return response([
            'status' => true,
            'suggestedFitness' => $suggestedFitness,
        ]);
    }
}
