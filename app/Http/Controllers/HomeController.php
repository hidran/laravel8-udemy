<?php

namespace App\Http\Controllers;
use App\Models\User;
class HomeController  {

    public
    function index()
    {
        return view('welcome');



    }
}
