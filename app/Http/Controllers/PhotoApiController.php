<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;

class PhotoApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $photos=Photo::latest('id')->paginate(10);
        return response($photos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
        $request->validate([
            "room_type_id"=>"required|exists:room_types,id",
            "photos"=>"required",
            "photos.*"=>"file|mimes:jpeg,jpg,png,max:512"
        ]);

        foreach($request->file('photos')as $photo){
            $newName = $photo->store("public");
            Photo::create([
                "room_type_id"=>$request->room_type_id,
                "name"=>$newName
            ]);
        }
        return response()->json(["message"=>"Photo are uploaded"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $photo=Photo::find($id);
        if(is_null($photo)){
            return response()->json(["message"=>"Photo is not found"],404);
        }
        $photo->delete();
        return response()->json([],204);
    }
}
