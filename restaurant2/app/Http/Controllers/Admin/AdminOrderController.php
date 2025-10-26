<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminOrderController extends Controller
{
    /**
     * Display a listing of orders with optional status filtering.
     */
    public function index(Request $request)
    {
        $query = Order::with(['items.menuItem']);

        // Filter by status if provided
        if ($request->has('status') && !empty($request->status)) {
            $query->where('status', $request->status);
        }

        $orders = $query->orderByDesc('created_at')->get();

        // Get statistics for the dashboard
        $statistics = [
            'pending' => Order::where('status', 'pending')->count(),
            'preparing' => Order::where('status', 'preparing')->count(),
            'completed' => Order::where('status', 'completed')->count(),
            'cancelled' => Order::where('status', 'cancelled')->count(),
            'total_orders' => Order::count(),
            'todays_revenue' => Order::where('status', 'completed')
                ->whereDate('created_at', today())
                ->sum('total'),
        ];

        return view('admin.orders.index', compact('orders', 'statistics'));
    }

    /**
     * Display the specified order.
     */
    public function show($id)
    {
        $order = Order::with(['items.menuItem'])
            ->findOrFail($id);

        return view('admin.orders.show', compact('order'));
    }

    /**
     * Update the order status.
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,preparing,completed,cancelled'
        ]);

        $order = Order::findOrFail($id);

        // Check if status change is valid
        $validTransitions = [
            'pending' => ['preparing', 'cancelled'],
            'preparing' => ['completed', 'cancelled'],
            'completed' => [], // Cannot change from completed
            'cancelled' => [], // Cannot change from cancelled
        ];

        if (!in_array($request->status, $validTransitions[$order->status])) {
            return redirect()->back()->with('error', 'Invalid status transition.');
        }

        $order->update([
            'status' => $request->status
        ]);

        $statusMessages = [
            'preparing' => 'Order has been marked as preparing.',
            'completed' => 'Order has been completed successfully.',
            'cancelled' => 'Order has been cancelled.'
        ];

        return redirect()->back()->with('success', $statusMessages[$request->status]);
    }

    /**
     * Get orders by status for AJAX requests.
     */
    public function getOrdersByStatus(Request $request)
    {
        $status = $request->get('status', 'pending');

        $orders = Order::where('status', $status)
            ->with(['items.menuItem'])
            ->orderByDesc('created_at')
            ->get();

        return response()->json([
            'success' => true,
            'orders' => $orders,
            'count' => $orders->count()
        ]);
    }

    /**
     * Get order statistics for dashboard.
     */
    public function getStatistics()
    {
        $statistics = [
            'pending' => Order::where('status', 'pending')->count(),
            'preparing' => Order::where('status', 'preparing')->count(),
            'completed' => Order::where('status', 'completed')->count(),
            'cancelled' => Order::where('status', 'cancelled')->count(),
            'total_orders' => Order::count(),
            'todays_revenue' => Order::where('status', 'completed')
                ->whereDate('created_at', today())
                ->sum('total'),
            'todays_orders' => Order::whereDate('created_at', today())->count(),
            'pending_revenue' => Order::where('status', 'pending')->sum('total'),
        ];

        return response()->json($statistics);
    }

    /**
     * Bulk update order statuses.
     */
    public function bulkUpdateStatus(Request $request)
    {
        $request->validate([
            'order_ids' => 'required|array',
            'order_ids.*' => 'exists:orders,id',
            'status' => 'required|in:pending,preparing,completed,cancelled'
        ]);

        DB::beginTransaction();
        try {
            $updated = Order::whereIn('id', $request->order_ids)
                ->update(['status' => $request->status]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => "Successfully updated {$updated} orders to {$request->status} status.",
                'updated_count' => $updated
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to update orders: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete an order (only if it's cancelled).
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);

        if ($order->status !== 'cancelled') {
            return redirect()->back()->with('error', 'Only cancelled orders can be deleted.');
        }

        $order->delete();

        return redirect()->back()->with('success', 'Order deleted successfully.');
    }

    /**
     * Mark order as ready for pickup/delivery.
     */
    public function markReady($id)
    {
        $order = Order::findOrFail($id);

        if ($order->status !== 'preparing') {
            return redirect()->back()->with('error', 'Only preparing orders can be marked as ready.');
        }

        $order->update(['status' => 'completed']);

        return redirect()->back()->with('success', 'Order marked as ready!');
    }

    /**
     * Print order details (for kitchen receipt).
     */
    public function printOrder($id)
    {
        $order = Order::with(['items.menuItem'])
            ->findOrFail($id);

        return view('admin.orders.print', compact('order'));
    }
}
