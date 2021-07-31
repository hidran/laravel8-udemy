<?php
Route::view('/', 'templates/admin')->name('admin');

Route::get('/dashboard', function () {
    return 'Admin DashBoard';
});
