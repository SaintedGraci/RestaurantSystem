<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\MenuItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class OrderController extends Controller
{
    /**
     * Store a new order from checkout.
     */
    public function store(Request $request)
    {
        try {
            // Log the incoming request for debugging
            Log::info('Order submission attempt', [
                'data' => $request->all(),
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent()
            ]);

            $validated = $request->validate([
                'customer_name'   => 'required|string|max:255',
                'customer_phone'  => 'nullable|string|max:30',
                'table_number'    => 'nullable|string|max:20',
                'total'           => 'required|numeric|min:0',
                'cart'            => 'required|array|min:1',
            ]);

            // Validate cart items exist and calculate total
            $calculatedTotal = 0;
            foreach ($validated['cart'] as $itemId => $item) {
                // Validate item structure
                if (!isset($item['quantity']) || !isset($item['price'])) {
                    throw ValidationException::withMessages([
                        'cart' => 'Invalid cart item structure.'
                    ]);
                }

                // Verify menu item exists
                $menuItem = MenuItem::find($itemId);
                if (!$menuItem) {
                    throw ValidationException::withMessages([
                        'cart' => "Menu item with ID {$itemId} not found."
                    ]);
                }

                $calculatedTotal += floatval($item['price']) * intval($item['quantity']);
            }

            // Verify total matches calculated total (allow small floating point differences)
            if (abs($calculatedTotal - floatval($validated['total'])) > 0.01) {
                Log::warning('Order total mismatch', [
                    'submitted_total' => $validated['total'],
                    'calculated_total' => $calculatedTotal
                ]);
            }

            DB::beginTransaction();

            // 🧾 Create the order
            $order = Order::create([
                'customer_name'  => $validated['customer_name'],
                'customer_phone' => $validated['customer_phone'] ?? null,
                'table_number'   => $validated['table_number'] ?? null,
                'total'          => $calculatedTotal, // Use calculated total for accuracy
                'status'         => 'pending',
            ]);

            // 🛒 Save each cart item
            foreach ($validated['cart'] as $itemId => $item) {
                OrderItem::create([
                    'order_id'     => $order->id,
                    'menu_item_id' => intval($itemId),
                    'quantity'     => intval($item['quantity']),
                    'price'        => floatval($item['price']),
                ]);
            }

            DB::commit();

            Log::info('Order created successfully', [
                'order_id' => $order->id,
                'customer' => $order->customer_name,
                'total' => $order->total
            ]);

            return response()->json([
                'success'  => true,
                'message'  => 'Order placed successfully!',
                'order_id' => $order->id,
            ], 201);

        } catch (ValidationException $e) {
            Log::warning('Order validation failed', [
                'errors' => $e->errors(),
                'data' => $request->all()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Validation failed: ' . collect($e->errors())->flatten()->first(),
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Order creation failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'data' => $request->all()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to place order. Please try again.',
                'debug' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }

    /**
     * List orders for admin dashboard with optional status filtering.
     */
    public function index(Request $request)
    {
        $query = Order::with('items.menuItem');

        // Filter by status if provided
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        } else {
            // Default to showing pending orders if no filter is applied
            $query->where('status', 'pending');
        }

        $orders = $query->orderByDesc('created_at')->get();

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Update order status (mark as preparing/completed).
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate(['status' => 'required|in:pending,preparing,completed,cancelled']);

        $order = Order::findOrFail($id);
        $order->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Order status updated!');
    }
}
