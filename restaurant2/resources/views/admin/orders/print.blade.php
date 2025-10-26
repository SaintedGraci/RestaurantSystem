<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order #{{ $order->id }} - Kitchen Receipt</title>
    <style>
        body {
            font-family: 'Courier New', monospace;
            font-size: 12px;
            line-height: 1.4;
            margin: 0;
            padding: 20px;
            background: white;
        }

        .receipt {
            max-width: 300px;
            margin: 0 auto;
            border: 1px solid #000;
            padding: 10px;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #000;
            margin-bottom: 10px;
            padding-bottom: 10px;
        }

        .restaurant-name {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .order-info {
            margin-bottom: 15px;
        }

        .order-number {
            font-size: 18px;
            font-weight: bold;
            text-align: center;
            background: #000;
            color: white;
            padding: 5px;
            margin-bottom: 10px;
        }

        .customer-info {
            border-bottom: 1px dashed #000;
            padding-bottom: 10px;
            margin-bottom: 10px;
        }

        .items-section {
            margin-bottom: 15px;
        }

        .item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
            border-bottom: 1px dotted #ccc;
            padding-bottom: 3px;
        }

        .item-name {
            flex: 1;
            font-weight: bold;
        }

        .item-qty {
            width: 30px;
            text-align: center;
        }

        .item-price {
            width: 60px;
            text-align: right;
        }

        .total-section {
            border-top: 2px solid #000;
            padding-top: 10px;
            margin-top: 15px;
        }

        .total-line {
            display: flex;
            justify-content: space-between;
            font-size: 14px;
            font-weight: bold;
        }

        .status-badge {
            text-align: center;
            padding: 8px;
            margin: 10px 0;
            font-weight: bold;
            text-transform: uppercase;
        }

        .status-pending { background: #fef3c7; color: #92400e; }
        .status-preparing { background: #dbeafe; color: #1e40af; }
        .status-completed { background: #d1fae5; color: #065f46; }
        .status-cancelled { background: #fecaca; color: #991b1b; }

        .footer {
            text-align: center;
            margin-top: 20px;
            padding-top: 10px;
            border-top: 1px dashed #000;
            font-size: 10px;
        }

        .timestamp {
            text-align: center;
            font-size: 10px;
            margin-top: 10px;
            color: #666;
        }

        @media print {
            body {
                margin: 0;
                padding: 10px;
            }
            .receipt {
                border: none;
                max-width: none;
            }
            .no-print {
                display: none;
            }
        }

        .print-button {
            position: fixed;
            top: 20px;
            right: 20px;
            background: #3b82f6;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }

        .print-button:hover {
            background: #2563eb;
        }
    </style>
</head>
<body>
    <button class="print-button no-print" onclick="window.print()">Print Receipt</button>

    <div class="receipt">
        <!-- Header -->
        <div class="header">
            <div class="restaurant-name">RESTAURANT SYSTEM</div>
            <div>Kitchen Order</div>
        </div>

        <!-- Order Number -->
        <div class="order-number">
            ORDER #{{ $order->id }}
        </div>

        <!-- Order Status -->
        <div class="status-badge status-{{ $order->status }}">
            {{ strtoupper($order->status) }}
        </div>

        <!-- Order Info -->
        <div class="order-info">
            <div><strong>Date:</strong> {{ $order->created_at->format('M d, Y') }}</div>
            <div><strong>Time:</strong> {{ $order->created_at->format('g:i A') }}</div>
            <div><strong>Order Time:</strong> {{ $order->created_at->diffForHumans() }}</div>
        </div>

        <!-- Customer Info -->
        <div class="customer-info">
            <div><strong>Customer:</strong> {{ $order->customer_name }}</div>
            @if($order->customer_phone)
                <div><strong>Phone:</strong> {{ $order->customer_phone }}</div>
            @endif
            @if($order->table_number)
                <div><strong>Table:</strong> {{ $order->table_number }}</div>
            @endif
        </div>

        <!-- Items -->
        <div class="items-section">
            <div style="font-weight: bold; margin-bottom: 8px; text-align: center;">ORDER ITEMS</div>

            @foreach($order->items as $item)
                <div class="item">
                    <div class="item-name">{{ $item->menuItem->name }}</div>
                    <div class="item-qty">x{{ $item->quantity }}</div>
                    <div class="item-price">${{ number_format($item->price, 2) }}</div>
                </div>
                @if($item->menuItem->description)
                    <div style="font-size: 10px; color: #666; margin-left: 10px; margin-bottom: 5px;">
                        {{ $item->menuItem->description }}
                    </div>
                @endif
            @endforeach
        </div>

        <!-- Total -->
        <div class="total-section">
            <div class="total-line">
                <span>TOTAL:</span>
                <span>${{ number_format($order->total, 2) }}</span>
            </div>
        </div>

        <!-- Special Instructions -->
        @if($order->notes ?? false)
            <div style="border-top: 1px dashed #000; padding-top: 10px; margin-top: 10px;">
                <div style="font-weight: bold; margin-bottom: 5px;">SPECIAL INSTRUCTIONS:</div>
                <div style="font-style: italic;">{{ $order->notes }}</div>
            </div>
        @endif

        <!-- Footer -->
        <div class="footer">
            <div>Thank you!</div>
            <div class="timestamp">
                Printed: {{ now()->format('M d, Y g:i A') }}
            </div>
        </div>
    </div>

    <script>
        // Auto-print when page loads (optional)
        // window.onload = function() { window.print(); }

        // Close window after printing
        window.onafterprint = function() {
            // window.close(); // Uncomment to auto-close after printing
        }
    </script>
</body>
</html>
