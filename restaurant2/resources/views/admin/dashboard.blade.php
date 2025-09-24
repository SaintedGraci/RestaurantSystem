<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/css/style1.css"> <!-- Keep if needed, but we'll minimize custom CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>body { font-family: 'Poppins', sans-serif; }</style>
</head>
<body class="bg-gray-100"> <!-- Added light bg for better visibility -->
    <div class="parentcontainer relative w-full min-h-screen p-4"> <!-- Added width/height reference -->
         
        <div class="subcon1 absolute top-4 left-6"> <!-- Use top/left instead of margins -->
            <h1 class="text-2xl font-bold text-gray-800">Admin Dashboard</h1>
        </div>     
        
        <!-- Welcome Message -->
        <div class="subcon2 absolute top-4 left-1/4"> <!-- left-1/4 for responsive centering-ish -->
            <div class="text-gray-700 font-medium">Welcome, {{ auth()->user()->name }}</div> <!-- Fixed typo -->
        </div>

        <!-- Role -->
        <div class="subcon3 absolute top-12 left-1/4 ml-4"> <!-- Slight offset from welcome -->
            <div class="text-gray-600">Role: {{ auth()->user()->role }}</div>
        </div>

        <!-- Logout Button: Now pinned to top-right -->
        <div class="logout-btn absolute top-4 right-4 bg-red-600 py-2 px-4 rounded-lg shadow-md hover:bg-red-700 hover:shadow-lg transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-red-500 z-10"> <!-- Added z-10 to stay on top -->
            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="text-white font-semibold no-underline">Logout</button> <!-- Fixed btn class -->
            </form>
        </div>

        <!-- Manage User Button -->
       <!-- Manage User Button: Left-aligned in the horizontal center -->
<div class="manage-btn absolute top-1/2 left-1/4 transform -translate-x-1/2 -translate-y-1/2 bg-indigo-600 py-20 px-20 text-white font-semibold rounded-lg shadow-md hover:bg-indigo-700 hover:shadow-lg transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 text-lg w-auto z-10">
    <a href="{{ route('admin.manage-menu') }}" class="block no-underline text-center">Manage User</a>
    <!-- Added block text-center for better internal alignment -->
</div>

<!-- Manage Menu Button: Right-aligned next to the first -->
<div class="manage-btn absolute top-1/2 left-3/4 transform -translate-x-1/2 -translate-y-1/2 bg-indigo-600 py-20 px-20 text-white font-semibold rounded-lg shadow-md hover:bg-indigo-700 hover:shadow-lg transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 text-lg w-auto z-10">
    <!-- No mt-10; same vertical position for alignment -->
    <a href="{{ route('admin.manage-menu') }}" class="block no-underline text-center">Manage Menu</a>
</div>

    </div>
</body>
</html> 