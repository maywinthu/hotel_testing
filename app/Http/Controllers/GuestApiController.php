<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use Illuminate\Http\Request;

class GuestApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $guest = Guest::latest('id')->paginate(10);
        return response()->json($guest);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "guest_title"=>"required|min:5|max:100",
            "guest_name"=>"required|min:1|max:50",
            "DOB"=>"required",
            "gender"=>"required|in:male,female",
            "photo"=>"required|file|mimes:jpeg,jpg,png,max:512",
          

            "phone_no"=>"required",
            "email"=>"required|email|unique:users",
            "nrc"=>"required",
            "address"=>"required|min:5|max:50",
            "passport_no"=>"required",

            "post_code"=>"required",
            "city"=>"required",
            "country"=>"required",
            "password"=>"required|min:8|confirmed",

            "first_name"=>"required|min:1|max:50",
            "last_name"=>"required|min:1|max:50"
        ]);
       
        $newName =$request->file('photo')->store("public/guest-imgs");

        $guest = Guest::create([
            "guest_title"=>$request->guest_title,
            "guest_name"=>$request->guest_name,
            "DOB"=>$request->DOB,
            "gender"=>$request->gender,
            "photo"=>$newName,

            "phone_no"=>$request->phone_no,
            "email"=>$request->email,
            "nrc"=>$request->nrc,
            "address"=>$request->address,

            "passport_no"=>$request->passport_no,
            "post_code"=>$request->post_code,
            "city"=>$request->city,
            "country"=>$request->country,

            "password"=>$request->password,
            "first_name"=>$request->first_name,
            "last_name"=>$request->last_name
           
        ]);
        return response()->json($guest);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $guest=Guest::find($id);
        if(is_null($guest)){
            return response()->json(["message"=>"Guest is not found"],404);
        }
        return $guest;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            "guest_title"=>"nullable|min:5|max:100",
            "guest_name"=>"nullable|min:1|max:50",
            "DOB"=>"nullable",
            "gender"=>"nullable|in:male,female",
            "photo"=>"nullable",

            "phone_no"=>"nullable",
            "email"=>"nullable|email|unique:users",
            "nrc"=>"nullable",
            "address"=>"nullable|min:5|max:50",
            "passport_no"=>"nullable",

            "post_code"=>"nullable",
            "city"=>"nullable",
            "country"=>"nullable",
            "password"=>"nullable|min:8|confirmed",

            "first_name"=>"nullable|min:1|max:50",
            "last_name"=>"nullable|min:1|max:50"
        ]);

        $guest=Guest::find($id);
        if(is_null($guest)){
            return response()->json(["message"=>"Guest is not found"],404);
        }
        if($request->has('guest_title')){
            $guest->guest_title=$request->guest_title;
        }
        if($request->has('guest_name')){
            $guest->guest_name=$request->guest_name;
        }
        if($request->has('DOB')){
            $guest->DOB=$request->DOB;
        }
        if($request->has('gender')){
            $guest->gender=$request->gender;
        }

        if($request->has('photo')){
            $guest->photo=$request->photo;
        }
        if($request->has('phone_no')){
            $guest->phone_no=$request->phone_no;
        }
        if($request->has('email')){
            $guest->email=$request->email;
        }
        if($request->has('nrc')){
            $guest->nrc=$request->nrc;
        }
        if($request->has('address')){
            $guest->address=$request->address;
        }
        if($request->has('passport_no')){
            $guest->passport_no=$request->passport_no;
        }


        if($request->has('post_code')){
            $guest->post_code=$request->post_code;
        }
        if($request->has('city')){
            $guest->city=$request->city;
        }
        if($request->has('country')){
            $guest->country=$request->country;
        }
        if($request->has('password')){
            $guest->password=$request->password;
        }


        if($request->has('first_name')){
            $guest->first_name=$request->first_name;
        }
        if($request->has('last_name')){
            $guest->last_name=$request->last_name;
        }

        $guest->update();

        return response()->json($guest);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $guest=Guest::find($id);
        if(is_null($guest)){
            return response()->json(["message"=>"Guest is not found"],404);
        }
        
            $guest->delete();

            return response()->json(["message"=>"Guest is deleted"],204);
    }
}
