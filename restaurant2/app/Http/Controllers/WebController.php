<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebController extends Controller
{
    public function index()
    {
       return view('ui.home');
    }

    public function about()
    {
       return view('ui.about');
    }
}
