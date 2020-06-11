<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //
    public function index(){
        $posts = Post::all();
        return view('welcome', compact('posts'));
    }

    public function show(Post $post){
        return view('post', compact('post'));
    }

    public function showVue(Post $post){
        return view('postVue', compact('post'));
    }
}
