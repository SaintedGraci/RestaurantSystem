<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public function showLoginForm()
    {
        return view('login');
    }
}
