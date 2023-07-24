<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;

class HotelApiContoller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hotel = Hotel::latest('id')->paginate(10);
        return response()->json($hotel);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "hotel_code"=>"required",
            "hotel_name"=>"required",
            "address"=>"required",
            "post_code"=>"required",
            "city"=>"required",
            "country"=>"required",
            "num_rooms"=>"required",
            "phone_no"=>"required",
            "star_rating"=>"required"
        ]);

        $hotel = Hotel::create([
            "hotel_code"=>$request->hotel_code,
            "hotel_name"=>$request->hotel_name,
            "address"=>$request->address,
            "post_code"=>$request->post_code,
            "city"=>$request->city,
            "country"=>$request->country,
            "num_rooms"=>$request->num_rooms,
            "phone_no"=>$request->phone_no,
            "star_rating"=>$request->star_rating
           
        ]);
        return response()->json($hotel);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $hotel=Hotel::find($id);
        if(is_null($hotel)){
            return response()->json(["message"=>"Hotel is not found"],404);
        }
        return $hotel;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        $request->validate([
            "hotel_code"=>"nullable",
            "hotel_name"=>"nullable",
            "address"=>"nullable",
            "post_code"=>"nullable",
            "city"=>"nullable",
            "country"=>"nullable",
            "num_rooms"=>"nullable",
            "phone_no"=>"nullable",
            "star_rating"=>"nullable"
        ]);

        $hotel=Hotel::find($id);
        if(is_null($hotel)){
            return response()->json(["message"=>"Room is not found"],404);
        }
        if($request->has('hotel_code')){
            $hotel->hotel_code=$request->hotel_code;
        }
        if($request->has('hotel_name')){
            $hotel->hotel_name=$request->hotel_name;
        }
        if($request->has('address')){
            $hotel->address=$request->address;
        }
        if($request->has('post_code')){
            $hotel->post_code=$request->post_code;
        }
        if($request->has('city')){
            $hotel->city=$request->city;
        }
        if($request->has('country')){
            $hotel->country=$request->country;
        }
        if($request->has('num_rooms')){
            $hotel->num_rooms=$request->num_rooms;
        }
        if($request->has('phone_no')){
            $hotel->phone_no=$request->phone_no;
        }
        if($request->has('star_rating')){
            $hotel->star_rating=$request->star_rating;
        }
        $hotel->update();

        return response()->json($hotel);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $hotel=Hotel::find($id);
        if(is_null($hotel)){
            return response()->json(["message"=>"Hotel is not found"],404);
        }
        
            $hotel->delete();

            return response()->json(["message"=>"Hotel is deleted"],204);
    }
}
