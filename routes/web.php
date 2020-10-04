<?php

use Illuminate\Support\Facades\Route;

use App\Models\{User, Album};

use App\Http\Controllers\{HomeController, WelcomeController};
Route::view('/', 'welcome', ['name' => Request::input('name', '')]);
//Route::get('/', [HomeController::class,'index']);
Route::get('/users', function () {
    return  User::with('albums') ->paginate(80);
});
Route::get('/albums', function () {
    return  Album::paginate(5);
});



Route::get('/{name?}/{lastname?}/{age?}', [WelcomeController::class, 'welcome'])
    /*->where('name' ,'[a-zA-Z]+')
    ->where('lastname' ,'[a-zA-Z]+')
    */
    ->where([
        'name' => '[a-zA-Z]+',
        'lastname' => '[a-zA-Z]+',
        'age' => '[0-9]{1,3}'
    ]);;

