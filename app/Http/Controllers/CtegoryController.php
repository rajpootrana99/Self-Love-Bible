<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CtegoryController extends Controller
{
    public function fetchCategories(){
        $categories = Category::all();
        return response([
            'status' => true,
            'categories' => $categories,
        ]);
    }
}
