<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use Illuminate\Http\Request;

class BillApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bill = Bill::latest('id')->paginate(10);
        return response()->json($bill);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "invoice_no"=>"required",
            "booking_id"=>"required|exists:bookings,id",
            "guest_id"=>"required|exists:guests,id",
            "room_charge"=>"required",

            "room_service"=>"required",
            "restaurant_charges"=>"required",
            "bar_charges"=>"required",
            "misc_charges"=>"required",

            "late_checkout_charges"=>"required",
            "payment_date"=>"required",
            "payment_mode"=>"required",
            "creditcard_no"=>"required",

            "expire_date"=>"required",
            "cheque_no"=>"required"
        ]);

        $bill = Bill::create([
            "invoice_no"=>$request->invoice_no,
            "booking_id"=>$request->booking_id,
            "guest_id"=>$request->guest_id,
            "room_charge"=>$request->room_charge,

            "room_service"=>$request->room_service,
            "restaurant_charges"=>$request->restaurant_charges,
            "bar_charges"=>$request->bar_charges,
            "misc_charges"=>$request->misc_charges,

            "late_checkout_charges"=>$request->late_checkout_charges,
            "payment_date"=>$request->payment_date,
            "payment_mode"=>$request->payment_mode,
            "creditcard_no"=>$request->creditcard_no,

            "expire_date"=>$request->expire_date,
            "cheque_no"=>$request->cheque_no
           
        ]);
        return response()->json($bill);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $bill=Bill::find($id);
        if(is_null($bill)){
            return response()->json(["message"=>"Bill is not found"],404);
        }
        return $bill;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            "invoice_no"=>"nullable",
            "booking_id"=>"nullable|exists:bookings,id",
            "guest_id"=>"nullable|exists:guests,id",
            "room_charge"=>"nullable",

            "room_service"=>"nullable",
            "restaurant_charges"=>"nullable",
            "bar_charges"=>"nullable",
            "misc_charges"=>"nullable",

            "late_checkout_charges"=>"nullable",
            "payment_date"=>"nullable",
            "payment_mode"=>"nullable",
            "creditcard_no"=>"nullable",

            "expire_date"=>"nullable",
            "cheque_no"=>"nullable"
        ]);

        $bill=Bill::find($id);
        if(is_null($bill)){
            return response()->json(["message"=>"Bill is not found"],404);
        }

        if($request->has('invoice_no')){
            $bill->invoice_no=$request->invoice_no;
        }
        if($request->has('room_charge')){
            $bill->room_charge=$request->room_charge;
        }
        if($request->has('room_service')){
            $bill->room_service=$request->room_service;
        }
        if($request->has('restaurant_charges')){
            $bill->restaurant_charges=$request->restaurant_charges;
        }

        if($request->has('bar_charges')){
            $bill->bar_charges=$request->bar_charges;
        }
        if($request->has('misc_charges')){
            $bill->misc_charges=$request->misc_charges;
        }
        if($request->has('late_checkout_charges')){
            $bill->late_checkout_charges=$request->late_checkout_charges;
        }
        if($request->has('payment_date')){
            $bill->payment_date=$request->payment_date;
        }

        if($request->has('payment_mode')){
            $bill->payment_mode=$request->payment_mode;
        }

        if($request->has('creditcard_no')){
            $bill->creditcard_no=$request->creditcard_no;
        }
        if($request->has('expire_date')){
            $bill->expire_date=$request->expire_date;
        }
        if($request->has('cheque_no')){
            $bill->cheque_no=$request->cheque_no;
        }

        $bill->update();

        return response()->json($bill);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $bill=Bill::find($id);
        if(is_null($bill)){
            return response()->json(["message"=>"Bill is not found"],404);
        }
        
            $bill->delete();

            return response()->json(["message"=>"Bill is deleted"],204);
    }
}
