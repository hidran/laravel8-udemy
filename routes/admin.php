<?php

use App\Http\Controllers\Admin\AdminUsersController;

Route::view('/', 'templates/admin')->name('admin');

Route::resource('users', AdminUsersController::class);
Route::patch('restore/{user}', [AdminUsersController::class,'restore'])->name('admin.userrestore');
Route::get('getUsers', [AdminUsersController::class, 'getUsers'])->name('admin.getUsers');

Route::get('/dashboard', function () {
    return 'Admin DashBoard';
});
