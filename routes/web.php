<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AlbumsController, PhotosController};

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware(['auth'])->prefix('dashboard')->group(function () {

    Route::resource('/albums', AlbumsController::class)->middleware('auth');
    Route::get('/albums/{album}/images', [AlbumsController::class,'getImages'])->name('albums.images')
        ->middleware('can:view,album');
    Route::resource('photos', PhotosController::class);
});



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
