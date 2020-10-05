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
Route::get('/albums/{album}/delete', [AlbumsController::class, 'delete']);
Route::resource('/albums', AlbumsController::class);



