<?php

namespace App\Http\Controllers;

use App\Http\Controllers\HotelApiContoller;
use App\Models\RoomType;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $room = Room::latest('id')->paginate(10);
        return response()->json($room);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "room_type_id"=>"required|exists:room_types,id",
            "room_no"=>"required",
            "hotel_id"=>"required|exists:hotels,id",
            "room_occupancy"=>"required"
        ]);

        $room = Room::create([
            "room_type_id"=>$request->room_type_id,
            "room_no"=>$request->room_no,
            "hotel_id"=>$request->hotel_id,
            "room_occupancy"=>$request->room_occupancy
           
        ]);
        return response()->json($room);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $room=Room::find($id);
        if(is_null($room)){
            return response()->json(["message"=>"Room is not found"],404);
        }
        return $room;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            "room_type_id"=>"nullable|exists:room_types,id",
            "room_no"=>"nullable",
            "hotel_id"=>"nullable|exists:hotels,id",
            "room_occupancy"=>"nullable"
        ]);

        $room=Room::find($id);
        if(is_null($room)){
            return response()->json(["message"=>"Room is not found"],404);
        }
        if($request->has('room_type_id')){
            $room->room_type_id=$request->room_type_id;
        }
        if($request->has('room_no')){
            $room->room_no=$request->room_no;
        }
        if($request->has('hotel_id')){
            $room->hotel_id=$request->hotel_id;
        }
        if($request->has('room_occupancy')){
            $room->room_occupancy=$request->room_occupancy;
        }

        $room->update();

        return response()->json($room);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $room=Room::find($id);
        if(is_null($room)){
            return response()->json(["message"=>"Room is not found"],404);
        }
        
            $room->delete();

            return response()->json(["message"=>"Room is deleted"],204);
    }
}
