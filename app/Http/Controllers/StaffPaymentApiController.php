<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\StaffPayment;
use Illuminate\Http\Request;

class StaffPaymentApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $staffpayment = StaffPayment::latest('id')->paginate(10);
        return response()->json($staffpayment);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        {
            $request->validate([
                "staff_id"=>"required|exists:staff,id",
                "amount"=>"required",
                "payment_date"=>"required"
            ]);
    
            $staffpayment = StaffPayment::create([
                "staff_id"=>$request->staff_id,
                "amount"=>$request->amount,
                "payment_date"=>$request->payment_date
            ]);
            return response()->json($staffpayment);
    }
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $staffpayment=StaffPayment::find($id);
        if(is_null($staffpayment)){
            return response()->json(["message"=>"StaffPayment is not found"],404);
        }
        return $staffpayment;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        $request->validate([
            "staff_id"=>"nullable|exists:staff,id",
            "amount"=>"nullable",
            "payment_date"=>"nullable"
        ]);
       
        $staffpayment=StaffPayment::find($id);
        if(is_null($staffpayment)){
            return response()->json(["message"=>"StaffPayment is not found"],404);
        }
        
        if($request->has('staff_id')){
            $staffpayment->staff_id=$request->staff_id;
        }
        
        if($request->has('amount')){
            $staffpayment->amount=$request->amount;
        }
        
        if($request->has('payment_date')){
            $staffpayment->payment_date=$request->payment_date;
        }

        $staffpayment->update();

        return response()->json($staffpayment);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $staffpayment=StaffPayment::find($id);
        if(is_null($staffpayment)){
            return response()->json(["message"=>"StaffPayment is not found"],404);
        }
        
            $staffpayment->delete();

            return response()->json(["message"=>"StaffPayment is deleted"],204);
    }
}
