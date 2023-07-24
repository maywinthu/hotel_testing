<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;

class BannerApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banner = Banner::latest('id')->paginate(10);
        return response()->json($banner);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "banner_src"=>"required|file|mimes:jpeg,jpg,png,max:512",
            "alt_text"=>"required",
            "public_status"=>"required"
        ]);
        if($request->hasFile('banner_src')){
            $newName =$request->file('banner_src')->store("public/banner-imgs");
        }else{
            $newName =$request->prev_photo;
        }
        
        $banner = Banner::create([
            "banner_src"=>$newName,
            "alt_text"=>$request->alt_text,
            "public_status"=>$request->public_status
           
        ]);
        return response()->json($banner);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $banner=Banner::find($id);
        if(is_null($banner)){
            return response()->json(["message"=>"Banner is not found"],404);
        }
        return $banner;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            "banner_src"=>"nullable|file|mimes:jpeg,jpg,png,max:512",
            "alt_text"=>"nullable"
        ]);

        $banner=Banner::find($id);
        if(is_null($banner)){
            return response()->json(["message"=>"Banner is not found"],404);
        }

        if($request->hasFile('banner_src')){
            $newName =$request->file('banner_src')->store("public/banner-imgs");
        }else{
            $newName =$request->prev_photo;
        }
        if($request->has('alt_text')){
            $banner->alt_text=$request->alt_text;
        }

        $banner->update();

        return response()->json($banner);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $banner=Banner::find($id);
        if(is_null($banner)){
            return response()->json(["message"=>"Banner is not found"],404);
        }
        
            $banner->delete();

            return response()->json(["message"=>"Banner is deleted"],204);
    }
}
