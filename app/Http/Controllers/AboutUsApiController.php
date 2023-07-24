<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use Illuminate\Http\Request;

class AboutUsApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $about = AboutUs::latest('id')->paginate(10);
        return response()->json($about);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "photo"=>"required|file|mimes:jpeg,jpg,png,max:512",
            "title"=>"required",
            "description"=>"required"
        ]);
        if($request->hasFile('photo')){
            $newName =$request->file('photo')->store("public/AboutUs-imgs");
        }else{
            $newName =$request->prev_photo;
        }
        
        $about = AboutUs::create([
            "photo"=>$newName,
            "title"=>$request->title,
            "description"=>$request->description
           
        ]);
        return response()->json($about);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $about=AboutUs::find($id);
        if(is_null($about)){
            return response()->json(["message"=>"AboutUs is not found"],404);
        }
        return $about;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            "photo"=>"nullable|file|mimes:jpeg,jpg,png,max:512",
            "title"=>"nullable",
            "description"=>"nullable"
        ]);

        $about=AboutUs::find($id);
        if(is_null($about)){
            return response()->json(["message"=>"AboutUs is not found"],404);
        }

        if($request->hasFile('photo')){
            $newName =$request->file('photo')->store("public/AboutUs-imgs");
        }else{
            $newName =$request->prev_photo;
        }
        if($request->has('title')){
            $about->title=$request->title;
        }
        if($request->has('description')){
            $about->description=$request->description;
        }

        $about->update();

        return response()->json($about);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $about=AboutUs::find($id);
        if(is_null($about)){
            return response()->json(["message"=>"AboutUs is not found"],404);
        }
        
            $about->delete();

            return response()->json(["message"=>"AboutUs is deleted"],204);
    }
}
