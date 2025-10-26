<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Menu Item - Tindahan ni Aling Dadai</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
</head>
<body class="bg-gray-50">
    <!-- Header -->
    <nav class="bg-gradient-to-r from-green-600 to-green-800 text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <h1 class="text-2xl font-bold">Edit Menu Item</h1>
                    <span class="ml-4 text-green-200">Welcome, {{ auth()->user()->name }}</span>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('admin.dashboard') }}" class="bg-white/20 hover:bg-white/30 px-4 py-2 rounded-lg transition">
                        Back to Dashboard
                    </a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded-lg transition">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Success Message -->
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded">
                <div class="flex">
                    <div class="ml-3">
                        <p class="text-sm font-medium">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Error Messages -->
        @if($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded">
                <div class="flex">
                    <div class="ml-3">
                        <ul class="text-sm">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <!-- Edit Form -->
        <div class="bg-white rounded-xl shadow-lg p-8">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-3xl font-bold text-gray-900">Edit Menu Item</h2>
                <a href="{{ route('admin.dashboard') }}" class="text-blue-600 hover:text-blue-800 font-medium">
                    ← Back to Dashboard
                </a>
            </div>

            <form action="{{ route('admin.menu-items.update', $menuItem->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Menu Name</label>
                        <input type="text" name="name" value="{{ old('name', $menuItem->name) }}" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent" required>
                        @error('name')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Price</label>
                        <input type="number" name="price" step="0.01" min="0" value="{{ old('price', $menuItem->price) }}" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent" required>
                        @error('price')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Group Name</label>
                        <select name="group_name" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent" required>
                            <option value="">Select a group</option>
                            @foreach(['Main Course', 'Dessert', 'Drink', 'Appetizer', 'Side Dish'] as $group)
                                <option value="{{ $group }}" {{ old('group_name', $menuItem->group_name) == $group ? 'selected' : '' }}>
                                    {{ $group }}
                                </option>
                            @endforeach
                        </select>
                        @error('group_name')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Link / URL</label>
                        <input type="text" name="link" value="{{ old('link', $menuItem->link) }}" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent" 
                               placeholder="e.g. /home">
                        @error('link')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                        <textarea name="description" rows="3" 
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent" 
                                  placeholder="Brief description...">{{ old('description', $menuItem->description) }}</textarea>
                        @error('description')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Image</label>
                        @if($menuItem->image)
                            <div class="mb-4">
                                <p class="text-sm text-gray-600 mb-2">Current image:</p>
                                <img src="{{ asset('storage/' . $menuItem->image) }}" 
                                     alt="{{ $menuItem->name }}" 
                                     class="h-32 w-32 object-cover rounded-lg border">
                                <div class="mt-2">
                                    <label class="flex items-center">
                                        <input type="checkbox" name="remove_image" value="1" class="mr-2">
                                        <span class="text-sm text-gray-700">Remove current image</span>
                                    </label>
                                </div>
                            </div>
                        @endif
                        <input type="file" name="image" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                        @error('image')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex space-x-4">
                    <button type="submit" class="bg-gradient-to-r from-green-600 to-green-700 text-white px-8 py-3 rounded-lg hover:from-green-700 hover:to-green-800 transition-all duration-200 font-semibold">
                        Update Menu Item
                    </button>
                    <a href="{{ route('admin.dashboard') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-8 py-3 rounded-lg transition-all duration-200 font-semibold">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
