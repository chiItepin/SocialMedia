<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    // allow submitting forms
    protected $guarded = [];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function followers()
    {
        return $this->belongsToMany(User::class);
    }
}
