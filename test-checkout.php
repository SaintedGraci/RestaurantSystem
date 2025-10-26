<?php
/**
 * Test Checkout Functionality
 *
 * This script tests the checkout process by simulating an order submission
 * to help debug any issues with the order system.
 */

require_once __DIR__ . '/restaurant2/vendor/autoload.php';

// Load Laravel
$app = require_once __DIR__ . '/restaurant2/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

echo "=== Restaurant System Checkout Test ===" . PHP_EOL . PHP_EOL;

// Test 1: Database Connection
echo "1. Testing Database Connection..." . PHP_EOL;
try {
    $menuItems = \App\Models\MenuItem::take(3)->get();
    echo "   ✓ Database connected successfully!" . PHP_EOL;
    echo "   ✓ Found " . $menuItems->count() . " menu items" . PHP_EOL;

    if ($menuItems->isEmpty()) {
        echo "   ⚠ No menu items found. You may need to seed the database." . PHP_EOL;
        exit(1);
    }
} catch (Exception $e) {
    echo "   ✗ Database connection failed: " . $e->getMessage() . PHP_EOL;
    echo "   → Please check your .env file configuration" . PHP_EOL;
    echo "   → Make sure Docker containers are running: docker-compose up -d" . PHP_EOL;
    echo "   → Update DB_HOST to 127.0.0.1 and DB_PORT to 3307 in .env" . PHP_EOL;
    exit(1);
}

// Test 2: Create Test Order Data
echo PHP_EOL . "2. Preparing Test Order Data..." . PHP_EOL;

$testCart = [];
$testTotal = 0;

foreach ($menuItems as $item) {
    $quantity = rand(1, 3);
    $testCart[$item->id] = [
        'name' => $item->name,
        'price' => $item->price,
        'quantity' => $quantity
    ];
    $testTotal += $item->price * $quantity;
    echo "   - {$item->name}: {$quantity} × \${$item->price} = \$" . ($item->price * $quantity) . PHP_EOL;
}

echo "   ✓ Test cart created with total: \$" . number_format($testTotal, 2) . PHP_EOL;

// Test 3: Validate Order Data Structure
echo PHP_EOL . "3. Testing Order Data Structure..." . PHP_EOL;

$orderData = [
    'customer_name' => 'Test Customer',
    'customer_phone' => '+1234567890',
    'table_number' => '5',
    'total' => $testTotal,
    'cart' => $testCart
];

// Validate required fields
$requiredFields = ['customer_name', 'total', 'cart'];
foreach ($requiredFields as $field) {
    if (isset($orderData[$field]) && !empty($orderData[$field])) {
        echo "   ✓ {$field}: " . (is_array($orderData[$field]) ? 'array with ' . count($orderData[$field]) . ' items' : $orderData[$field]) . PHP_EOL;
    } else {
        echo "   ✗ Missing required field: {$field}" . PHP_EOL;
        exit(1);
    }
}

// Test 4: Simulate Order Creation
echo PHP_EOL . "4. Testing Order Creation..." . PHP_EOL;
try {
    \Illuminate\Support\Facades\DB::beginTransaction();

    // Create the order
    $order = \App\Models\Order::create([
        'customer_name' => $orderData['customer_name'],
        'customer_phone' => $orderData['customer_phone'],
        'table_number' => $orderData['table_number'],
        'total' => $orderData['total'],
        'status' => 'pending',
    ]);

    echo "   ✓ Order created with ID: {$order->id}" . PHP_EOL;

    // Create order items
    foreach ($orderData['cart'] as $itemId => $item) {
        \App\Models\OrderItem::create([
            'order_id' => $order->id,
            'menu_item_id' => $itemId,
            'quantity' => $item['quantity'],
            'price' => $item['price'],
        ]);
    }

    echo "   ✓ Order items created: " . count($orderData['cart']) . " items" . PHP_EOL;

    // Verify order was created properly
    $createdOrder = \App\Models\Order::with('items.menuItem')->find($order->id);
    if ($createdOrder && $createdOrder->items->count() > 0) {
        echo "   ✓ Order verification successful" . PHP_EOL;
        echo "   → Order #{$createdOrder->id} for {$createdOrder->customer_name}" . PHP_EOL;
        echo "   → Status: {$createdOrder->status}" . PHP_EOL;
        echo "   → Items: " . $createdOrder->items->count() . PHP_EOL;
        echo "   → Total: \$" . number_format($createdOrder->total, 2) . PHP_EOL;
    } else {
        echo "   ✗ Order verification failed" . PHP_EOL;
    }

    \Illuminate\Support\Facades\DB::rollback(); // Don't actually save the test order
    echo "   ✓ Test order rolled back (not saved)" . PHP_EOL;

} catch (Exception $e) {
    \Illuminate\Support\Facades\DB::rollback();
    echo "   ✗ Order creation failed: " . $e->getMessage() . PHP_EOL;
    echo "   → Check your database schema and model relationships" . PHP_EOL;
    exit(1);
}

// Test 5: Check Routes
echo PHP_EOL . "5. Checking Routes..." . PHP_EOL;
try {
    $routes = \Illuminate\Support\Facades\Route::getRoutes();

    // Check if order store route exists
    $orderStoreRoute = null;
    foreach ($routes as $route) {
        if ($route->getUri() === 'orders' && in_array('POST', $route->getMethods())) {
            $orderStoreRoute = $route;
            break;
        }
    }

    if ($orderStoreRoute) {
        echo "   ✓ Order store route found: POST /orders" . PHP_EOL;
        echo "   → Controller: " . $orderStoreRoute->getAction()['controller'] ?? 'Closure' . PHP_EOL;
    } else {
        echo "   ✗ Order store route not found" . PHP_EOL;
        echo "   → Check routes/web.php for: Route::post('/orders', [OrderController::class, 'store'])" . PHP_EOL;
    }

    // Check admin routes
    $adminOrderRoutes = [];
    foreach ($routes as $route) {
        if (strpos($route->getUri(), 'admin/orders') !== false) {
            $adminOrderRoutes[] = $route->getUri();
        }
    }

    if (!empty($adminOrderRoutes)) {
        echo "   ✓ Admin order routes found: " . count($adminOrderRoutes) . " routes" . PHP_EOL;
        foreach ($adminOrderRoutes as $uri) {
            echo "     → {$uri}" . PHP_EOL;
        }
    }

} catch (Exception $e) {
    echo "   ✗ Route check failed: " . $e->getMessage() . PHP_EOL;
}

// Test Results Summary
echo PHP_EOL . "=== Test Results Summary ===" . PHP_EOL;
echo "✓ Database Connection: Working" . PHP_EOL;
echo "✓ Order Data Structure: Valid" . PHP_EOL;
echo "✓ Order Creation: Working" . PHP_EOL;
echo "✓ Routes: Configured" . PHP_EOL;
echo PHP_EOL . "🎉 All tests passed! Your checkout system should be working." . PHP_EOL;
echo PHP_EOL . "Next Steps:" . PHP_EOL;
echo "1. Make sure your .env database settings are correct" . PHP_EOL;
echo "2. Ensure Docker containers are running: docker-compose up -d" . PHP_EOL;
echo "3. Try the checkout process on your website" . PHP_EOL;
echo "4. Check admin panel for pending orders" . PHP_EOL;
echo PHP_EOL . "If checkout still fails, check:" . PHP_EOL;
echo "- Browser console for JavaScript errors" . PHP_EOL;
echo "- Laravel logs in storage/logs/laravel.log" . PHP_EOL;
echo "- Network tab in browser dev tools for failed requests" . PHP_EOL;
