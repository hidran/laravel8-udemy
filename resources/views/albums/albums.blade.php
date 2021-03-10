@extends('templates.default')
@section('content')
    <h1>ALBUMS</h1>

    @if(session()->has('message'))
        <x-alert-info>{{ session()->get('message') }}</x-alert-info>
    @endif
   <form>
       @csrf
    <ul class="list-group">
        @foreach($albums as $album)
            <li class="list-group-item d-flex justify-content-between">
                ({{$album->id}})  {{$album->album_name}}
                @if($album->album_thumb)
                    <img width="300" src="{{asset($album->path)}}" title="{{$album->album_name}}" alt="{{$album->album_name}}">

                @endif
                <div>
                    <a href="{{route('albums.images',$album)}}" class="btn btn-primary">VIEW IMAGES</a>
                <a href="{{route('albums.edit',$album)}}" class="btn btn-primary">UPDATE</a>
                <a href="/albums/{{$album->id}}" class="btn btn-danger">DELETE</a>
                </div>
            </li>
        @endforeach
    </ul>
   </form>
@endsection
@section('footer')
    @parent
    <script>
        $('document').ready(function () {
            $('.alert').fadeOut(5000);
            $('ul').on('click', 'a.btn-danger',function (ele) {
                ele.preventDefault();

                var urlAlbum =   $(this).attr('href');
                var li = ele.target.parentNode.parentNode;
                $.ajax(
                    urlAlbum,

                    {
                        method: 'DELETE',
                        data:{
                           _token:$('#_token').val()
                        },
                        complete : function (resp) {
                            console.log(resp);
                            if(resp.responseText == 1){
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

