<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['user', 'items.product'])->latest()->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,shipped,completed,cancelled',
        ]);

        $oldStatus = $order->status;
        $newStatus = $request->status;

        $order->update(['status' => $newStatus]);

        // Update transaction description based on new status
        $transaction = $order->transactions()->where('transaction_type', 'payment')->first();

        if ($transaction) {
            $description = $transaction->description;

            if ($newStatus === 'shipped') {
                $description = 'Payment for Order #' . $order->id . ' - Shipped';
            } elseif ($newStatus === 'completed') {
                $description = 'Payment for Order #' . $order->id . ' - Completed';
            } elseif ($newStatus === 'cancelled') {
                $description = 'Payment for Order #' . $order->id . ' - Cancelled';
            } elseif ($newStatus === 'pending') {
                $description = 'Payment for Order #' . $order->id;
            }

            $transaction->update(['description' => $description]);
        }

        // If cancelled, restore stock (if not already cancelled)
        if ($newStatus === 'cancelled' && $oldStatus !== 'cancelled') {
            foreach ($order->items as $item) {
                $item->product->increment('stock_quantity', $item->quantity);
            }
        }

        return redirect()->back()->with('success', 'Order status updated successfully.');
    }
}
