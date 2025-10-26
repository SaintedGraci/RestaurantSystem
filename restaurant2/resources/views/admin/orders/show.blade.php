@extends('admin.layouts.admin')

@section('title', 'Order Details - Admin')
@section('header_title', 'Order Management')
@section('content_title', 'Order #' . $order->id . ' Details')

@section('content')
<!-- Success/Error Messages -->
@if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        {{ session('error') }}
    </div>
@endif

<!-- Back Button -->
<div class="mb-6">
    <a href="{{ route('admin.orders.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-500 hover:bg-gray-700 text-white text-sm font-medium rounded-md transition-colors">
        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
        </svg>
        Back to Orders
    </a>
</div>

<!-- Order Header -->
<div class="bg-white shadow rounded-lg overflow-hidden mb-6">
    <div class="px-6 py-4 border-b border-gray-200">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Order #{{ $order->id }}</h1>
                <p class="text-sm text-gray-500 mt-1">
                    Placed on {{ $order->created_at->format('M d, Y \a\t g:i A') }}
                    <span class="mx-2">•</span>
                    {{ $order->created_at->diffForHumans() }}
                </p>
            </div>
            <div class="flex items-center space-x-4">
                <!-- Status Badge -->
                @if($order->status === 'pending')
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 8 8">
                            <circle cx="4" cy="4" r="3" />
                        </svg>
                        Pending
                    </span>
                @elseif($order->status === 'preparing')
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 8 8">
                            <circle cx="4" cy="4" r="3" />
                        </svg>
                        Preparing
                    </span>
                @elseif($order->status === 'completed')
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 8 8">
                            <circle cx="4" cy="4" r="3" />
                        </svg>
                        Completed
                    </span>
                @else
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 8 8">
                            <circle cx="4" cy="4" r="3" />
                        </svg>
                        Cancelled
                    </span>
                @endif

                <!-- Total Amount -->
                <div class="text-right">
                    <p class="text-2xl font-bold text-gray-900">${{ number_format($order->total, 2) }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Customer Information -->
    <div class="px-6 py-4 bg-gray-50">
        <h3 class="text-lg font-medium text-gray-900 mb-4">Customer Information</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-gray-500">Customer Name</p>
                    <p class="text-sm text-gray-900">{{ $order->customer_name }}</p>
                </div>
            </div>

            @if($order->customer_phone)
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-gray-500">Phone Number</p>
                    <p class="text-sm text-gray-900">{{ $order->customer_phone }}</p>
                </div>
            </div>
            @endif

            @if($order->table_number)
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-gray-500">Table Number</p>
                    <p class="text-sm text-gray-900">Table {{ $order->table_number }}</p>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Order Items -->
<div class="bg-white shadow rounded-lg overflow-hidden mb-6">
    <div class="px-6 py-4 border-b border-gray-200">
        <h3 class="text-lg font-medium text-gray-900">Order Items</h3>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Item</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subtotal</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($order->items as $item)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            @if($item->menuItem->image)
                                <img class="h-12 w-12 rounded-lg object-cover mr-4" src="{{ asset('storage/' . $item->menuItem->image) }}" alt="{{ $item->menuItem->name }}">
                            @else
                                <div class="h-12 w-12 rounded-lg bg-gray-200 flex items-center justify-center mr-4">
                                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                            @endif
                            <div>
                                <div class="text-sm font-medium text-gray-900">{{ $item->menuItem->name }}</div>
                                @if($item->menuItem->description)
                                    <div class="text-sm text-gray-500">{{ Str::limit($item->menuItem->description, 50) }}</div>
                                @endif
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        ${{ number_format($item->price, 2) }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                            {{ $item->quantity }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        ${{ number_format($item->price * $item->quantity, 2) }}
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot class="bg-gray-50">
                <tr>
                    <td colspan="3" class="px-6 py-3 text-right text-sm font-medium text-gray-900">
                        Total:
                    </td>
                    <td class="px-6 py-3 text-sm font-bold text-gray-900">
                        ${{ number_format($order->total, 2) }}
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<!-- Order Timeline -->
<div class="bg-white shadow rounded-lg overflow-hidden mb-6">
    <div class="px-6 py-4 border-b border-gray-200">
        <h3 class="text-lg font-medium text-gray-900">Order Timeline</h3>
    </div>
    <div class="px-6 py-4">
        <div class="flow-root">
            <ul class="-mb-8">
                <li>
                    <div class="relative pb-8">
                        <div class="relative flex space-x-3">
                            <div>
                                <span class="h-8 w-8 rounded-full bg-green-500 flex items-center justify-center ring-8 ring-white">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                    </svg>
                                </span>
                            </div>
                            <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                <div>
                                    <p class="text-sm text-gray-500">Order placed</p>
                                </div>
                                <div class="text-right text-sm whitespace-nowrap text-gray-500">
                                    {{ $order->created_at->format('M d, g:i A') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </li>

                @if($order->status !== 'pending')
                <li>
                    <div class="relative pb-8">
                        <div class="relative flex space-x-3">
                            <div>
                                <span class="h-8 w-8 rounded-full bg-blue-500 flex items-center justify-center ring-8 ring-white">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </span>
                            </div>
                            <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                <div>
                                    <p class="text-sm text-gray-500">
                                        @if($order->status === 'preparing')
                                            Order is being prepared
                                        @elseif($order->status === 'completed')
                                            Order started preparation
                                        @elseif($order->status === 'cancelled')
                                            Order was cancelled
                                        @endif
                                    </p>
                                </div>
                                <div class="text-right text-sm whitespace-nowrap text-gray-500">
                                    {{ $order->updated_at->format('M d, g:i A') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                @endif

                @if($order->status === 'completed')
                <li>
                    <div class="relative">
                        <div class="relative flex space-x-3">
                            <div>
                                <span class="h-8 w-8 rounded-full bg-green-500 flex items-center justify-center ring-8 ring-white">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </span>
                            </div>
                            <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                <div>
                                    <p class="text-sm text-gray-500">Order completed</p>
                                </div>
                                <div class="text-right text-sm whitespace-nowrap text-gray-500">
                                    {{ $order->updated_at->format('M d, g:i A') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                @endif
            </ul>
        </div>
    </div>
</div>

<!-- Action Buttons -->
@if($order->status !== 'completed' && $order->status !== 'cancelled')
<div class="bg-white shadow rounded-lg overflow-hidden">
    <div class="px-6 py-4">
        <h3 class="text-lg font-medium text-gray-900 mb-4">Actions</h3>
        <div class="flex flex-wrap gap-3">
            @if($order->status === 'pending')
                <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="inline">
                    @csrf
                    <input type="hidden" name="status" value="preparing">
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-md transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Start Preparing
                    </button>
                </form>

                <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="inline">
                    @csrf
                    <input type="hidden" name="status" value="cancelled">
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-md transition-colors" onclick="return confirm('Are you sure you want to cancel this order?')">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        Cancel Order
                    </button>
                </form>

            @elseif($order->status === 'preparing')
                <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="inline">
                    @csrf
                    <input type="hidden" name="status" value="completed">
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-md transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Mark as Ready
                    </button>
                </form>
            @endif

            <button onclick="printOrder()" class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white text-sm font-medium rounded-md transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                </svg>
                Print Order
            </button>
        </div>
    </div>
</div>
@endif

<script>
function printOrder() {
    const printUrl = '{{ route("admin.orders.print", $order->id) }}';
    window.open(printUrl, '_blank', 'width=800,height=600');
}
</script>
@endsection
