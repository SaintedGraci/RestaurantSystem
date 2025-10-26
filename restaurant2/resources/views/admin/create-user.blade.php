<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User - Tindahan ni Aling Dadai</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <nav class="bg-green-800 text-white p-4">
        <div class="container mx-auto">
            <h1 class="text-2xl font-bold">Create New User</h1>
        </div>
    </nav>

    <div class="container mx-auto p-6">
        <div class="bg-white rounded-lg shadow p-6">
            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block mb-2">Name</label>
                        <input type="text" name="name" class="w-full border rounded p-2" required>
                    </div>
                    <div>
                        <label class="block mb-2">Email</label>
                        <input type="email" name="email" class="w-full border rounded p-2" required>
                    </div>
                    <div>
                        <label class="block mb-2">Password</label>
                        <input type="password" name="password" class="w-full border rounded p-2" required>
                    </div>
                    <div>
                        <label class="block mb-2">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="w-full border rounded p-2" required>
                    </div>
                    <div>
                        <label class="block mb-2">Role</label>
                        <select name="role" class="w-full border rounded p-2" required>
                            <option value="admin">Admin</option>
                            <option value="manager">Manager</option>
                            <option value="cashier">Cashier</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="mt-4 bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                    Create User
                </button>
            </form>
        </div>
    </div>
</body>
</html>