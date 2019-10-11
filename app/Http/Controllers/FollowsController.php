<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FollowsController extends Controller
{
    // SOLO USUARIOS LOGUEADOS
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(\App\User $user){
        return auth()->user()->following()->toggle($user->profile);
    }
}
