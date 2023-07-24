<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Room;

class BookingApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $booking = Booking::latest('id')->paginate(10);
        return response()->json($booking);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "guest_id"=>"required",
            "room_id"=>"required",
            "checkin_date"=>"required",
            "checkout_date"=>"required",
            "num_adults"=>"required",
            "num_children"=>"required",
            "special_request"=>"required"
        ]);

        $booking = Booking::create([
            "guest_id"=>$request->guest_id,
            "room_id"=>$request->room_id,
            "checkin_date"=>$request->checkin_date,
            "checkout_date"=>$request->checkout_date,
            "num_adults"=>$request->num_adults,
            "num_children"=>$request->num_children,
            "special_request"=>$request->special_request
           
        ]);
        return response()->json($booking);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $booking=Booking::find($id);
        if(is_null($booking)){
            return response()->json(["message"=>"Booking is not found"],404);
        }
        return $booking;
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
        $booking=Booking::find($id);
        if(is_null($booking)){
            return response()->json(["message"=>"Booking is not found"],404);
        }
        
            $booking->delete();

            return response()->json(["message"=>"Booking is deleted"],204);
    }

    public function available_rooms(Request $request,$checkin_date){
        $arooms = DB::SELECT("SELECT * FROM rooms WHERE id NOT IN (SELECT room_id FROM bookings WHERE '$checkin_date' BETWEEN checkin_date AND checkout_date)");
        return response()->json($arooms);
    }
}
