<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
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

            // return $this->belongsToMany('User', 'follows', 'user_id', 'follower_id');

        }


}
