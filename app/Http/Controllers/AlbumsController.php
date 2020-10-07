<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;
use DB;
class AlbumsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {


        $queryBuilder = DB::table('albums')->orderBy('id', 'DESC');
        if ($request->has('id')) {
            $queryBuilder->where('id', '=', $request->input('id'));
        }
        if ($request->has('album_name')) {
            $queryBuilder->where('album_name', 'like', $request->input('album_name') . '%');
        }
        $albums = $queryBuilder->get();
        return view('albums.albums', ['albums' => $albums]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
return view('albums.createalbum');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $res = DB::table('albums')->insert(
            [  [
                'album_name' => request()->input('name'),
                'album_thumb' => '/',
                'description' => request()->input('description'),
                'user_id' => 1
            ]
            ]
        );
        $name =  request()->input('name');
        $messaggio = $res ? 'Album   ' . $name . ' Created' : 'Album ' . $name. ' was not crerated';
        return  redirect()->route('albums.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        $sql = 'select * FROM albums WHERE id=:id';
        return  DB::select($sql, ['id' => $id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $sql = 'select album_name, description,id from albums where id =:id ';
        $album = DB::select($sql, ['id' => $id]);
       // dd($album);
        return view('albums.editalbum')->withAlbum($album[0]);
     }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $res = DB::table('albums')->where('id', $id)->update(
            ['album_name' => request()->input('name'),
                'description' => request()->input('description')
            ]
        );
        $messaggio = $res ? 'Album con id = ' . $id . ' Aggiornato' : 'Album ' . $id . ' Non aggiornato';
        session()->flash('message', $messaggio);
        return redirect()->route('albums.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $album)
    {
        $sql = 'DELETE FROM albums WHERE id=:id';
       return  DB::delete($sql, ['id' => $album]);
    }
    public function delete(int $id)
    {
        $res = DB::table('albums')->where('id', $id)->delete();

        return $res;
    }
}
