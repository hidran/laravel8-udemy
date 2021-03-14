@extends('templates.default')
@section('content')
    <h1>ALBUMS</h1>

    @if(session()->has('message'))
        <x-alert-info>{{ session()->get('message') }}</x-alert-info>
    @endif
    <form>
        <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
        <ul class="list-group">
            @foreach($albums as $album)
                <li class="list-group-item d-flex justify-content-between">
                    ({{$album->id}}) {{$album->album_name}}
                    @if($album->album_thumb)
                        <img width="300" src="{{asset($album->path)}}" title="{{$album->album_name}}"
                             alt="{{$album->album_name}}">

                    @endif
                    <div>
                        <a href="{{route('photos.create')}}?album_id={{$album->id}}" class="btn btn-primary">NEW IMAGE</a>
                        <a href="{{route('albums.images',$album)}}" class="btn btn-primary">VIEW IMAGES ({{$album->photos_count}})</a>
                        <a href="{{route('albums.edit',$album)}}" class="btn btn-primary">UPDATE</a>
                        <a href="{{route('albums.destroy',$album)}}" class="btn btn-danger">DELETE</a>
                    </div>
                </li>
            @endforeach
            <li>
                <div class="row">
                    <div

                        class="col-md-8 offset-md-2 d-flex justify-content-center">
                        {{$albums->links('vendor.pagination.bootstrap-4')}}
                    </div>
                </div>
            </li>
        </ul>
    </form>
@endsection
@section('footer')
    @parent
    <script>
        $('document').ready(function () {
            $('.alert').fadeOut(5000);
            $('ul').on('click', 'a.btn-danger', function (ele) {
                ele.preventDefault();

                var urlAlbum = $(this).attr('href');
                var li = ele.target.parentNode.parentNode;
                $.ajax(
                    urlAlbum,

                    {
                        method: 'DELETE',
                        data: {
                            _token: $('#_token').val()
                        },
                        complete: function (resp) {
                            console.log(resp);
                            if (resp.responseText == 1) {
                                //   alert(resp.responseText)
                                li.parentNode.removeChild(li);
                                // $(li).remove();
                            } else {
                                alert('Problem contacting server');
                            }
                        }
                    }
                )
            });
        });
    </script>
@endsection

