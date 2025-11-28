<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\Order;
use App\Models\Transaction;

return new class extends Migration {
    public function up(): void
    {
        // Get the first user
        $user = User::first();

        if ($user) {
            // Create a test order
            $order = Order::create([
                'user_id' => $user->id,
                'customer_name' => $user->name,
                'customer_email' => $user->email,
                'customer_phone' => '09123456789',
                'status' => 'completed',
                'payment_method' => 'cash_on_delivery',
                'total_price' => 1500.00,
                'shipping_address' => '123 Test Street, Test City',
            ]);

            // Create a test transaction
            Transaction::create([
                'user_id' => $user->id,
                'order_id' => $order->id,
                'transaction_type' => 'payment',
                'amount' => 1500.00,
                'payment_method' => 'cash_on_delivery',
                'status' => 'completed',
                'reference_number' => 'TXN-' . strtoupper(uniqid()),
                'description' => 'Payment for Order #' . $order->id,
            ]);
        }
    }

    public function down(): void
    {
        // Optional: Clean up test data
    }
};
