<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display all products categorized under 'Men' and 'Women'.
     */
    public function view()
    {
        $menProducts = Product::where('category', 'Men')->get();
        $womenProducts = Product::where('category', 'Women')->get();

        return view('pages.products', compact('menProducts', 'womenProducts'));
    }

    /**
     * Store a newly created product in the database with multiple images.
     */
    public function store(Request $request)
    {
        // Debug: Log Request Data
        \Log::info('Product Store Request:', $request->all());

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category' => 'required|in:Men,Women',
            'color' => 'required|string|max:50', 
            'product_images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate multiple images
        ]);

        // Handle Multiple Image Uploads
        $imageNames = [];
        if ($request->hasFile('product_images')) {
            foreach ($request->file('product_images') as $image) {
                $imageName = time() . '-' . $image->getClientOriginalName();
                $image->move(public_path('images/products'), $imageName);
                $imageNames[] = $imageName;
            }
        }

        // Create the Product
        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'category' => $request->category,
            'color' => $request->color,
            'product_images' => json_encode($imageNames), // Store images as JSON
            'user_id' => Auth::id(),
        ]);

        \Log::info('Product Created:', $product->toArray());

        return redirect()->back()->with('success', 'Product added successfully!');
    }

    /**
     * Display a single product by ID.
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('pages.product-detail', compact('product'));
    }

    /**
     * Update an existing product in the database.
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'string|max:255',
            'description' => 'nullable|string',
            'price' => 'numeric|min:0',
            'stock' => 'integer|min:0',
            'category' => 'in:Men,Women',
            'user_id' => 'exists:users,id',
        ]);

        $product->update($request->all());

        return response()->json([
            'message' => 'Product updated successfully!',
            'product' => $product,
        ]);
    }

    /**
     * Remove a product from the database.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json(['message' => 'Product deleted successfully']);
    }
}
