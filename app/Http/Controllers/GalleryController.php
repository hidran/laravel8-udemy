<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        return view('gallery.albums')->with('albums', Album::latest()->paginate(50));
    }
}
