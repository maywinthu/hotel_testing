<?php

namespace App\Http\Controllers;

use App\Models\StaffRole;
use Illuminate\Http\Request;

class StaffRoleApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $staffrole = StaffRole::latest('id')->paginate(10);
        return response()->json($staffrole);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "staffrole_title"=>"required",
            "staffrole_desc"=>"required"
        ]);

        $staffrole = StaffRole::create([
            "staffrole_title"=>$request->staffrole_title,
            "staffrole_desc"=>$request->staffrole_desc
           
        ]);
        return response()->json($staffrole);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $staffrole=StaffRole::find($id);
        if(is_null($staffrole)){
            return response()->json(["message"=>"StaffRole is not found"],404);
        }
        return $staffrole;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            "staffrole_title"=>"nullable",
            "staffrole_desc"=>"nullable"
        ]);

        $staffrole=StaffRole::find($id);
        if(is_null($staffrole)){
            return response()->json(["message"=>"StaffRole is not found"],404);
        }

        if($request->has('staffrole_title')){
            $staffrole->staffrole_title=$request->staffrole_title;
        }
        if($request->has('staffrole_desc')){
            $staffrole->staffrole_desc=$request->staffrole_desc;
        }

        $staffrole->update();

        return response()->json($staffrole);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $staffrole=StaffRole::find($id);
        if(is_null($staffrole)){
            return response()->json(["message"=>"StaffRole is not found"],404);
        }
        
            $staffrole->delete();

            return response()->json(["message"=>"StaffRole is deleted"],204);
    }
}
