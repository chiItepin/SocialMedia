<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Post;
use App\Comment;

class CommentsController extends Controller
{
        // // SOLO USUARIOS LOGUEADOS
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function show(\App\Post $post, $offset)
    {
        // ELOQUENT JOIN
         $comments = Comment::where('post_id', $post->id)->with('profile')->with('user')->skip($offset)->take(10)->latest()->get();

        // // SQL JOIN
        // $comments = DB::table('comments')
        // ->join('profiles', 'comments.user_id', '=', 'profiles.user_id')
        // ->join('users', 'users.id', '=', 'profiles.user_id')

        // ->select('comments.*', 'profiles.id', 'profiles.image', 'users.username')
        // ->where('comments.post_id','=',$post->id)

        // ->get();

        // return compact('comments');
        return response()->json($comments);
    }

    public function store(\App\Post $post)
    {
        $data = request()->validate([
            'comment' => ['required', 'string', 'max:255'],
        ]);

        // con auth() UTILIZAMOS LA SESION DEL USUARIO LOGUEADO
        // auth()->user()->posts()->comments()->create([
        //     'comment' => $data['comment'],
        //     'user_id' => auth()->user()->id,
        //     'post_id' => $post->id,
        // ]);

         \App\Comment::create([
            'comment' => $data['comment'],
            'user_id' => auth()->user()->id,
            'post_id' => $post->id,
        ]);

        return redirect('/p/' . $post->id );

    }
}
