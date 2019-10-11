@extends('layouts.app')

@section('content')
<div class="container postContainer">

    @foreach ($posts as $post)
    <div class="row postRow">

                <div class="col-12 postRowHeader">
                    <div class="d-flex align-items-center">
                            <span style="position:absolute;right:10px" class="text-secondary float-right">{{$post->created_at->diffForHumans(null, false, true)}}</span>

                        <div class="pr-3">
                                <a style="color:black" href="/profile/{{ $post->user->profile->id }}"><img style="width:40px" class="rounded-circle" src="{{url('storage/'.$post->user->profile->image)}}" alt=""></a>
                        </div>
                        <div>
                        <div class="font-weight-bold">
                            <a style="color:black" href="/profile/{{ $post->user->profile->id }}">{{$post->user->username}}</a>
                        </div>

                        </div>

                    </div>


                {{-- <p><span class="font-weight-bold"><a style="color:black" href="/profile/{{ $post->user->profile->id }}">{{$post->user->username}}</a></span> </p> --}}
            </div>
            <div class="col-12">
                    <a href="{{url('')}}/p/{{ $post->id }}"><img src="{{url('storage/'.$post->image)}}" class="w-100" alt=""></a>
            </div>
            <div class="col-12 postRowHeader">
                    <div class="d-flex align-items-center">
                            <a style="color:black" class="font-weight-bold pr-2" href="/profile/{{ $post->user->profile->id }}"> {{$post->user->username}} </a> {{$post->caption}}
                    </div>
            </div>
        </div>
    @endforeach

    <div style="margin:auto;display:table" class="row">
        <div class="col-12">
            {{$posts->links()}}
        </div>
    </div>

</div>
@endsection
