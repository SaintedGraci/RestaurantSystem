    <div class="w-full max-w-xl bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-semibold mb-4 text-gray-700">Add New Menu Item</h2>
        <a href="{{ route('admin.dashboard') }}" class="text-blue-600">Back to Dashboard</a>
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

        <form action="{{ route('admin.menu-items.store') }}" method="POST" class="space-y-4" enctype="multipart/form-data">
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Menu Name</label>
                <input type="text" name="name" id="name" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    placeholder="e.g. Home">
            </div>

            <div>
                <label for="group_name" class="block text-sm font-medium text-gray-700">Group Name</label>
                <select name="group_name" id="group_name" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="">Select a group</option>
                    <option value="Main Course">Main Course</option>
                    <option value="Dessert">Dessert</option>
                    <option value="Drink">Drink</option>
                    <option value="Appetizer">Appetizer</option>
                    <option value="Side Dish">Side Dish</option>
                </select>
            </div>

            <div>
                <label for="link" class="block text-sm font-medium text-gray-700">Link / URL</label>
                <input type="text" name="link" id="link" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    placeholder="e.g. /home">
            </div>

                <div>
                <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                <input type="number" name="price" id="price" step="0.01" min="0" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    placeholder="e.g. 12.99">
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Description (optional)</label>
                <textarea name="description" id="description" rows="3"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    placeholder="Brief description..."></textarea>
            </div>

            

            <div>
                <label for="image" class="block text-sm font-medium text-gray-700">Image (optional)</label>
                <input type="file" name="image" id="image"
                    class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
                >
            </div>

            <div>
                <button type="submit"
                    class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Add Menu Item
                </button>
            </div>
        </form> 
    </div>
