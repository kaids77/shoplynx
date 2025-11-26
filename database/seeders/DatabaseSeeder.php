<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin User
        User::firstOrCreate(
            ['email' => 'admin@shoplynx.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        // Create Test Customer
        User::firstOrCreate(
            ['email' => 'customer@shoplynx.com'],
            [
                'name' => 'Test Customer',
                'password' => Hash::make('password'),
                'role' => 'customer',
            ]
        );

        // Create Sample Products
        Product::create([
            'name' => 'Premium Wireless Headphones',
            'description' => 'High-quality wireless headphones with noise cancellation.',
            'price' => 2999.00,
            'image_path' => null, // You can add a sample image if you have one
        ]);

        Product::create([
            'name' => 'Smart Watch Series 5',
            'description' => 'Track your fitness and stay connected.',
            'price' => 4500.00,
            'image_path' => null,
        ]);

        Product::create([
            'name' => 'Ergonomic Office Chair',
            'description' => 'Comfortable chair for long working hours.',
            'price' => 3500.00,
            'image_path' => null,
        ]);

        Product::create([
            'name' => 'Mechanical Keyboard',
            'description' => 'Tactile feedback for the best typing experience.',
            'price' => 1800.00,
            'image_path' => null,
        ]);
    }
}
