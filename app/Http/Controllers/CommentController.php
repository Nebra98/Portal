<?php

namespace App\Http\Controllers;

use App\Comment;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'body' => 'required',
        ]);

        $input = $request->all();
        $input['user_id'] = Auth::user()->id;

        $comment = new Comment;
        $comment->user_id =  Auth::user()->id;
        $comment->parent_id = $request->input('parent_id');
        $comment->news_id = $request->input('news_id');
        $comment->body = $request->input('body');

        $comment->save();

        return back();

    }

    public function destroy(Comment $comment)
    {

        if (Auth::user()->id == $comment->user_id)
        {
            if($comment->delete()){
                session()->flash('success', "Comment is deleted successfully.");
                return back();
            }
        }else{
            session()->flash('error', "Something went wrong!");
            return back();
        }

    }



}
