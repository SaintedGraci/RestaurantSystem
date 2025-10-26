<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Admin Dashboard')</title>

  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">

  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('css/style3.css') }}" />
  <meta name="csrf-token" content="{{ csrf_token() }}">

  @yield('styles')
</head>
<body class="bg-gray-100 text-gray-800">

  <!-- Top Navbar -->
  <header class="bg-white shadow px-6 py-4 flex justify-between items-center">
    <!-- Hamburger Button -->
    <button id="menuToggle" class="text-2xl md:hidden focus:outline-none">
      ☰
    </button>

    <h1 class="text-xl font-bold">@yield('header_title', 'Admin Dashboard')</h1>

    <form action="{{ route('logout') }}" method="POST">
      @csrf
      <button class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition">
        Logout
      </button>
    </form>
  </header>

  <!-- Sidebar + Content Layout -->
  <div class="flex min-h-screen">

    <!-- Sidebar -->
    <aside id="sidebar" class="bg-white w-64 p-6 shadow-md hidden md:fixed md:h-full md:top-0 md:block z-50 transition-all duration-300">
      <div class="text-lg font-semibold mb-6">
        Welcome, {{ auth()->user()->name }}
        <div class="text-sm text-gray-500">Role: {{ auth()->user()->role }}</div>
      </div>

      <nav class="flex flex-col space-y-2">
        <a href="{{ route('admin.orders.index') }}" class="flex items-center px-4 py-2 text-gray-700 hover:bg-indigo-100 hover:text-indigo-700 rounded-lg transition duration-200"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
  <path fill-rule="evenodd" d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm-2 5V6a2 2 0 114 0v1H8z" clip-rule="evenodd" />
</svg>Pending Orders</a>
        <a href="{{ route('admin.users.index') }}" class="flex items-center px-4 py-2 text-gray-700 hover:bg-indigo-100 hover:text-indigo-700 rounded-lg transition duration-200"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
  <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
</svg>Manage Users</a>
        <a href="{{ route('admin.menu-items.index') }}" class="flex items-center px-4 py-2 text-gray-700 hover:bg-indigo-100 hover:text-indigo-700 rounded-lg transition duration-200"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
  <path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2h-2zM11 13a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2h-2z" />
</svg>View Menu Items</a>
        <a href="{{ route('admin.menu-items.create') }}" class="flex items-center px-4 py-2 text-gray-700 hover:bg-indigo-100 hover:text-indigo-700 rounded-lg transition duration-200"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
  <path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2h-2zM11 13a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2h-2z" />
</svg>Add New Menu Item</a>
        <!-- Add more links here -->
      </nav>
    </aside>

    <!-- Main Content -->
    <main id="mainContent" class="flex-1 p-6 md:ml-64">
      <div class="text-2xl font-bold mb-4" id="content-title">@yield('content_title', 'Dashboard Overview')</div>

      <div id="content-area">
        @yield('content')
      </div>
    </main>

  </div>

  <!-- Mobile Sidebar Toggle -->
  <script>
    const toggleBtn = document.getElementById('menuToggle');
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('mainContent');
    const contentArea = document.getElementById('content-area');
    const contentTitle = document.getElementById('content-title');

    function loadContent(url, title) {
        fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.text())
        .then(html => {
            contentArea.innerHTML = html;
            contentTitle.textContent = title;
            // Close sidebar on mobile after loading content
            if (window.innerWidth < 768) { // Tailwind's md breakpoint is 768px
                sidebar.classList.add('hidden');
                mainContent.classList.remove('overlay-active');
            }
        })
        .catch(error => console.error('Error loading content:', error));
    }

    toggleBtn.addEventListener('click', () => {
      sidebar.classList.toggle('hidden');
      mainContent.classList.toggle('md:ml-64'); // Keep main content pushed right on desktop
      mainContent.classList.toggle('overlay-active'); // Add overlay class
    });

    // Event listeners for sidebar links
    document.querySelectorAll('#sidebar nav a').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const url = this.href;
            const title = this.textContent.trim(); // Get text content for title
            loadContent(url, title);
        });
    });

    // Initial load for dashboard if needed (e.g., on page refresh if not already on dashboard)
    // loadContent('{{ route('admin.dashboard') }}', 'Dashboard Overview'); // Uncomment if you want to load dashboard content via AJAX on initial page load

  </script>

  @yield('scripts')
</body>
</html>
