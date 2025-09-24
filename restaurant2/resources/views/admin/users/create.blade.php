<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet" />
    <style>body{font-family:'Poppins',sans-serif;}</style>
</head>
<body class="bg-gray-50">
    <div class="max-w-xl mx-auto py-10">
        <div class="mb-6 flex justify-between items-center">
            <h1 class="text-2xl font-bold mt-48">Create Account</h1>
            <a href="{{ route('admin.dashboard') }}" class="text-blue-600">Back to Dashboard</a>
        </div>

        @if (session('status'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('admin.users.store') }}" class="space-y-4 bg-white p-6 rounded shadow">
            @csrf
            <div>
                <label class="block font-semibold mb-1">Name</label>
                <input name="name" class="w-full p-2 border rounded" value="{{ old('name') }}">
                @error('name')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block font-semibold mb-1">Email</label>
                <input name="email" type="email" class="w-full p-2 border rounded" value="{{ old('email') }}">
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
                    <option value="admin" @selected(old('role')==='admin')>Admin</option>
                    <option value="manager" @selected(old('role')==='manager')>Manager</option>
                    <option value="cashier" @selected(old('role')==='cashier')>Cashier</option>
                </select>
                @error('role')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
            </div>
            <div class="pt-2">
                <button class="px-4 py-2 bg-gray-900 text-white rounded">Create</button>
            </div>
        </form>
    </div>
</body>
</html>


