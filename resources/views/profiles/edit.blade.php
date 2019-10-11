@extends('layouts.app')

@section('content')
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

<div class="container">

<form action="/profile/{{ $user->id }}" enctype="multipart/form-data" method="post">
            @csrf
            @method('PATCH')

                <div class="row">
                        <div class="col-8 offset-2">

                            <div class="row"><h1>Edit profile</h1></div>

                                <div class="form-group">
                                        <label for="title" class="col-md-4 col-form-label">Title</label>

                                            <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') ?? $user->profile->title }}"  autocomplete="title">

                                            @error('title')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                    </div>


                                    <div class="form-group">
                                            <label for="description" class="col-md-4 col-form-label">Description</label>

                                                <textarea id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description">{{ old('description') ?? $user->profile->description }}</textarea>

                                                @error('description')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                        </div>


                                        <div class="form-group">
                                                <label for="url" class="col-md-4 col-form-label">URL</label>

                                        <input id="url" type="text" class="form-control @error('url') is-invalid @enderror" name="url" value="{{ old('url') ?? $user->profile->url }}"  autocomplete="url">

                                                    @error('url')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                            </div>


                        </div>
                    </div>

                    <div class="row">
                            <div class="col-8 offset-2">
                        <label for="image" class="col-md-4 col-form-label">Profile image</label>
                        <input type="file" class="form-control-file" id="image" accept="image/*" name="image">
                        @error('image')
                            <strong>{{ $message }}</strong>
                        @enderror
                            </div>
                    </div>

                    <div class="row">
                        <div class="col-8 offset-2">
                        <button class="btn btn-primary mt-4">Save profile</button>
                        </div>
                    </div>
        </form>

</div>
@endsection
