@extends('admin.layouts.admin')

@section('title', 'Pending Orders - Admin')
@section('header_title', 'Pending Orders Management')
@section('content_title', 'Pending Orders')

@section('content')
<!-- Success Message -->
@if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

<!-- Orders Statistics -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-yellow-500 rounded-md flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Pending Orders</dt>
                        <dd class="text-lg font-medium text-gray-900">{{ $statistics['pending'] ?? 0 }}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-blue-500 rounded-md flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </div>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Preparing</dt>
                        <dd class="text-lg font-medium text-gray-900">{{ $statistics['preparing'] ?? 0 }}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-green-500 rounded-md flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Completed</dt>
                        <dd class="text-lg font-medium text-gray-900">{{ $statistics['completed'] ?? 0 }}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-gray-500 rounded-md flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" />
                        </svg>
                    </div>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Today's Revenue</dt>
                        <dd class="text-lg font-medium text-gray-900">${{ number_format($statistics['todays_revenue'] ?? 0, 2) }}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Filter Tabs -->
<div class="mb-6">
    <div class="border-b border-gray-200">
        <nav class="-mb-px flex space-x-8">
            <a href="{{ route('admin.orders.index') }}"
               class="@if(!request('status')) border-indigo-500 text-indigo-600 @else border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 @endif whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm">
                All Orders ({{ $statistics['total_orders'] ?? 0 }})
            </a>
            <a href="{{ route('admin.orders.index', ['status' => 'pending']) }}"
               class="@if(request('status') === 'pending') border-yellow-500 text-yellow-600 @else border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 @endif whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm">
                Pending ({{ $statistics['pending'] ?? 0 }})
            </a>
            <a href="{{ route('admin.orders.index', ['status' => 'preparing']) }}"
               class="@if(request('status') === 'preparing') border-blue-500 text-blue-600 @else border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 @endif whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm">
                Preparing ({{ $statistics['preparing'] ?? 0 }})
            </a>
            <a href="{{ route('admin.orders.index', ['status' => 'completed']) }}"
               class="@if(request('status') === 'completed') border-green-500 text-green-600 @else border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 @endif whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm">
                Completed ({{ $statistics['completed'] ?? 0 }})
            </a>
        </nav>
    </div>
</div>

<!-- Real-time Notifications -->
<div id="notification-area" class="hidden mb-4">
    <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded" id="notification">
        <!-- Dynamic notifications will appear here -->
    </div>
</div>

<!-- Orders List -->
@if($orders->count() > 0)
    <div class="space-y-6">
        @foreach($orders as $order)
            <div class="bg-white shadow rounded-lg overflow-hidden">
                <!-- Order Header -->
                <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                    <div class="flex items-center space-x-4">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Order #{{ $order->id }}</h3>
                            <p class="text-sm text-gray-500">{{ $order->created_at->format('M d, Y - g:i A') }}</p>
                        </div>
                        <div class="flex items-center space-x-2">
                            @if($order->status === 'pending')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                    <svg class="w-2 h-2 mr-1" fill="currentColor" viewBox="0 0 8 8">
                                        <circle cx="4" cy="4" r="3" />
                                    </svg>
                                    Pending
                                </span>
                            @elseif($order->status === 'preparing')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    <svg class="w-2 h-2 mr-1" fill="currentColor" viewBox="0 0 8 8">
                                        <circle cx="4" cy="4" r="3" />
                                    </svg>
                                    Preparing
                                </span>
                            @elseif($order->status === 'completed')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    <svg class="w-2 h-2 mr-1" fill="currentColor" viewBox="0 0 8 8">
                                        <circle cx="4" cy="4" r="3" />
                                    </svg>
                                    Completed
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                    <svg class="w-2 h-2 mr-1" fill="currentColor" viewBox="0 0 8 8">
                                        <circle cx="4" cy="4" r="3" />
                                    </svg>
                                    Cancelled
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-2xl font-bold text-gray-900">${{ number_format($order->total, 2) }}</p>
                    </div>
                </div>

                <!-- Customer Information -->
                <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Customer Name</p>
                            <p class="text-sm text-gray-900">{{ $order->customer_name }}</p>
                        </div>
                        @if($order->customer_phone)
                            <div>
                                <p class="text-sm font-medium text-gray-500">Phone</p>
                                <p class="text-sm text-gray-900">{{ $order->customer_phone }}</p>
                            </div>
                        @endif
                        @if($order->table_number)
                            <div>
                                <p class="text-sm font-medium text-gray-500">Table Number</p>
                                <p class="text-sm text-gray-900">Table {{ $order->table_number }}</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Order Items -->
                <div class="px-6 py-4">
                    <h4 class="text-sm font-medium text-gray-900 mb-4">Order Items</h4>
                    <div class="space-y-3">
                        @foreach($order->items as $item)
                            <div class="flex justify-between items-center">
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-900">{{ $item->menuItem->name }}</p>
                                    <p class="text-sm text-gray-500">Quantity: {{ $item->quantity }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm font-medium text-gray-900">${{ number_format($item->price, 2) }} each</p>
                                    <p class="text-sm text-gray-500">Total: ${{ number_format($item->price * $item->quantity, 2) }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Action Buttons -->
                @if($order->status !== 'completed' && $order->status !== 'cancelled')
                    <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-between items-center">
                        <div class="flex space-x-2">
                            <button onclick="printOrder({{ $order->id }})" class="bg-gray-600 text-white px-3 py-1 rounded text-sm hover:bg-gray-700 transition-colors">
                                Print
                            </button>
                            <a href="{{ route('admin.orders.show', $order->id) }}" class="bg-indigo-600 text-white px-3 py-1 rounded text-sm hover:bg-indigo-700 transition-colors">
                                View Details
                            </a>
                        </div>
                        <div class="flex space-x-3">
                            @if($order->status === 'pending')
                                <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="inline">
                                    @csrf
                                    <input type="hidden" name="status" value="preparing">
                                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-blue-700 transition-colors">
                                        Start Preparing
                                    </button>
                                </form>
                                <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="inline">
                                    @csrf
                                    <input type="hidden" name="status" value="cancelled">
                                    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-red-700 transition-colors" onclick="return confirm('Are you sure you want to cancel this order?')">
                                        Cancel
                                    </button>
                                </form>
                            @elseif($order->status === 'preparing')
                                <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="inline">
                                    @csrf
                                    <input type="hidden" name="status" value="completed">
                                    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-green-700 transition-colors">
                                        Mark as Ready
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        @endforeach
    </div>
@else
    <!-- Empty State -->
    <div class="text-center py-12">
        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
        </svg>
        <h3 class="mt-2 text-sm font-medium text-gray-900">No orders found</h3>
        <p class="mt-1 text-sm text-gray-500">No orders match the current filter criteria.</p>
    </div>
@endif

<!-- Enhanced JavaScript for real-time updates and interactions -->
<script>
    let autoRefresh;
    let lastActivity = Date.now();

    // Auto-refresh functionality
    function startAutoRefresh() {
        autoRefresh = setInterval(function() {
            // Only refresh if user has been inactive for more than 10 seconds
            if (Date.now() - lastActivity > 10000) {
                updateOrderCounts();
            }
        }, 15000); // Check every 15 seconds
    }

    // Update order counts without full page refresh
    function updateOrderCounts() {
        fetch('{{ route("admin.orders.statistics") }}')
            .then(response => response.json())
            .then(data => {
                // Update statistics cards
                updateStatisticsDisplay(data);

                // Show notification if there are new pending orders
                const currentPending = parseInt(document.querySelector('[data-pending-count]')?.textContent || '0');
                if (data.pending > currentPending) {
                    showNotification(`${data.pending - currentPending} new order(s) received!`, 'info');
                }
            })
            .catch(error => console.error('Error updating counts:', error));
    }

    // Update statistics display
    function updateStatisticsDisplay(stats) {
        // Update tab counts
        const tabs = document.querySelectorAll('nav a');
        tabs.forEach(tab => {
            if (tab.href.includes('status=pending')) {
                tab.innerHTML = tab.innerHTML.replace(/Pending \(\d+\)/, `Pending (${stats.pending})`);
            } else if (tab.href.includes('status=preparing')) {
                tab.innerHTML = tab.innerHTML.replace(/Preparing \(\d+\)/, `Preparing (${stats.preparing})`);
            } else if (tab.href.includes('status=completed')) {
                tab.innerHTML = tab.innerHTML.replace(/Completed \(\d+\)/, `Completed (${stats.completed})`);
            }
        });
    }

    // Show notification
    function showNotification(message, type = 'info') {
        const notificationArea = document.getElementById('notification-area');
        const notification = document.getElementById('notification');

        notification.textContent = message;
        notification.className = `px-4 py-3 rounded ${getNotificationClasses(type)}`;
        notificationArea.classList.remove('hidden');

        setTimeout(() => {
            notificationArea.classList.add('hidden');
        }, 5000);
    }

    // Get notification CSS classes based on type
    function getNotificationClasses(type) {
        const classes = {
            'info': 'bg-blue-100 border border-blue-400 text-blue-700',
            'success': 'bg-green-100 border border-green-400 text-green-700',
            'warning': 'bg-yellow-100 border border-yellow-400 text-yellow-700',
            'error': 'bg-red-100 border border-red-400 text-red-700'
        };
        return classes[type] || classes.info;
    }

    // Print order function
    function printOrder(orderId) {
        const printUrl = `{{ url('admin/orders') }}/${orderId}/print`;
        window.open(printUrl, '_blank', 'width=800,height=600');
    }

    // Track user activity
    document.addEventListener('click', function() {
        lastActivity = Date.now();
    });

    document.addEventListener('keypress', function() {
        lastActivity = Date.now();
    });

    // Initialize auto-refresh
    startAutoRefresh();

    // Sound notification for new orders (optional)
    function playNotificationSound() {
        // You can add a notification sound here
        // const audio = new Audio('/sounds/notification.mp3');
        // audio.play().catch(e => console.log('Could not play notification sound'));
    }

    // Keyboard shortcuts
    document.addEventListener('keydown', function(e) {
        // Ctrl + R for manual refresh
        if (e.ctrlKey && e.key === 'r') {
            e.preventDefault();
            updateOrderCounts();
        }
    });
</script>
@endsection
