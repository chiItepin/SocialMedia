<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Cache as IlluminateCache;
use App\Post;
use App\User;

class PostsController extends Controller
{

    // // SOLO USUARIOS LOGUEADOS
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = auth()->user()->following()->pluck('profiles.user_id');

        // add our user id to collection object array
        $users = $users->push(auth()->user()->id);

        // $posts = Post::whereIn('user_id', $users)->with('user')->latest()->paginate(10);

        $posts = Post::whereIn('user_id', $users)->latest()->paginate(10);

        return view('posts.index', compact('posts'));

    }

    public function create()
    {
        return view('posts.create');
    }

    // retrieve user posts
    public function profileindex($profile, $offset)
    {

        $posts = Post::where('user_id', $profile)->with('user')->with('profile')->with('likesuser')->with('likes')->with('commentscount')->skip($offset)->take(10)->latest()->get();

        return response()->json($posts);

    }

    // home page
    public function showindex($offset)
    {
        $users = auth()->user()->following()->pluck('profiles.user_id');

        // add our user id to collection object array
        $users = $users->push(auth()->user()->id);

        // $posts = Post::whereIn('user_id', $users)->with('user')->latest()->paginate(10);

        $posts = Post::whereIn('user_id', $users)->with('user')->with('profile')->with('likesuser')->with('likes')->with('commentscount')->skip($offset)->take(10)->latest()->get();

        return response()->json($posts);

    }

    public function store()
    {
        $data = request()->validate([
            'caption' => ['required', 'string', 'max:255'],
            'image' => ['required', 'image'],
        ]);

        $imagePath = request('image')->store('uploads', 'public');

        $image = Image::make(public_path('storage/'.$imagePath))->fit(1200, 1200);
        $image->save();

        // con auth() UTILIZAMOS LA SESION DEL USUARIO LOGUEADO
        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image' => $imagePath,
        ]);

        return redirect('/profile/' . auth()->user()->id )->with('status', 'Post created!');

    }

    public function show(\App\Post $post)
    {
        // return view('posts.show',[
        //     'post' => $post,
        // ]);

        // pass in comments
        $comments = $post->comments;

        $commentsCount = IlluminateCache::remember('count.comments' . $post->id, now()->addSeconds(30), function () use ($post) {
            return $post->comments->count();
        });

        // pass in data if user has liked the post
        $likes = (auth()->user()) ?  auth()->user()->liked->contains($post->id) : false;

        $follows = (auth()->user()) ?  auth()->user()->following->contains($post->user->profile->id) : false;

        // how many likes does the post have and cache it
        $likesCount = IlluminateCache::remember('count.likes' . $post->id, now()->addSeconds(30), function () use ($post) {
            return $post->likes->count();
        });


        return view('posts.show', compact('post','follows','likes','likesCount','comments','commentsCount'));


    }


    // home page
    public function search($query)
    {

        $users = User::where('name', 'LIKE', '%'.$query.'%')->with('postsCount')->with('profile')->skip(0)->take(5)->latest()->get();

        return response()->json($users);

    }



}
