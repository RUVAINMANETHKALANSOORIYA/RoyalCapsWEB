<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Product;


class ProductController extends Controller
{
    /**
     * Display a listing of the products.
     */
    public function index()
    {
        $products = Product::all();
        return response()->json($products);
    }

    public function view()
    {
        $menProducts = Product::where('category', 'Men')->get();
        $womenProducts = Product::where('category', 'Women')->get();

        return view('pages.products', compact('menProducts', 'womenProducts'));
    }


    /**
     * Store a newly created product in the database.
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
    
        $imageNames = [];
    if ($request->hasFile('product_images')) {
        foreach ($request->file('product_images') as $image) {
            $imageName = time() . '-' . $image->getClientOriginalName();
            $image->move(public_path('images/products'), $imageName);
            $imageNames[] = $imageName;
        }
    }
    
        // Debug: Confirm Product Creation
        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'category' => $request->category,
            'color' => $request->color,
            'product_images' => json_encode($imageNames), // Store as JSON
            'user_id' => Auth::id(),
        ]);
    
        \Log::info('Product Created:', $product->toArray());
    
        return redirect()->back()->with('success', 'Product added successfully!');
    }
    

    /**
     * Display the specified product.
     */
    public function show($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        return response()->json($product);
    }

    /**
     * Update the specified product in the database.
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $request->validate([
            'name' => 'string|max:255',
            'description' => 'nullable|string',
            'price' => 'numeric|min:0',
            'stock' => 'integer|min:0',
            'category' => 'in:Men,Women',
            'user_id' => 'exists:users,id', // Ensures user exists
        ]);

        $product->update($request->all());

        return response()->json([
            'message' => 'Product updated successfully!',
            'product' => $product,
        ]);
    }

    /**
     * Remove the specified product from the database.
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $product->delete();

        return response()->json(['message' => 'Product deleted successfully']);
    }
}
