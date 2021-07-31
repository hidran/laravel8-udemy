<?php

use App\Http\Controllers\Admin\AdminUsersController;

Route::resource('users', AdminUsersController::class);
Route::view('/', 'templates/admin')->name('admin');

Route::get('/dashboard', function () {
    return 'Admin DashBoard';
});
