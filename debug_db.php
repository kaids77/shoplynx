<?php

use App\Models\User;
use App\Models\Order;

echo "Users:\n";
foreach (User::all() as $user) {
    echo "ID: {$user->id}, Name: {$user->name}, Email: {$user->email}\n";
}

echo "\nOrders:\n";
foreach (Order::all() as $order) {
    echo "ID: {$order->id}, User ID: {$order->user_id}, Customer: {$order->customer_name}, Total: {$order->total_price}\n";
}
