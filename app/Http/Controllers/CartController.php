<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Auth::user()->cartItems()->with('product')->get();
        return view('cart.index', compact('cartItems'));
    }

    public function add($id)
    {
        $product = Product::findOrFail($id);

        $cartItem = CartItem::where('user_id', Auth::id())
            ->where('product_id', $id)
            ->first();

        if ($cartItem) {
            $cartItem->quantity++;
            $cartItem->save();
        } else {
            CartItem::create([
                'user_id' => Auth::id(),
                'product_id' => $id,
                'quantity' => 1,
            ]);
        }

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function update(Request $request)
    {
        if ($request->id && $request->quantity) {
            $cartItem = CartItem::where('user_id', Auth::id())
                ->where('product_id', $request->id)
                ->first();

            if ($cartItem) {
                $cartItem->quantity = $request->quantity;
                $cartItem->save();

                // Return JSON for AJAX requests
                if ($request->expectsJson()) {
                    return response()->json(['success' => true, 'message' => 'Cart updated successfully']);
                }

                session()->flash('success', 'Cart updated successfully');
                return response()->json(['success' => true]);
            }
        }

        return response()->json(['success' => false, 'message' => 'Invalid request']);
    }

    public function remove(Request $request)
    {
        $id = $request->input('id');

        if ($id) {
            CartItem::where('user_id', Auth::id())
                ->where('product_id', $id)
                ->delete();
        }

        return redirect()->route('cart.index')->with('success', 'Product removed from cart successfully!');
    }

    public function checkout()
    {
        $cartItems = Auth::user()->cartItems()->with('product')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('products.index')->with('error', 'Your cart is empty.');
        }

        return view('checkout', compact('cartItems'));
    }

    public function processCheckout(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string',
            'customer_email' => 'required|email',
            'customer_phone' => 'required|string|size:11',
            'shipping_address' => 'required|string',
            'payment_method' => 'required|string',
        ]);

        $cartItems = Auth::user()->cartItems()->with('product')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('products.index')->with('error', 'Your cart is empty.');
        }

        $total = 0;
        foreach ($cartItems as $item) {
            $total += $item->product->price * $item->quantity;
        }

        DB::transaction(function () use ($request, $total, $cartItems) {
            $order = Order::create([
                'user_id' => Auth::id(),
                'customer_name' => $request->customer_name,
                'customer_email' => $request->customer_email,
                'customer_phone' => $request->customer_phone,
                'status' => 'pending',
                'payment_method' => $request->payment_method,
                'total_price' => $total,
                'shipping_address' => $request->shipping_address,
            ]);

            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                ]);
            }

            // Create transaction record
            Transaction::create([
                'user_id' => Auth::id(),
                'order_id' => $order->id,
                'transaction_type' => 'payment',
                'amount' => $total,
                'payment_method' => $request->payment_method,
                'status' => 'completed',
                'reference_number' => 'TXN-' . strtoupper(uniqid()),
                'description' => 'Payment for Order #' . $order->id,
            ]);

            // Clear cart after order is placed
            Auth::user()->cartItems()->delete();
        });

        return redirect()->route('home')->with('success', 'Order placed successfully!');
    }
}
