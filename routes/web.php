<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AlbumsController, PhotosController};


Route::resource('/albums', AlbumsController::class);
Route::get('/albums/{album}/images', [AlbumsController::class,'getImages'])->name('albums.images');
Route::resource('photos', PhotosController::class);


