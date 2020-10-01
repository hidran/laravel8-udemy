<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\Http\Controllers\{HomeController, WelcomeController};
Route::get('/', [HomeController::class,'index']);




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
