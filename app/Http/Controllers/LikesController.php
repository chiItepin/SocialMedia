<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LikesController extends Controller
{

    // Logged in users only
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(\App\Post $post)
    {
        // toggle the relation method liked() of user class with the post id
        return auth()->user()->liked()->toggle($post->id);
    }
}
