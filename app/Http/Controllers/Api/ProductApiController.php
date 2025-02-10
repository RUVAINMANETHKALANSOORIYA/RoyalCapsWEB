<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductApiController extends Controller
{
    /**
     * Get all products categorized under 'Men' and 'Women'.
     */
    public function index()
    {
        $products = Product::all();

        return response()->json([
            'status' => true,
            'message' => 'All products retrieved successfully',
            'products' => $products
        ], 200);
    }

    /**
     * Get products filtered by category (Men or Women).
     */
    public function getByCategory($category)
    {
        $products = Product::where('category', ucfirst($category))->get();

        if ($products->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => 'No products found in this category',
                'products' => []
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => ucfirst($category) . ' products retrieved successfully',
            'products' => $products
        ], 200);
    }

    /**
     * Get a single product by ID.
     */
    public function show($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'status' => false,
                'message' => 'Product not found'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Product retrieved successfully',
            'product' => $product
        ], 200);
    }
}
