<div class="max-w-xl mx-auto py-10">
    <div class="mb-6 flex justify-between items-center">
        <h1 class="text-2xl font-bold">Edit Menu Item</h1>
        <div class="space-x-3">
            <a href="{{ route('admin.menu-items.index') }}" class="text-blue-600">Back to Menu Items</a>
            <a href="{{ route('admin.dashboard') }}" class="text-blue-600">Back to Dashboard</a>
        </div>
    </div>
    <!-- Success Message -->
    @if(session('success'))
        <div class="mb-4 text-green-600 font-medium">
            {{ session('success') }}
        </div>
    @endif

    <!-- Validation Errors -->
    @if($errors->any())
        <div class="mb-4">
            <ul class="text-red-600 text-sm list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.menu-items.update', $menuItem->id) }}" method="POST" class="space-y-4 bg-white p-6 rounded shadow" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div>
            <label class="block font-semibold mb-1">Menu Name</label>
            <input name="name" class="w-full p-2 border rounded" value="{{ old('name', $menuItem->name) }}" required>
            @error('name')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="block font-semibold mb-1">Group Name</label>
            <select name="group_name" class="w-full p-2 border rounded" required>
                <option value="">Select a group</option>
                @foreach(['Main Course', 'Dessert', 'Drink', 'Appetizer', 'Side Dish'] as $group)
                    <option value="{{ $group }}" {{ old('group_name', $menuItem->group_name) == $group ? 'selected' : '' }}>{{ $group }}</option>
                @endforeach
            </select>
            @error('group_name')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="block font-semibold mb-1">Link / URL</label>
            <input name="link" class="w-full p-2 border rounded" value="{{ old('link', $menuItem->link) }}" required>
            @error('link')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="block font-semibold mb-1">Description (optional)</label>
            <textarea name="description" class="w-full p-2 border rounded" rows="3">{{ old('description', $menuItem->description) }}</textarea>
            @error('description')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="block font-semibold mb-1">Price</label>
            <input name="price" type="number" step="0.01" min="0" class="w-full p-2 border rounded" value="{{ old('price', $menuItem->price) }}" required>
            @error('price')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="block font-semibold mb-1">Image (optional)</label>
            <input type="file" name="image" class="w-full p-2 border rounded">
            @if($menuItem->image)
                <p class="mt-2 text-sm text-gray-600">Current image:</p>
                <img src="{{ asset('storage/' . $menuItem->image) }}" alt="{{ $menuItem->name }}" class="mt-2 h-20 w-20 object-cover rounded-md">
                <div class="flex items-center mt-2">
                    <input type="checkbox" name="remove_image" value="1" class="mr-2">
                    <label class="text-sm text-gray-900">Remove current image</label>
                </div>
            @endif
            @error('image')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
        </div>

        <div class="pt-2">
            <button class="px-4 py-2 bg-gray-900 text-white rounded">Update Menu Item</button>
        </div>
    </form>
</div>
