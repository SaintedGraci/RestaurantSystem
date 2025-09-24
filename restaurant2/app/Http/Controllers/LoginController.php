<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'email'],
            'password' => ['required'],
        ]);
        
        $admin = Admin::where('email', $credentials['username'])->first();

        if ($admin && Hash::check($credentials['password'], $admin->password)) {
            Auth::login($admin);
            return redirect()->route('admin.dashboard');
        }


        return back()->withErrors(['username' => 'Invalid credentials'])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
