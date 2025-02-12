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
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category' => 'required|in:Men,Women',
            'color' => 'required|string|max:50', 
            'product_image.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate multiple images
        ]);

        // Handle Multiple Image Uploads
        // $imageNames = [];
        // if ($request->hasFile('product_image')) {
        //     foreach ($request->file('product_image') as $image) {
        //         $imageName = time() . '-' . $image->getClientOriginalName();
        //         $image->move(public_path('uploads'), $imageName);
        //         $imageNames[] = $imageName;
        //     }
        // }

        if ($request->hasFile('product_image')) {
            $imageNames = [];
            foreach ($request->file('product_image') as $image) {
                $imageName = time() . '-' . $image->getClientOriginalName();
                $image->move(public_path('uploads'), $imageName);
                $imageNames[] = $imageName;
            }
            $validatedData['product_image'] = json_encode($imageNames);
        }


        // Create the Product
        // $product = Product::create([
        //     'name' => $request->name,
        //     'description' => $request->description,
        //     'price' => $request->price,
        //     'stock' => $request->stock,
        //     'category' => $request->category,
        //     'color' => $request->color,
        //     'product_image' => json_encode($imageNames), // Store images as JSON
        //     'user_id' => Auth::id(),
        // ]);

        $product = Product::create(array_merge($validatedData, ['user_id' => Auth::id()]));

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
        $request->validate([
            'name' => 'string|max:255',
            'price' => 'numeric|min:0',
            'stock' => 'integer|min:0',
            'category' => 'string|in:Men,Women', // Ensure only allowed categories

        ]);

        $product = Product::findOrFail($id);
        $product->update($request->only(['name', 'price', 'stock', 'category']));

        return redirect()->route('admin.dashboard')->with('success', 'Product updated successfully!');
    }

    /**
     * Remove a product from the database.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Product deleted successfully.');
    }
}

