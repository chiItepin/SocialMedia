@extends('layouts.app')

@section('content')
<div class="container">

    <form action="/p" enctype="multipart/form-data" method="post">
        @csrf
            <div class="row">
                    <div class="col-8 offset-2">

                        <div class="row"><h1>Add a new post</h1></div>

                            <div class="form-group">
                                    <label for="caption" class="col-md-4 col-form-label">Post caption</label>

                                        <input id="caption" type="text" class="form-control @error('caption') is-invalid @enderror" name="caption" value="{{ old('caption') }}"  autocomplete="caption">

                                        @error('caption')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>


                    </div>
                </div>

                <div class="row">
                        <div class="col-8 offset-2">
                    <label for="image" class="col-md-4 col-form-label">Post image</label>
                    <input type="file" class="form-control-file" id="image" accept="image/*" name="image">
                    @error('image')
                        <strong>{{ $message }}</strong>
                    @enderror
                        </div>
                </div>

                <div class="row">
                    <div class="col-8 offset-2">
                    <button class="btn btn-primary mt-4">Add new post</button>
                    </div>
                </div>
    </form>

</div>
@endsection
