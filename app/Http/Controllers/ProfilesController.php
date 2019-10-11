<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache as IlluminateCache;
use Intervention\Image\Facades\Image;

class ProfilesController extends Controller
{
    public function index(\App\User $user)
    {
        // return view('profiles.index', [
        //     'user' => $user,
        // ]);

        $postCount = IlluminateCache::remember('count.posts' . $user->id, now()->addSeconds(30), function () use ($user) {
            return $user->posts->count();
        });

        $followersCount = IlluminateCache::remember('count.followers' . $user->id, now()->addSeconds(30), function () use ($user) {
            return $user->profile->followers->count();
        });

        $followingCount = IlluminateCache::remember('count.following' . $user->id, now()->addSeconds(30), function () use ($user) {
            return $user->following->count();
        });

        $follows = (auth()->user()) ?  auth()->user()->following->contains($user->id) : false;

        return view('profiles.index', compact('user', 'follows', 'postCount', 'followersCount', 'followingCount'));
    }

    public function edit(\App\User $user)
    {

        $this->authorize('update', $user->profile);

        return view('profiles.edit', compact('user'));

    }

    public function update(\App\User $user)
    {
        $data = request()->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['string', 'max:255'],
            'url' => ['url', 'max:255'],
            'image' => ['image'],
        ]);

        if(request('image')){
            $imagePath = request('image')->store('profile', 'public');

            $image = Image::make(public_path('storage/'.$imagePath))->fit(1000, 1000);
            $image->save();

            $imageArrary = ['image' => $imagePath];
        }

        // actualizamos perfil con la sesion del usuario logueado

        auth()->user()->profile->update(array_merge(
            $data,
            $imageArrary ?? []
        ));
        // empty array doesnot override data


        // redirigimos al perfil del usuario
        return redirect('/profile/'.$user->id)->with('status', 'Profile updated!');

    }
}
