<?php

use Illuminate\Support\Facades\Route;

use App\Models\{User, Album};

use App\Http\Controllers\
{
    AlbumsController
};
Route::view('/', 'welcome', ['name' => Request::input('name', '')]);
//Route::get('/', [HomeController::class,'index']);
Route::get('/users', function () {
    return  User::with('albums') ->paginate(80);
});

Route::resource('/albums', AlbumsController::class);
Route::delete('/albums/{album}', [AlbumsController::class, 'delete']);
Route::get('/albums/{album}', 'App\Http\Controllers\AlbumsController@show');
Route::get('/albums/{album}', [AlbumsController::class, 'show']);


