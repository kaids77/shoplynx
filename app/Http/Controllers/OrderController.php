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

        // Check if order is still pending
        if ($order->status !== 'pending') {
            return redirect()->route('orders.index')->with('error', 'Only pending orders can be cancelled');
        }

        $order->status = 'cancelled';
        $order->save();

        return redirect()->route('orders.index')->with('success', 'Order cancelled successfully');
    }
}
