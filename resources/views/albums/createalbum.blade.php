@extends('templates.default')
@section('content')
    <h1>New Album</h1>
    @include('partials.inputerrors')
    <form action="{{route('albums.store')}}" method="POST"  enctype="multipart/form-data">
        {{csrf_field()}}

        <div class="form-group">
            <label for="">Name</label>
            <input type="text"  name="album_name" id="album_name" class="form-control" value="{{old('album_name')}}" placeholder="Album name">

        </div>
        @include('albums.partials.fileupload')
        @include('albums.partials.category_combo')



        <div class="form-group">
            <label for="">Description</label>
            <textarea  name="description" id="description" class="form-control" placeholder="Album description">{{old('description')}}</textarea>

        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@stop
