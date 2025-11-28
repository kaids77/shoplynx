<?php

namespace App\Console\Commands;

use App\Models\Order;
use App\Models\Transaction;
use Illuminate\Console\Command;

class UpdateOrderStatuses extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'orders:update-statuses';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatically update order statuses based on time elapsed';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Checking orders for status updates...');

        // Update pending orders to shipped (after 7 minutes = 7 days)
        $ordersToShip = Order::where('status', 'pending')
            ->whereRaw('TIMESTAMPDIFF(MINUTE, created_at, NOW()) >= 7')
            ->get();

        foreach ($ordersToShip as $order) {
            $order->update(['status' => 'shipped']);

            // Update transaction status
            $transaction = $order->transactions()->where('transaction_type', 'payment')->first();
            if ($transaction) {
                $transaction->update([
                    'description' => 'Payment for Order #' . $order->id . ' - Shipped'
                ]);
            }

            $this->info("Order #{$order->id} marked as shipped");
        }

        // Update shipped orders to completed (after 12 minutes total = 14 days)
        $ordersToComplete = Order::where('status', 'shipped')
            ->whereRaw('TIMESTAMPDIFF(MINUTE, created_at, NOW()) >= 12')
            ->get();

        foreach ($ordersToComplete as $order) {
            $order->update(['status' => 'completed']);

            // Update transaction status
            $transaction = $order->transactions()->where('transaction_type', 'payment')->first();
            if ($transaction) {
                $transaction->update([
                    'description' => 'Payment for Order #' . $order->id . ' - Completed'
                ]);
            }

            $this->info("Order #{$order->id} marked as completed");
        }

        $this->info('Order status update completed!');
        $this->info("Shipped: {$ordersToShip->count()} orders");
        $this->info("Completed: {$ordersToComplete->count()} orders");

        return 0;
    }
}
