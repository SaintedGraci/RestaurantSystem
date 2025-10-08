<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Models\MenuItem;

class AdminUserController extends Controller
{
    public function create(Request $request)
    {
        if ($request->ajax()) {
            return view('admin.users.partials.create')->render();
        }
        return view('admin.dashboard', ['content_view' => 'admin.users.partials.create']);
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

    public function manageMenu(Request $request)
    {
        // You would typically fetch menu data here
        // $menuItems = []; // Replace with actual menu item fetching logic

        if ($request->ajax()) {
            return view('admin.manageUser.managemenuitems')->render();
        }

        return view('admin.dashboard', ['content_view' => 'admin.manageUser.managemenuitems']);
    }

    public function indexMenuItems(Request $request)
    {
        $menuItems = MenuItem::orderByDesc('created_at')->paginate(10);

        if ($request->ajax()) {
            return view('admin.manageUser.partials.index_menu_items', compact('menuItems'))->render();
        }

        return view('admin.dashboard', ['content_view' => 'admin.manageUser.partials.index_menu_items', 'menuItems' => $menuItems]);
    }

    public function index(Request $request)
    {
        $admins = Admin::orderByDesc('created_at')->paginate(10);

        if ($request->ajax()) {
            return view('admin.users.partials.index', compact('admins'))->render();
        }

        return view('admin.dashboard', ['content_view' => 'admin.users.partials.index', 'admins' => $admins]);
    }

    public function edit(int $id)
    {
        $admin = Admin::findOrFail($id);
        return view('admin.users.edit', compact('admin'));
    }

    public function update(Request $request, int $id)
    {
        $admin = Admin::findOrFail($id);
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

    public function destroy(int $id)
    {
        $admin = Admin::findOrFail($id);
        $admin->delete();
        return redirect()->route('admin.users.index')->with('status', 'User deleted successfully.');
    }
}


