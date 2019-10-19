<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    // allow submitting forms
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function profile()
    {
        return $this->belongsTo('App\Profile', 'user_id');
    }

    public function likes()
    {
        
        return $this->belongsToMany(User::class)->select(array('users.id'));
    }

    public function likesuser()
    {
        $user = (auth()->user()) ? auth()->user()->id: 0;

        return $this->hasOne(Like::class)->where('user_id', $user);
    }

    public function comments()
    {
        return $this->hasMany('App\Comment', 'post_id');

        // return $this->belongsTo('App\Profile', 'user_id');


    }


    public function commentscount()
    {
        return $this->hasMany('App\Comment', 'post_id')->select(array('comments.post_id'));

        // return $this->belongsTo('App\Profile', 'user_id');


    }
}
