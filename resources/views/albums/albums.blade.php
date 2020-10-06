@extends('templates.default')
@section('content')
    <h1>ALBUMS</h1>
   <form>
       <input id="_token" type="hidden" name="_token" value="{{csrf_token()}}">
    <ul class="list-group">
        @foreach($albums as $album)
            <li class="list-group-item d-flex justify-content-between">
                ({{$album->id}})  {{$album->album_name}}
                <div>
                <a href="/albums/{{$album->id}}/edit" class="btn btn-primary">UPDATE</a>
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
            $('ul').on('click', 'a.btn-danger',function (ele) {
                ele.preventDefault();

                var urlAlbum =   $(this).attr('href');
                var li = ele.target.parentNode;
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

