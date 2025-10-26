@extends('admin.layouts.admin')

@section('title', 'Edit Menu Item')
@section('header_title', 'Edit Menu Item')
@section('content_title', 'Update Menu Item')

@section('content')
<div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md p-6">
    <div class="mb-6">
        <a href="{{ route('admin.menu-items.index') }}" class="text-blue-600 hover:text-blue-700 font-medium">
            ← Back to Menu Items
        </a>
    </div>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.menu-items.update', $menuItem->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 gap-6">
            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Menu Item Name *</label>
                <input type="text"
                       id="name"
                       name="name"
                       value="{{ old('name', $menuItem->name) }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                       placeholder="Enter menu item name"
                       required>
            </div>

            <!-- Group Name -->
            <div>
                <label for="group_name" class="block text-sm font-medium text-gray-700 mb-2">Category *</label>
                <select id="group_name"
                        name="group_name"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        required>
                    <option value="">Select Category</option>
                    <option value="Appetizer" {{ old('group_name', $menuItem->group_name) == 'Appetizer' ? 'selected' : '' }}>Appetizer</option>
                    <option value="Main Course" {{ old('group_name', $menuItem->group_name) == 'Main Course' ? 'selected' : '' }}>Main Course</option>
                    <option value="Dessert" {{ old('group_name', $menuItem->group_name) == 'Dessert' ? 'selected' : '' }}>Dessert</option>
                    <option value="Beverage" {{ old('group_name', $menuItem->group_name) == 'Beverage' ? 'selected' : '' }}>Beverage</option>
                    <option value="Side Dish" {{ old('group_name', $menuItem->group_name) == 'Side Dish' ? 'selected' : '' }}>Side Dish</option>
                </select>
            </div>

            <!-- Price -->
            <div>
                <label for="price" class="block text-sm font-medium text-gray-700 mb-2">Price *</label>
                <div class="relative">
                    <span class="absolute left-3 top-2 text-gray-500">$</span>
                    <input type="number"
                           id="price"
                           name="price"
                           value="{{ old('price', $menuItem->price) }}"
                           step="0.01"
                           min="0"
                           class="w-full pl-8 pr-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                           placeholder="0.00"
                           required>
                </div>
            </div>

            <!-- Link -->
            <div>
                <label for="link" class="block text-sm font-medium text-gray-700 mb-2">Link (Optional)</label>
                <input type="url"
                       id="link"
                       name="link"
                       value="{{ old('link', $menuItem->link) }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                       placeholder="https://example.com">
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                <textarea id="description"
                          name="description"
                          rows="4"
                          class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                          placeholder="Describe the menu item...">{{ old('description', $menuItem->description) }}</textarea>
            </div>

            <!-- Current Image Display -->
            @if($menuItem->image)
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Current Image</label>
                <img src="{{ asset('storage/' . $menuItem->image) }}"
                     alt="{{ $menuItem->name }}"
                     class="h-32 w-32 object-cover rounded-lg border">
            </div>
            @endif

            <!-- Image Upload -->
            <div>
                <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                    {{ $menuItem->image ? 'Replace Image' : 'Add Image' }}
                </label>
                <input type="file"
                       id="image"
                       name="image"
                       accept="image/*"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <p class="text-sm text-gray-500 mt-1">Supported formats: JPEG, PNG, JPG, GIF. Max size: 2MB</p>
            </div>

            <!-- Submit Buttons -->
            <div class="flex justify-end space-x-4 pt-4">
                <a href="{{ route('admin.menu-items.index') }}"
                   class="px-6 py-2 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition duration-200">
                    Cancel
                </a>
                <button type="submit"
                        class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-200">
                    Update Menu Item
                </button>
            </div>
        </div>
    </form>
</div>

@section('scripts')
<script>
    // Preview new image before upload
    document.getElementById('image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                // Create or update preview
                let preview = document.getElementById('image-preview');
                if (!preview) {
                    preview = document.createElement('div');
                    preview.id = 'image-preview';
                    preview.innerHTML = '<label class="block text-sm font-medium text-gray-700 mb-2">New Image Preview</label><img class="h-32 w-32 object-cover rounded-lg border">';
                    document.getElementById('image').parentNode.appendChild(preview);
                }
                preview.querySelector('img').src = e.target.result;
                preview.style.display = 'block';
            }
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection
@endsection
