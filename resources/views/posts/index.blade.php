@extends('layouts.app')

@section('content')
<div class="container postContainer">

    <index-posts logged="{{Auth::check()}}"></index-posts>
  

    <div style="margin:auto;display:table" class="row">
        <div class="col-12">

        </div>
    </div>

</div>
@endsection
