<div class="max-w-4xl mx-auto py-10">
        <div class="mb-6 flex justify-between items-center">
            <h1 class="text-2xl font-bold">Users</h1>
            <div class="space-x-3">
                <a href="{{ route('admin.users.create') }}" class="px-3 py-2 bg-blue-600 text-white rounded">Create User</a>
                <a href="{{ route('admin.dashboard') }}" class="px-3 py-2 bg-gray-200 rounded">Dashboard</a>
            </div>
        </div>

        @if (session('status'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('status') }}</div>
        @endif

        <div class="bg-white rounded shadow">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($admins as $admin)
                    <tr>
                        <td class="px-4 py-2 text-sm text-gray-700">{{ $admin->id }}</td>
                        <td class="px-4 py-2 text-sm text-gray-700">{{ $admin->name }}</td>
                        <td class="px-4 py-2 text-sm text-gray-700">{{ $admin->email }}</td>
                        <td class="px-4 py-2 text-sm text-gray-700">{{ $admin->role }}</td>
                        <td class="px-4 py-2 text-sm text-gray-500">{{ $admin->created_at?->format('Y-m-d') }}</td>
                        <td class="px-4 py-2 text-sm text-gray-500">
                            <a href="{{ route('admin.users.edit', $admin->id) }}" class="inline-block px-4 py-2 bg-blue-600 text-white font-semibold rounded hover:bg-blue-700 transition">
                               Edit
                             </a>
                            <form action="{{ route('admin.users.destroy', $admin) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-block px-4 py-2 bg-red-600 text-white font-semibold rounded hover:bg-red-700 transition">
                                            Delete
                                </button>
                            </form>
                            </form>
                            
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

      
    </div>
