@extends('templates.default')
@section('content')

    <table class="table table-striped">
        <tr>
            <th>ID</th>
            <th> CREATED DATE</th>
            <th> TITLE</th>
            <th> ALBUM</th>
            <th> THUMBNAIL</th>
            <th>&nbsp;</th>
        </tr>
        @forelse($images as $image)

            <tr>
                <td>{{$image->id}}</td>
                <td>{{$image->created_at}}</td>
                <td>{{$image->name}}</td>
                <td>{{$album->album_name}}</td>
                <td>
                    <img width="120" src="{{asset($image->img_path)}}">
                </td>
                <td>
                    <a href="{{route('photos.edit',$image->id)}}" class="btn  btn-sm btn-default">MODIFICA</a>
                    <a href="{{route('photos.destroy',$image->id)}}" class="btn  btn-sm btn-danger">DELETE</a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5">
                    No images found
                </td>
            </tr>
        @endforelse

    </table>
@section('footer')
    @parent
    <script>
        $('document').ready(function () {
            //$('div.alert').fadeOut(5000);
            $('table').on('click', 'a.btn-danger',function (ele) {
                ele.preventDefault();
                var urlImg =   $(this).attr('href');
                var tr = ele.target.parentNode.parentNode;
                $.ajax(
                    urlImg,
                    {
                        method: 'DELETE',
                        data : {
                            '_token' : '{{csrf_token()}}'
                        },
                        complete : function (resp) {
                            console.log(resp);
                            if(resp.responseText == 1){
                                //  alert(resp.responseText)
                                tr.parentNode.removeChild(tr);
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
