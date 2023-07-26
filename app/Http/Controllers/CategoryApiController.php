<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = Category::latest('id')->paginate(10);
        return response()->json($category);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "category"=>"required",
        ]);

        $category = Category::create([
            "category"=>$request->category
           
        ]);
        return response()->json($category);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category=Category::find($id);
        if(is_null($category)){
            return response()->json(["message"=>"Category is not found"],404);
        }
        return $category;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            "category"=>"nullable"
        ]);

        $category=Category::find($id);
        if(is_null($category)){
            return response()->json(["message"=>"Category is not found"],404);
        }
        if($request->has('category')){
            $category->category=$request->category;
        }
        $category->update();

        return response()->json($category);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category=Category::find($id);
        if(is_null($category)){
            return response()->json(["message"=>"Category is not found"],404);
        }
        
            $category->delete();

            return response()->json(["message"=>"Category is deleted"],204);
    }
}
