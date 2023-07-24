<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TestimonialApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $testimonial = Testimonial::latest('id')->paginate(10);
        return response()->json($testimonial);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $testimonial = Testimonial::create([

            "user_id"=>Auth::user()->id,
            "testi_cont"=>$request->testi_cont

        ]);
        return response()->json($testimonial);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $testimonial=Testimonial::find($id);
        if(is_null($testimonial)){
            return response()->json(["message"=>"Data is not found"],404);
        }
        return $testimonial;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $testimonial=Testimonial::find($id);
        if(is_null($testimonial)){
            return response()->json(["message"=>"Data is not found"],404);
        }
        if($request->has('testi_cont')){
            $testimonial->testi_cont=$request->testi_cont;
        }
        $testimonial->update();

        return response()->json($testimonial);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $testimonial=Testimonial::find($id);
        if(is_null($testimonial)){
            return response()->json(["message"=>"Data is not found"],404);
        }
        
            $testimonial->delete();

            return response()->json(["message"=>"Data is deleted"],204);
    }
}
