<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ApiAuthController extends Controller
{
    public function register(Request $request){
       
        $request->validate([
            "name"=>"required|min:2",
            "email"=>"required|email|unique:users",
            "password"=>"required|min:8|confirmed",
            // "password_confirmation"=>"same:password"
            "DOB"=>"required",
            "first_name"=>"required|min:1|max:50",
            "last_name"=>"required|min:1|max:50",
            "phone_no"=>"required",
            "country"=>"required"
        ]);
        
        $user = User::create([
            "name"=>$request->name,
            "email"=>$request->email,
            "password"=>Hash::make($request->password),
            "DOB"=>$request->DOB,
            "first_name"=>$request->first_name,
            "last_name"=>$request->last_name,
            "phone_no"=>$request->phone_no,
            "country"=>$request->country
        ]);

        if(Auth::attempt($request->only(['email','password']))){
            
            $token = Auth::user()->createToken("phone")->plainTextToken;
            return response()->json($token);
        
        //    $token = $request->user()->createToken($request->token_name);
        }
        return response()->json(["message"=>"User not found",401]);

    }

    public function login(Request $request){
        $request->validate([
            "email"=>"required",
            "password"=>"required|min:8"
        ]);
        if(Auth::attempt($request->only(['email','password']))){
            
            $token = Auth::user()->createToken("phone")->plainTextToken;
            return response()->json($token);
        
        //    $token = $request->user()->createToken($request->token_name);
        }
        return response()->json(["message"=>"User not found",401]);
    }

    public function logout(){
        Auth::user()->currentAccessToken()->delete();
        return response()->json(["message"=>"Logout Successfully"],204);
    }


    public function logoutAll(){
        Auth::user()->tokens()->delete();
        return response()->json(["message"=>"Logout Successfully"],204);
    }

    public function tokens(){
        return Auth::user()->tokens;
    }
}
