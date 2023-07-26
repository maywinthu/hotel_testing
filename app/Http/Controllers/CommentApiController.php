<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class CommentApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comment = Comment::latest('id')->paginate(10);
        return response()->json($comment);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $comment = Comment::create([
            $user_login_id = auth()->id(),
            "user_id"=>$user_login_id,
            "post_id"=>$request->id,
            "comment"=>$request->comment

        ]);
        return response()->json($comment);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $comment=Comment::find($id);
        if(is_null($comment)){
            return response()->json(["message"=>"Comment is not found"],404);
        }
        return $comment;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $comment=Comment::find($id);
        if(is_null($comment)){
            return response()->json(["message"=>"Comment is not found"],404);
        }
        if($request->has('comment')){
            $comment->comment=$request->comment;
        }

        $comment->update();

        return response()->json($comment);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $comment=Comment::find($id);
        if(is_null($comment)){
            return response()->json(["message"=>"comment is not found"],404);
        }
        
            $comment->delete();

            return response()->json(["message"=>"comment is deleted"],204);
    }

    public function comments(Request $request){
        $comments = Comment::where('post_id',$request->id)->get();

        foreach($comments as $comment){
            $comment->user;
        }
        return response()->json(['success'=>true,'comment'=>$comment]);
    }
}
