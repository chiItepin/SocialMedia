<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
    protected $table = 'post_user';
    
        /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at','id',
    ];
    


}
