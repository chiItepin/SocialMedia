@extends('layouts.app')

@section('content')
<div class="container">

    <div style="max-width:900px" class="row postRow">
        <div class="col-12 col-md-8">
                <img src="{{url('storage/'.$post->image)}}" class="mainImg w-100" alt="">
        </div>
            <div class="col-md-4 col-12 postRowHeader">
                <div class="d-flex align-items-center">
                    <div class="pr-3">
                        <img style="width:40px" class="rounded-circle" src="{{url('storage/'.$post->user->profile->image)}}" alt="">
                    </div>
                    <div>
                    <div class="font-weight-bold">
                        <a style="color:black" href="/profile/{{ $post->user->profile->id }}">{{$post->user->username}}</a>
                    </div>

                    </div>
                    @cannot('update', $post->user->profile)
                    @if(Auth::check())
                    <follow-link follows="{{$follows}}" user-id="{{ $post->user->profile->id }}"></follow-link>
                    @endif
                    @endcannot

                </div>

                <hr>
            <p><span class="font-weight-bold"><a style="color:black" href="/profile/{{ $post->user->profile->id }}">{{$post->user->username}}</a></span> {{$post->caption}}</p>

            <div class="commentsContainer">
                <comments postid="{{$post->id}}"></comments>

            </div>
            <div class="footerpost">

            <like-link logged="{{Auth::check()}}" likes="{{ $likes }}" postid="{{ $post->id }}"></like-link>
            <div class="d-inline-block">{{ $likesCount }} <span class="font-weight-bold pl-1">Likes</span></div>
            <div class="pl-1 d-inline-block">{{ $commentsCount }} <span class="font-weight-bold pl-1">Comments</span></div>

        </div>

        <div class="footerpostComment">

            <form action="/comment/{{$post->id}}" method="post">
                    @csrf

                <input type="text" placeholder="Add a comment" name="comment" id="">
            </form>

        </div>

        </div>
    </div>

</div>
@endsection
