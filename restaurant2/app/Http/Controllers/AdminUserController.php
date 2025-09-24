<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class AdminUserController extends Controller
{
    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:admins,email'],
            'password' => ['required', 'string', 'min:6'],
            'role' => ['required', 'in:admin,manager,cashier'],
        ]);

        Admin::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
        ]);

        return redirect()->route('admin.users.create')->with('status', 'Account created successfully.');
    }

    public function manageMenu()
    {
        return view('admin.manageUser.manageMenu');
    }

    public function index()
    {
        $admins = Admin::orderByDesc('created_at')->paginate(10);
        return view('admin.users.index', compact('admins'));
    }

    public function edit(Admin $admin)
    {
        return view('admin.users.edit', compact('admin'));
    }

    public function update(Request $request, Admin $admin)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:admins,email,' . $admin->id],
            'password' => ['nullable', 'string', 'min:6'],
            'role' => ['required', 'in:admin,manager,cashier'],
        ]);

        $updateData = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role' => $validated['role'],
        ];

        // Only update password if provided
        if (!empty($validated['password'])) {
            $updateData['password'] = Hash::make($validated['password']);
        }

        $admin->update($updateData);

        return redirect()->route('admin.users.index')->with('status', 'User updated successfully.');
    }

    public function destroy(Admin $admin)
    {
        $admin->delete();
        return redirect()->route('admin.users.index')->with('status', 'User deleted successfully.');
    }
}


