<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Photo;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        $albums =  Album::with('categories')->get()->toArray();

        return view('gallery.albums')->with('albums',$albums->paginate(50));
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
