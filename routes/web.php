<?php

use Illuminate\Support\Facades\Route;

use App\Models\{User, Album};

use App\Http\Controllers\
{
    AlbumsController
};


Route::resource('/albums', AlbumsController::class);
Route::get('/albums/{album}/images', [AlbumsController::class,'getImages'])->name('albums.images');
Route::delete('/albums/{album}', [AlbumsController::class, 'delete']);


