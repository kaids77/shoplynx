<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())->with('items.product')->latest()->get();
        return view('orders.index', compact('orders'));
    }

    public function cancel($id)
    {
        $order = Order::findOrFail($id);

        // Check if user owns this order
        if ($order->user_id !== Auth::id()) {
            return redirect()->route('orders.index')->with('error', 'Unauthorized action');
        }

        // Check if order can be cancelled
        if (!$order->canBeCancelled()) {
            return redirect()->route('orders.index')->with('error', 'Only pending orders can be cancelled');
        }

        // Restore stock for cancelled items
        foreach ($order->items as $item) {
            $item->product->increment('stock_quantity', $item->quantity);
        }

        $order->status = 'cancelled';
        $order->save();

        // Update transaction description
        $transaction = $order->transactions()->where('transaction_type', 'payment')->first();
        if ($transaction) {
            $transaction->update([
                'description' => 'Payment for Order #' . $order->id . ' - Cancelled'
            ]);
        }

        return redirect()->route('orders.index')->with('success', 'Order cancelled successfully. Stock has been restored.');
    }
}
