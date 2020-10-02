<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\{HomeController, WelcomeController};
Route::view('/', 'welcome', ['name' => Request::input('name', '')]);
//Route::get('/', [HomeController::class,'index']);




Route::get('/{name?}/{lastname?}/{age?}', [WelcomeController::class, 'welcome'])
    /*->where('name' ,'[a-zA-Z]+')
    ->where('lastname' ,'[a-zA-Z]+')
    */
    ->where([
        'name' => '[a-zA-Z]+',
        'lastname' => '[a-zA-Z]+',
        'age' => '[0-9]{1,3}'
    ]);;
Route::get('/users', function () {
    $users = [];
    foreach (range(0, 10) as $index) {
        $user = new stdClass();
        $user->name = 'Hidran ' . $index;
        $user->lastName = 'Arias ' . $index;
        $users[] = $user;
    }
    return $users;
    //return ['John','David'];
    // return view('users');
});
