@extends('admin.dashboard')

@section('content')
    <div class="max-w-xl mx-auto py-10">
        <div class="mb-6 flex justify-between items-center">
            <h1 class="text-2xl font-bold">Edit User</h1>
            <a href="{{ route('admin.users.index') }}" class="text-blue-600">Back to Users</a>
        </div>
        <form method="POST" action="{{ route('admin.users.update', $admin->id) }}" class="space-y-4 bg-white p-6 rounded shadow">
            @csrf
            @method('PUT')
            <div>
                <label class="block font-semibold mb-1">Name</label>
                <input name="name" class="w-full p-2 border rounded" value="{{ $admin->name }}">
                @error('name')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
            </div>
            
            <div>
                <label class="block font-semibold mb-1">Email</label>
                <input name="email" type="email" class="w-full p-2 border rounded" value="{{ $admin->email }}">
                @error('email')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
            </div>
            
            <div>
                <label class="block font-semibold mb-1">Password</label>
                <input name="password" type="password" class="w-full p-2 border rounded">
                @error('password')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
            </div>
            
            <div>
                <label class="block font-semibold mb-1">Role</label>
                <select name="role" class="w-full p-2 border rounded">
                    <option value="admin" @selected($admin->role === 'admin')>Admin</option>
                    <option value="manager" @selected($admin->role === 'manager')>Manager</option>
                    <option value="cashier" @selected($admin->role === 'cashier')>Cashier</option>
                </select>
                @error('role')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
            </div>
            <div class="pt-2">
                <button class="px-4 py-2 bg-gray-900 text-white rounded">Update</button>
            </div>
        </form>
    </div>
@endsection