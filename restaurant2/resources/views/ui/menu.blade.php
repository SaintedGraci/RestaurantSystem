<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Menu - Tindahan ni Aling Dadai</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#4f6f52',
                        secondary: '#739e73',
                    },
                    fontFamily: {
                        poppins: ['Poppins', 'sans-serif'],
                    },
                }
            }
        }
    </script>
</head>
<body class="bg-gradient-to-br from-[#e0f2df] to-white min-h-screen font-poppins">
    <!-- Header -->
    <nav class="fixed top-0 w-full bg-primary/85 backdrop-blur-md z-50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <img src="https://cdn-icons-png.flaticon.com/128/4035/4035183.png" alt="Logo" class="w-12 h-12 rounded-2xl" />
                <div class="flex space-x-8">
                    <a href="{{ route('home') }}" class="text-white font-bold hover:text-yellow-200 px-3 py-2 rounded-full hover:bg-white/10 transition-all">Home</a>
                    <a href="#menu" class="text-white font-bold hover:text-yellow-200 px-3 py-2 rounded-full hover:bg-white/10 transition-all">Menu</a>
                    <a href="{{ route('about') }}" class="text-white font-bold hover:text-yellow-200 px-3 py-2 rounded-full hover:bg-white/10 transition-all">About Us</a>
                    <a href="{{ route('location') }}" class="text-white font-bold hover:text-yellow-200 px-3 py-2 rounded-full hover:bg-white/10 transition-all">Location</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Cart Display Modal -->
    <div id="cart-display" class="fixed top-16 right-4 z-40 bg-white/90 backdrop-blur-md rounded-2xl shadow-xl border border-white/50 p-4 max-w-sm hidden">
        <div class="flex items-center justify-between mb-3">
            <h3 class="text-lg font-bold text-primary">Shopping Cart</h3>
            <button id="close-cart" class="text-gray-500 hover:text-gray-700">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <div id="cart-items" class="space-y-2 max-h-64 overflow-y-auto">
            <!-- Cart items will be displayed dynamically -->
        </div>
        <div class="border-t pt-3 mt-3">
            <div class="flex justify-between items-center mb-3">
                <span class="font-bold text-lg">Total:</span>
                <span id="cart-total" class="font-bold text-primary text-lg">₱0.00</span>
            </div>
            <button id="checkout-btn" class="w-full bg-gradient-to-r from-primary to-secondary text-white py-2 px-4 rounded-full hover:scale-105 transition-transform">
                Checkout
            </button>
        </div>
    </div>

    <!-- Cart Toggle Button -->
    <button id="cart-toggle" class="fixed top-20 right-4 z-30 bg-primary text-white p-3 rounded-full shadow-lg hover:scale-105 transition-transform">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m6-5v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6m8 0V9a2 2 0 00-2-2H9a2 2 0 00-2 2v4.01"></path>
        </svg>
        <span id="cart-count" class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center hidden">0</span>
    </button>

    <!-- Main Content -->
    <div class="container mx-auto px-4 pt-24">
        <h1 class="text-4xl font-bold text-center text-primary mb-2">TINDAHAN NI ALING DADAI</h1>
        <p class="text-center text-[#6b5e3c] text-lg mb-12">Our Delicious Filipino Offerings</p>

        @if($menuItems->isEmpty())
            <p class="text-center text-gray-500">No menu items found.</p>
        @else
            @php
                $groupedItems = $menuItems->groupBy('group_name');
                $sectionOrder = ['Main Course', 'Appetizer', 'Side Dish', 'Dessert', 'Drink'];
            @endphp

            @foreach($sectionOrder as $sectionName)
                @if($groupedItems->has($sectionName))
                    <div class="mb-16">
                        <div class="text-center mb-8">
                            <h2 class="text-3xl font-bold text-primary mb-2">{{ $sectionName }}</h2>
                            <div class="w-24 h-1 bg-gradient-to-r from-primary to-secondary mx-auto rounded-full"></div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                            @foreach($groupedItems[$sectionName] as $item)
                                <div class="bg-white/40 backdrop-blur-md rounded-2xl overflow-hidden shadow-lg hover:-translate-y-1 hover:shadow-xl transition-all duration-300 border border-white/50">
                                    @if($item->image)
                                        <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}" class="w-full h-56 object-cover" />
                                    @else
                                        <div class="w-full h-56 bg-gray-100 flex items-center justify-center text-gray-400">
                                            No Image Available
                                        </div>
                                    @endif

                                    <div class="p-6">
                                        <h3 class="text-xl font-semibold text-primary mb-2">{{ $item->name }}</h3>
                                        <p class="text-gray-600 mb-4">{{ $item->description ?? 'No description available.' }}</p>

                                        <div class="mb-4">
                                            <div class="flex justify-between items-center mb-3">
                                                <span class="text-lg font-bold text-primary">₱{{ number_format($item->price, 2) }}</span>
                                                @if($item->link)
                                                    <a href="{{ $item->link }}" class="text-sm text-primary hover:text-secondary transition-colors">View Details</a>
                                                @endif
                                            </div>

                                            <div class="flex items-center justify-between">
                                                <div class="flex items-center space-x-2">
                                                    <button class="quantity-btn decrease w-8 h-8 bg-gray-200 hover:bg-gray-300 rounded-full flex items-center justify-center transition-colors" data-item-id="{{ $item->id }}" data-action="decrease">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                                        </svg>
                                                    </button>
                                                    <span class="quantity-display w-8 text-center font-semibold" data-item-id="{{ $item->id }}">1</span>
                                                    <button class="quantity-btn increase w-8 h-8 bg-gray-200 hover:bg-gray-300 rounded-full flex items-center justify-center transition-colors" data-item-id="{{ $item->id }}" data-action="increase">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                                        </svg>
                                                    </button>
                                                </div>

                                                <button class="add-to-cart-btn bg-gradient-to-r from-primary to-secondary text-white px-4 py-2 rounded-full hover:scale-105 transition-transform text-sm font-medium"
                                                        data-item-id="{{ $item->id }}"
                                                        data-item-name="{{ $item->name }}"
                                                        data-item-price="{{ $item->price }}"
                                                        data-item-image="{{ $item->image ? asset('storage/' . $item->image) : '' }}">
                                                    Add to Cart
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            @endforeach

            <!-- Render any extra groups not in predefined sections -->
            @foreach($groupedItems as $groupName => $items)
                @if(!in_array($groupName, $sectionOrder))
                    <div class="mb-16">
                        <div class="text-center mb-8">
                            <h2 class="text-3xl font-bold text-primary mb-2">{{ $groupName }}</h2>
                            <div class="w-24 h-1 bg-gradient-to-r from-primary to-secondary mx-auto rounded-full"></div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                            @foreach($items as $item)
                                <div class="bg-white/40 backdrop-blur-md rounded-2xl overflow-hidden shadow-lg hover:-translate-y-1 hover:shadow-xl transition-all duration-300 border border-white/50">
                                    @if($item->image)
                                        <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}" class="w-full h-56 object-cover" />
                                    @else
                                        <div class="w-full h-56 bg-gray-100 flex items-center justify-center text-gray-400">
                                            No Image Available
                                        </div>
                                    @endif
                                    <div class="p-6">
                                        <h3 class="text-xl font-semibold text-primary mb-2">{{ $item->name }}</h3>
                                        <p class="text-gray-600 mb-4">{{ $item->description ?? 'No description available.' }}</p>

                                        <div class="mb-4">
                                            <div class="flex justify-between items-center mb-3">
                                                <span class="text-lg font-bold text-primary">₱{{ number_format($item->price, 2) }}</span>
                                                @if($item->link)
                                                    <a href="{{ $item->link }}" class="text-sm text-primary hover:text-secondary transition-colors">View Details</a>
                                                @endif
                                            </div>

                                            <div class="flex items-center justify-between">
                                                <div class="flex items-center space-x-2">
                                                    <button class="quantity-btn decrease w-8 h-8 bg-gray-200 hover:bg-gray-300 rounded-full flex items-center justify-center transition-colors" data-item-id="{{ $item->id }}" data-action="decrease">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                                        </svg>
                                                    </button>
                                                    <span class="quantity-display w-8 text-center font-semibold" data-item-id="{{ $item->id }}">1</span>
                                                    <button class="quantity-btn increase w-8 h-8 bg-gray-200 hover:bg-gray-300 rounded-full flex items-center justify-center transition-colors" data-item-id="{{ $item->id }}" data-action="increase">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                                        </svg>
                                                    </button>
                                                </div>

                                                <button class="add-to-cart-btn bg-gradient-to-r from-primary to-secondary text-white px-4 py-2 rounded-full hover:scale-105 transition-transform text-sm font-medium"
                                                        data-item-id="{{ $item->id }}"
                                                        data-item-name="{{ $item->name }}"
                                                        data-item-price="{{ $item->price }}"
                                                        data-item-image="{{ $item->image ? asset('storage/' . $item->image) : '' }}">
                                                    Add to Cart
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            @endforeach
        @endif
    </div>

    <!-- Checkout Modal -->
<div id="checkout-modal" class="fixed inset-0 bg-black/40 backdrop-blur-sm flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-2xl p-8 w-96 max-w-full shadow-xl relative">
        <button id="close-modal" class="absolute top-3 right-3 text-gray-500 hover:text-gray-700">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
        <h2 class="text-2xl font-bold text-primary mb-4">Checkout</h2>
        <form id="checkout-form" class="space-y-4">
            <div>
                <label class="block text-gray-700 font-medium mb-1" for="customer-name">Name</label>
                <input type="text" id="customer-name" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-primary" required>
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-1" for="customer-phone">Phone Number</label>
                <input type="text" id="customer-phone" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-primary" required>
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-1" for="table-number">Table Number (Optional)</label>
                <input type="text" id="table-number" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-primary" placeholder="Enter table number">
            </div>
            <button type="submit" class="w-full bg-gradient-to-r from-primary to-secondary text-white py-2 rounded-full hover:scale-105 transition-transform font-semibold">Confirm Order</button>
        </form>
    </div>
</div>

    <!-- Scripts -->
    <script src="{{ asset('js/menu.js') }}"></script>
</body>
</html>
