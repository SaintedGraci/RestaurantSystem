<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\MenuItem;
use Illuminate\Support\Facades\DB;

class DemoOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if we have menu items to work with
        $menuItems = MenuItem::all();

        if ($menuItems->isEmpty()) {
            $this->command->error('No menu items found. Please seed menu items first.');
            return;
        }

        // Create demo orders with different statuses
        $demoOrders = [
            [
                'customer_name' => 'John Doe',
                'customer_phone' => '+1 (555) 123-4567',
                'table_number' => '5',
                'status' => 'pending',
                'items' => [
                    ['menu_item_id' => $menuItems->random()->id, 'quantity' => 2],
                    ['menu_item_id' => $menuItems->random()->id, 'quantity' => 1],
                ]
            ],
            [
                'customer_name' => 'Jane Smith',
                'customer_phone' => '+1 (555) 987-6543',
                'table_number' => '3',
                'status' => 'preparing',
                'items' => [
                    ['menu_item_id' => $menuItems->random()->id, 'quantity' => 1],
                    ['menu_item_id' => $menuItems->random()->id, 'quantity' => 3],
                    ['menu_item_id' => $menuItems->random()->id, 'quantity' => 1],
                ]
            ],
            [
                'customer_name' => 'Bob Wilson',
                'customer_phone' => null,
                'table_number' => '7',
                'status' => 'completed',
                'items' => [
                    ['menu_item_id' => $menuItems->random()->id, 'quantity' => 1],
                    ['menu_item_id' => $menuItems->random()->id, 'quantity' => 2],
                ]
            ],
            [
                'customer_name' => 'Alice Johnson',
                'customer_phone' => '+1 (555) 456-7890',
                'table_number' => null,
                'status' => 'pending',
                'items' => [
                    ['menu_item_id' => $menuItems->random()->id, 'quantity' => 4],
                ]
            ],
            [
                'customer_name' => 'Mike Brown',
                'customer_phone' => '+1 (555) 321-0987',
                'table_number' => '12',
                'status' => 'preparing',
                'items' => [
                    ['menu_item_id' => $menuItems->random()->id, 'quantity' => 2],
                    ['menu_item_id' => $menuItems->random()->id, 'quantity' => 1],
                    ['menu_item_id' => $menuItems->random()->id, 'quantity' => 2],
                ]
            ],
            [
                'customer_name' => 'Sarah Davis',
                'customer_phone' => '+1 (555) 654-3210',
                'table_number' => '2',
                'status' => 'cancelled',
                'items' => [
                    ['menu_item_id' => $menuItems->random()->id, 'quantity' => 1],
                ]
            ],
        ];

        DB::beginTransaction();
        try {
            foreach ($demoOrders as $orderData) {
                // Calculate total
                $total = 0;
                foreach ($orderData['items'] as $item) {
                    $menuItem = MenuItem::find($item['menu_item_id']);
                    $total += $menuItem->price * $item['quantity'];
                }

                // Create the order
                $order = Order::create([
                    'customer_name' => $orderData['customer_name'],
                    'customer_phone' => $orderData['customer_phone'],
                    'table_number' => $orderData['table_number'],
                    'total' => $total,
                    'status' => $orderData['status'],
                    'created_at' => now()->subMinutes(rand(1, 120)), // Random times within last 2 hours
                    'updated_at' => now()->subMinutes(rand(1, 60)),  // Random update times
                ]);

                // Create order items
                foreach ($orderData['items'] as $itemData) {
                    $menuItem = MenuItem::find($itemData['menu_item_id']);
                    OrderItem::create([
                        'order_id' => $order->id,
                        'menu_item_id' => $itemData['menu_item_id'],
                        'quantity' => $itemData['quantity'],
                        'price' => $menuItem->price,
                    ]);
                }

                $this->command->info("Created order #{$order->id} for {$order->customer_name} - Status: {$order->status}");
            }

            DB::commit();
            $this->command->info('Demo orders created successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            $this->command->error('Failed to create demo orders: ' . $e->getMessage());
        }
    }
}
