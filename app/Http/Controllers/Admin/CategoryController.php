<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\GeneralTrait;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    use GeneralTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('category.index');
    }

    public function fetchCategories(){
        $categories = Category::all();
        if ($categories){
            return response()->json([
                'status' => true,
                'categories' => $categories,
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
            'image' => 'required|max:512',
        ]);
        if (!$validator->passes()){
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        }

        $category = Category::create($request->all());
        $this->storeImage($category);
        if ($category){
            return response()->json(['status' => 1, 'message' => 'Category Added Successfully']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($category)
    {
        $category = Category::find($category);
        if ($category){
            return response()->json([
                'status' => 200,
                'category' => $category,
            ]);
        }
        else{
            return response()->json([
                'status' => 404,
                'message' => 'Category not found'
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $category)
    {
        $validator = tap(Validator::make($request->all(),[
            'name' => 'required',
        ]), function (){
            if(request()->hasFile(request()->image)){
                Validator::make(request()->all(),[
                    'image' => 'required|max:512',
                ]);
            }
        });
        if (!$validator->passes()){
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        }

        $category = Category::find($category);
        $category->update($request->all());
        $this->storeImage($category);
        if ($category){
            return response()->json(['status' => 1, 'message' => 'Category Updated Successfully']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($category)
    {
        $category = Category::find($category);
        if (!$category){
            return response()->json([
                'status' => 0,
                'message' => 'Category not exist'
            ]);
        }
        $category->delete();
        return response()->json([
            'status' => 1,
            'message' => 'Category Deleted Successfully'
        ]);
    }

    public function storeImage($category){
        $category->update([
            'image' => $this->imagePath('image', 'category', $category),
        ]);
    }
}
