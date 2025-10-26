<?php


namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    // Display a listing of all users
    public function index()
    {
        $admins = Admin::all();
        return view('admin.users.index', compact('admins'));
    }

    // Show the form for creating a new user
    public function create()
    {
        return view('admin.users.create'); // Return the user creation view
    }

    // Store a newly created user in storage
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string',
        ]);

        $admin = new Admin();
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->password = Hash::make($request->password);
        $admin->role = $request->role;
        $admin->save();

        return redirect()->route('admin.users.index')->with('success', 'User created successfully!');
    }

    // Show the form for editing the specified user
    public function edit($id)
    {
        $user = Admin::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    // Update the specified user in storage
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins,email,' . $id,
            'role' => 'required|string',
        ]);

        $admin = Admin::findOrFail($id);
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->role = $request->role;

        if ($request->filled('password')) {
            $admin->password = Hash::make($request->password);
        }

        $admin->save();

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully!');
    }

    // Remove the specified user from storage
    public function destroy($id)
    {
        $admin = Admin::findOrFail($id);
        $admin->delete();

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully!');
    }
}
