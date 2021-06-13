@php
/**
 * @var $album App\Models\Album;
*/
@endphp
@extends('templates.default')
@section('content')
    <h1>Edit Album</h1>
    @include('partials.inputerrors')
    <form action="{{route('albums.update',['album' => $album->id])}}" method="POST"  enctype="multipart/form-data">
        @csrf
        @method('PATCH')
         <input type="hidden" name="_method" value="PATCH">
        <div class="form-group">
            <label for="">Name</label>
            <input type="text" name="album_name" id="album_name" class="form-control" value="{{$album->album_name}}" placeholder="Album name">

        </div>
        @include('albums.partials.fileupload')
        <div class="form-group">
            <label for="">Description</label>
            <textarea  name="description" id="description" class="form-control" placeholder="Album description">{{$album->description}}</textarea>

        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@stop
