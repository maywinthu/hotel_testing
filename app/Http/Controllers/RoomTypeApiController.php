<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\RoomType;
use Illuminate\Http\Request;

class RoomTypeApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roomtype = RoomType::latest('id')->paginate(10);
        return response()->json($roomtype);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "room_name"=>"required|min:8|max:50",
            "room_price"=>"required|numeric|min:10000",
            "default_room_price"=>"required|numeric|min:10000",
            "rooming"=>"required",
            "room_description"=>"required",
            "room_size"=>"required",
            "facilities"=>"required",
            "photos"=>"required",
            "photos.*"=>"file|mimes:jpeg,jpg,png,max:512"
        ]);

        $roomtype = RoomType::create([
            "room_name"=>$request->room_name,
            "room_price"=>$request->room_price,
            "default_room_price"=>$request->default_room_price,
            "rooming"=>$request->rooming,
            "room_description"=>$request->room_description,
            "room_size"=>$request->room_size,
            "facilities"=>$request->facilities
           
        ]);

        $photos=[];
        foreach($request->file('photos')as $photo){
            $newName = $photo->store("public/roomtype-imgs");
            $photos[]=new Photo(['name'=>$newName]);
        }
        $roomtype->photos()->saveMany($photos);
        return response()->json($roomtype);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $roomtype=RoomType::find($id);
        if(is_null($roomtype)){
            return response()->json(["message"=>"RoomType is not found"],404);
        }
        return $roomtype;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            "room_name"=>"nullable|min:8|max:50",
            "room_price"=>"nullable|numeric|min:10000",
            "default_room_price"=>"nullable|numeric|min:10000",
            "rooming"=>"nullable",
            "room_description"=>"nullable",
            "room_size"=>"nullable",
            "facilities"=>"nullable"
        ]);

        $roomtype=RoomType::find($id);
        if(is_null($roomtype)){
            return response()->json(["message"=>"RoomType is not found"],404);
        }

        if($request->has('room_name')){
            $roomtype->room_name=$request->room_name;
        }
        if($request->has('room_price')){
            $roomtype->room_price=$request->room_price;
        }
        if($request->has('default_room_price')){
            $roomtype->default_room_price=$request->default_room_price;
        }
        if($request->has('rooming')){
            $roomtype->rooming=$request->rooming;
        }
        if($request->has('room_description')){
            $roomtype->room_description=$request->room_description;
        }
        if($request->has('room_size')){
            $roomtype->room_size=$request->room_size;
        }
        if($request->has('facilities')){
            $roomtype->facilities=$request->facilities;
        }
        $roomtype->update();

            return response()->json($roomtype);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $roomtype=RoomType::find($id);
        if(is_null($roomtype)){
            return response()->json(["message"=>"RoomType is not found"],404);
        }
        
            $roomtype->delete();

            return response()->json(["message"=>"RoomType is deleted"],204);
    }
}
