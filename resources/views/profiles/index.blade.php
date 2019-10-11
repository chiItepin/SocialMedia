@extends('layouts.app')

@section('content')
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

<div class="container">
    <div class="row">
        <div class="col-12 col-md-3 p-5">
            <img src="{{url('storage/'.$user->profile->image)}}" class="rounded-circle mainprofileImg" alt="">
        </div>
        <div class="col-12 col-md-9 p-5">
            <div>

                <div class="d-flex align-items-center">
                   <div class="h1"> {{ $user->username }}</div>
                   @cannot('update', $user->profile)
                   @if(Auth::check())
                   <follow-button follows="{{$follows}}" user-id="{{ $user->id }}"></follow-button>
                   @endif
                   @endcannot
                </div>

            </div>
            @can('update', $user->profile)
            <a style="width:49%" href="{{url('')}}/p/create" class=" d-inline-block btn btn-primary">Add a post</a>
            <a style="width:49%" href="{{url('')}}/profile/{{ $user->id }}/edit" class=" d-inline-block btn btn-primary">Edit profile</a>
            @endcan
            <div class="d-flex">
                 <div class="pr-5"> <strong>{{ $postCount }}</strong> Posts </div>
                <div class="pr-5"><strong>{{ $followersCount }}</strong> Followers</div>
                <div class="pr-5"><strong>{{ $followingCount }}</strong> Following</div>
            </div>
        <div class="pt-3"><strong>{{ $user->profile->title }}</strong></div>
            <div>{{ $user->profile->description }}</div>
            <a href="{{ $user->profile->url }}">{{ $user->profile->url }}</a>
        </div>
    </div>

    <div class="row">
        @foreach ($user->posts as $post)
    <div class="col-s12 col-md-4 mt-4"><a href="{{url('')}}/p/{{ $post->id }}"><img src="{{url('storage/'.$post->image)}}" class="w-100" alt=""></a></div>
        @endforeach
    </div>


</div>
@endsection




