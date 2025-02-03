<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Product;

class CartController extends Controller
{
    /**
     * Display the cart page.
     */
    public function view()
    {
        $cart = Session::get('cart', []);

        return view('pages.cart', compact('cart')); // ✅ Ensure correct cart page path
    }

    /**
     * Add a product to the cart.
     */
    public function addToCart(Request $request, $id)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);

        if ($product->stock < $request->quantity) {
            return response()->json(['error' => 'Product is out of stock!'], 400);
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $request->quantity;
        } else {
            $cart[$product->id] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'color' => $product->color,
                'quantity' => $request->quantity,
                'stock' => $product->stock,
                'image' => json_decode($product->product_images, true)[0] ?? null,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->route('cart.view')->with('success', 'Product added to cart successfully!');
    }
    
    /**
     * Remove an item from the cart.
     */
    public function removeFromCart($id)
    {
        $cart = Session::get('cart', []);
        
        if (isset($cart[$id])) {
            unset($cart[$id]);
            Session::put('cart', $cart);
        }

        return redirect()->route('cart.view')->with('success', 'Product removed from cart.');
    }

    /**
     * Proceed to checkout.
     */
    public function checkout()
    {
        $cart = Session::get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.view')->with('error', 'Your cart is empty!');
        }

        return view('pages.checkout', compact('cart'));
    }

    /**
     * Update product quantity in cart.
     */
    public function update(Request $request, $id)
    {
        $cart = session('cart', []);

        if (!isset($cart[$id])) {
            return response()->json(['error' => 'Product not found in cart!'], 404);
        }

        $product = Product::findOrFail($id);

        if ($product->stock < $request->quantity) {
            return response()->json(['error' => 'Not enough stock available!'], 400);
        }

        $cart[$id]['quantity'] = max(1, min($request->quantity, $product->stock));
        session(['cart' => $cart]);

        return response()->json(['message' => 'Cart updated successfully!']);
    }
}
