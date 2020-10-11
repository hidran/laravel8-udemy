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


Route::get('usersnoalbums' , function(){
    $usersnoalbum = DB::table('users  as u')
        ->leftJoin('albums as a', 'u.id','a.user_id')
        ->select('u.id','email','name','album_name')->
        whereRaw('album_name is null')
        ->get();
    $usersnoalbum = DB::table('users  as u')

        ->select('u.id','email','name')->
        whereRaw( ' EXISTS (SELECT user_id from albums where user_id= u.id)')
        ->get();
    return $usersnoalbum;
});
