<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Photo;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        return view('gallery.albums')->with('albums', Album::latest()->paginate(50));
    }

    public function showAlbumImages(Album $album)
    {
       return view('gallery.images',['images' =>
           Photo::whereAlbumId($album->id)->paginate(10),
               'album' => $album
               ]
       );
    }
}
