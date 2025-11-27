<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        // Check if there's a search term
        if ($request->has('search') && $request->search != '') {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('description', 'LIKE', "%{$searchTerm}%");
            });
        }

        $products = $query->get();
        $searchTerm = $request->search ?? '';

        return view('products.index', compact('products', 'searchTerm'));
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }
}
