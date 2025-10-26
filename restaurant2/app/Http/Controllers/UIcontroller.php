<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuItem;
class UIcontroller extends Controller
{

    
    public function location()
    {
        return view('ui.location');
    }

    public function menu()
    {
        $menuItems = MenuItem::all();
        return view('ui.menu', compact('menuItems'));
    }
}
