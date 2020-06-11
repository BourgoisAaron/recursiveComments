<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    //

    public function store(Request $request, $id){
        $input = $request->only('title', 'text');
        $input['post_id'] = $id;
        $input['author'] = Auth::user()->name;

        Comment::create($input);
        session()->flash('message', 'Comment placed!');

        return redirect()->back();
    }

    public function reply(Request $request, $id){
        $input = $request->only('title', 'text');
        $input['comment_id'] = $id;
        $input['author'] = Auth::user()->name;

        Comment::create($input);
        session()->flash('message', 'Comment placed!');

        return redirect()->back();
    }

    public function replies($id){
        $replies = Comment::where('comment_id', '=', $id)->get();

        foreach ($replies as $reply){
            if(Comment::where('comment_id', '=', $reply->id)->first()){
                $reply->no_replies = false;
            }else{
                $reply->no_replies = true;
            }
        }

        return response(json_encode($replies));
    }

    public function sendReply(Request $request, $id){
        $input = $request->only('title', 'text', 'author');
        $input['comment_id'] = $id;
        Comment::create($input);

        return response(json_encode($request->all()));
    }
}
