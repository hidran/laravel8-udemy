<?php

namespace App\Http\Controllers;

use App\Http\Requests\AlbumRequest;
use App\Models\Album;
use App\Models\Photo;
use Auth;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Gate;

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

        $queryBuilder = Album::orderBy('id', 'DESC')
            ->withCount('photos');
        $queryBuilder->where('user_id', Auth::id());
        if ($request->has('id')) {
            $queryBuilder->where('id', '=', $request->input('id'));
        }
        if ($request->has('album_name')) {
            $queryBuilder->where('album_name', 'like', $request->input('album_name') . '%');
        }

        $albums = $queryBuilder->paginate( env('IMAGE_PER_PAGE',20));

        return view('albums.albums', ['albums' => $albums]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $album = new Album();
        return view('albums.createalbum', ['album' => $album]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(AlbumRequest $request)
    {

        $this->authorize(Album::class);
        $album = new Album();
        $album->album_name = request()->input('album_name');
        $album->album_thumb = '/';
        $album->description = request()->input('description');
        $album->user_id = Auth::id();
        $res = $album->save();
        if ($res) {
            if ($this->processFile($album->id, $request, $album)) {
                $album->save();
            }
        }

        $name = request()->input('name');
        $messaggio = $res ? 'Album   ' . $name . ' Created' : 'Album ' . $name . ' was not crerated';
        return redirect()->route('albums.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Album $album
     * @return \Illuminate\Http\Response
     */
    public function show(Album $album)
    {
        if(+$album->user_id === +Auth::id() ){
            return $album;
        }
       abort(401);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Album $album
     * @return \Illuminate\Http\Response
     */
    public function edit(Album $album)
    {

     $this->authorize($album);

//        if($album->user_id !== Auth::id()){
//            abort(401);
//        }
          return view('albums.editalbum')->withAlbum($album);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Album $album
     * @return \Illuminate\Http\Response
     */
    public function update(AlbumRequest $req, $id)
    {
        $album = Album::find($id);

        $this->authorize($album);
        $album->album_name = $req->input('album_name');
        $album->description = $req->input('description');
        $album->user_id = Auth::id();
        $this->processFile($id, $req, $album);

        $res = $album->save();
        $messaggio = $res ? 'Album con nome = ' . $album->album_name . ' Aggiornato' : 'Album ' . $album->album_name . ' Non aggiornato';
        session()->flash('message', $messaggio);
        return redirect()->route('albums.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Album $album
     * @return \Illuminate\Http\Response
     */


    public function destroy(Album $album)
    {
        $this->authorize($album);
        $thumbNail = $album->album_thumb;
       $res = $album->delete();
        if($res && $thumbNail && \Storage::exists($thumbNail)){
            \Storage::delete($thumbNail);
        }
         return $res;

    }

    /**
     * @param Request $req
     * @param $id
     * @param $album
     */
    private function processFile($id, Request $req, $album): bool
    {

        if (!$req->hasFile('album_thumb')) {
            return false;
        }

        $file = $req->file('album_thumb');
        if (!$file->isValid()) {
            return false;
        }


        $filename = $id . '.' . $file->extension();
        $filename = $file->storeAs(env('IMG_DIR'), $filename);
        $album->album_thumb = $filename;
        return true;
    }
    public function getImages( Album $album){

      $images=   Photo::wherealbumId($album->id)->latest()->paginate( env('IMAGE_PER_PAGE',20));
return view('images.albumimages', compact('album','images'));


    }
}
