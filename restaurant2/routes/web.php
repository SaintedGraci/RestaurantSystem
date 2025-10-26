<?php

use App\Http\Controllers\WebController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Admin\MenuItemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\UIcontroller;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [WebController::class, 'index'])->name('home');
Route::get('/about', [WebController::class, 'about'])->name('about');
Route::get('/menu', [UIcontroller::class, 'menu'])->name('menu');
Route::get('/location', [UIcontroller::class, 'location'])->name('location');

/*
|--------------------------------------------------------------------------
| Order Routes (Customer Side)
|--------------------------------------------------------------------------
| Handles order checkout from the public menu page.
*/
Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
| Protected by auth and role:admin middleware.
*/
Route::middleware(['auth', 'role:admin'])->group(function () {

    // Admin Dashboard
    Route::get('/admin', function () {
        $menuItems = \App\Models\MenuItem::all();
        return view('admin.dashboard', compact('menuItems'));
    })->name('admin.dashboard');

    /*
    |--------------------------------------------------------------------------
    | User Management
    |--------------------------------------------------------------------------
    */
    Route::prefix('admin/users')->name('admin.users.')->group(function () {
        Route::get('/', [AdminUserController::class, 'index'])->name('index');
        Route::get('/create', [AdminUserController::class, 'create'])->name('create');
        Route::post('/', [AdminUserController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [AdminUserController::class, 'edit'])->name('edit');
        Route::put('/{id}', [AdminUserController::class, 'update'])->name('update');
        Route::delete('/{id}', [AdminUserController::class, 'destroy'])->name('destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | Menu Item Management
    |--------------------------------------------------------------------------
    */
    Route::prefix('admin/menu-items')->name('admin.menu-items.')->group(function () {
        Route::get('/', [MenuItemController::class, 'index'])->name('index');
        Route::get('/create', [MenuItemController::class, 'create'])->name('create');
        Route::post('/', [MenuItemController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [MenuItemController::class, 'edit'])->name('edit');
        Route::put('/{id}', [MenuItemController::class, 'update'])->name('update');
        Route::delete('/{id}', [MenuItemController::class, 'destroy'])->name('destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | Order Management (Admin Side)
    |--------------------------------------------------------------------------
    | Admin can view, update status, and manage orders.
    */
    Route::prefix('admin/orders')->name('admin.orders.')->group(function () {
        Route::get('/', [AdminOrderController::class, 'index'])->name('index'); // list orders
        Route::get('/{id}', [AdminOrderController::class, 'show'])->name('show'); // show specific order
        Route::post('/{id}/status', [AdminOrderController::class, 'updateStatus'])->name('updateStatus'); // update order status
        Route::delete('/{id}', [AdminOrderController::class, 'destroy'])->name('destroy'); // delete order
        Route::post('/{id}/ready', [AdminOrderController::class, 'markReady'])->name('markReady'); // mark as ready
        Route::get('/{id}/print', [AdminOrderController::class, 'printOrder'])->name('print'); // print order
        Route::get('/api/statistics', [AdminOrderController::class, 'getStatistics'])->name('statistics'); // get statistics
        Route::post('/bulk-update', [AdminOrderController::class, 'bulkUpdateStatus'])->name('bulkUpdate'); // bulk update
    });

    // Test route to create sample orders for testing
    Route::get('/test/create-sample-orders', function () {
        $menuItems = \App\Models\MenuItem::take(3)->get();

        if ($menuItems->isEmpty()) {
            return response()->json(['error' => 'No menu items found. Please create some menu items first.']);
        }

        // Create a sample order
        $order = \App\Models\Order::create([
            'customer_name' => 'Test Customer',
            'customer_phone' => '+1234567890',
            'table_number' => '5',
            'total' => 45.50,
            'status' => 'pending'
        ]);

        // Add some order items
        foreach ($menuItems as $menuItem) {
            \App\Models\OrderItem::create([
                'order_id' => $order->id,
                'menu_item_id' => $menuItem->id,
                'quantity' => rand(1, 3),
                'price' => $menuItem->price
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Sample order created successfully!',
            'order_id' => $order->id
        ]);
    })->name('test.orders');

    // Test route to check database connection
    Route::get('/test/database', function () {
        try {
            $menuItemsCount = \App\Models\MenuItem::count();
            $ordersCount = \App\Models\Order::count();

            return response()->json([
                'success' => true,
                'message' => 'Database connection successful!',
                'data' => [
                    'menu_items' => $menuItemsCount,
                    'orders' => $ordersCount,
                    'database' => config('database.default'),
                    'timestamp' => now()
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Database connection failed: ' . $e->getMessage(),
                'error' => $e->getTraceAsString()
            ], 500);
        }
    })->name('test.database');
});
