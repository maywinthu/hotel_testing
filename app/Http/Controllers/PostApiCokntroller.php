<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class PostApiCokntroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $post = Post::latest('id')->paginate(10);
        return response()->json($post);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            // "user_id"=>"required|exists:users,id",
            "title"=>"required",
            "photo"=>"required|file|mimes:jpeg,jpg,png,max:512",
            "small_desc"=>"required",
            "long_desc"=>"required"
        ]);

        $newName =$request->file('photo')->store("public/post-imgs");

        $post = Post::create([

            "user_id"=>Auth::user()->id,
            "title"=>$request->title,
            "photo"=>$newName,
            "small_desc"=>$request->small_desc,
            "long_desc"=>$request->long_desc

        ]);
        return response()->json($post);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post=Post::find($id);
        if(is_null($post)){
            return response()->json(["message"=>"Post is not found"],404);
        }
        return $post;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {   
        $request->validate([
            "title"=>"nullable",
            "photo"=>"nullable",
            "small_desc"=>"nullable",
            "long_desc"=>"nullable"
        ]);

        $post=Post::find($id);
        if(is_null($post)){
            return response()->json(["message"=>"Post is not found"],404);
        }
        if($request->has('title')){
            $post->title=$request->title;
        }
        if($request->has('photo')){
            $post->photo=$request->photo;
        }
        if($request->has('small_desc')){
            $post->small_desc=$request->small_desc;
        }
        if($request->has('long_desc')){
            $post->long_desc=$request->long_desc;
        }

        $post->update();

        return response()->json($post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post=Post::find($id);
        if(is_null($post)){
            return response()->json(["message"=>"Post is not found"],404);
        }
        
            $post->delete();

            return response()->json(["message"=>"Post is deleted"],204);
    }

    public function eposts(){
        $posts = Post::orderBy('id','desc')->get();

        foreach ($posts as $post) {
            // get user of post
            $post -> user;
            //comment count
            $post['commentscount'] =  count($post -> comments);
            //like count
            $post['likescount'] =  count($post -> likes);
            //check if user like his own post
            $post['selflike'] = false;
            foreach($post -> likes as $like){
                if($like -> user_id == Auth::user()->id){
                    $post['selflike'] = true;
                }
            }
        }
    }
}
