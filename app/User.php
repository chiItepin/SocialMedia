<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'username', 'password',
    ];

    protected static function boot()
    {
        parent::boot();

        // call event when user is created
        static::created(function($user) {
            // create the profile based on the username
            $user->profile()->create([
                'title' => $user->username,
                'image' => 'profile/userprofile.png',
            ]);


        });
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class)->orderBy('created_at', 'DESC');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    // relation with profiles if following
    public function following()
    {
        return $this->belongsToMany(Profile::class);
    }

    // relation with post likes if any
    public function liked()
    {
        return $this->belongsToMany(Post::class);
    }
}
