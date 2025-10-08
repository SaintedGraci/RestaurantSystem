<div class="bg-white shadow-md rounded-lg p-6">
    <h3 class="text-xl font-semibold mb-4">All Menu Items</h3>

    @if(session('status'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('status') }}</span>
        </div>
    @endif

    @if($menuItems->isEmpty())
        <p class="text-gray-600">No menu items found. Start by adding one!</p>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Group</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Link</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
                        <th scope="col" class="relative px-6 py-3"><span class="sr-only">Actions</span></th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($menuItems as $item)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $item->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $item->group_name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">${{ number_format($item->price, 2) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap"><a href="{{ $item->link }}" class="text-indigo-600 hover:text-indigo-900">{{ $item->link }}</a></td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ Str::limit($item->description, 50) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($item->image)
                                    <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}" class="h-10 w-10 object-cover rounded-full">
                                @else
                                    N/A
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('admin.menu-items.edit', $item->id) }}" class="inline-block px-4 py-2 bg-blue-600 text-white font-semibold rounded hover:bg-blue-700 transition">Edit</a>
                                <form action="{{ route('admin.menu-items.destroy', $item->id) }}" method="POST" class="inline-block ml-2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-block px-4 py-2 bg-red-600 text-white font-semibold rounded hover:bg-red-700 transition">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $menuItems->links() }}
        </div>
    @endif
</div>
