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

    public function likes()
    {
        return $this->belongsToMany(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->orderBy('created_at', 'DESC');

    }
}
