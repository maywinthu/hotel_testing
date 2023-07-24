<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;

class StaffApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $staff = Staff::latest('id')->paginate(10);
        return response()->json($staff);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            "staffrole_id"=>"required|exists:staff_roles,id",
            "name"=>"required|min:1|max:50",
            "photo"=>"required|file|mimes:jpeg,jpg,png,max:512",
            "bio"=>"required|min:1|max:100",

            "DOB"=>"required",
            "gender"=>"required|in:male,female",
            "phone"=>"required",
            "email"=>"required|email|unique:users",

            "password"=>"required|min:8|confirmed",
            "salary_type"=>"required",
            "salary_amount"=>"required",
            "first_name"=>"required|min:1|max:50",
            "last_name"=>"required|min:1|max:50"
        ]);

        $newName =$request->file('photo')->store("public/staff-imgs");

        $staff = Staff::create([
            "staffrole_id"=>$request->staffrole_id,
            "name"=>$request->name,
            "photo"=>$newName,
            "bio"=>$request->bio,

            "DOB"=>$request->DOB,
            "gender"=>$request->gender,
            "phone"=>$request->phone,
            "email"=>$request->email,

            "password"=>$request->password,
            "salary_type"=>$request->salary_type,
            "salary_amount"=>$request->salary_amount,
            "first_name"=>$request->first_name,
            "last_name"=>$request->last_name
           
        ]);
        return response()->json($staff);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $staff=Staff::find($id);
        if(is_null($staff)){
            return response()->json(["message"=>"Staff is not found"],404);
        }
        return $staff;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        $request->validate([
            "staffrole_id"=>"nullable|exists:staff_roles,id",
            "name"=>"nullable|min:1|max:50",
            "photo"=>"nullable",
            "bio"=>"nullable|min:1|max:100",

            "DOB"=>"nullable",
            "gender"=>"nullable|in:male,female",
            "phone"=>"nullable",
            "email"=>"nullable|email|unique:users",

            "password"=>"nullable|min:8|confirmed",
            "salary_type"=>"nullable",
            "salary_amount"=>"nullable",
            "first_name"=>"nullable|min:1|max:50",
            "last_name"=>"nullable|min:1|max:50"
        ]);

        $staff=Staff::find($id);
        if(is_null($staff)){
            return response()->json(["message"=>"Staff is not found"],404);
        }
        if($request->has('name')){
            $staff->name=$request->name;
        }
        if($request->has('photo')){
            $staff->photo=$request->photo;
        }
        if($request->has('bio')){
            $staff->bio=$request->bio;
        }
        if($request->has('DOB')){
            $staff->DOB=$request->DOB;
        }
        if($request->has('gender')){
            $staff->gender=$request->gender;
        }
        if($request->has('email')){
            $staff->email=$request->email;
        }
        if($request->has('password')){
            $staff->password=$request->password;
        }
        if($request->has('salary_type')){
            $staff->salary_type=$request->salary_type;
        }
        if($request->has('salary_amount')){
            $staff->salary_amount=$request->salary_amount;
        }
        if($request->has('first_name')){
            $staff->first_name=$request->first_name;
        }
        if($request->has('last_name')){
            $staff->last_name=$request->last_name;
        }
        $staff->update();

            return response()->json($staff);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $staff=Staff::find($id);
        if(is_null($staff)){
            return response()->json(["message"=>"Staff is not found"],404);
        }
        
            $staff->delete();

            return response()->json(["message"=>"Staff is deleted"],204);
    }
}
