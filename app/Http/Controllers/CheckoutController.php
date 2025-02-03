<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Product;
use App\Models\DeliveryDetail;
use App\Models\Order;

class CheckoutController extends Controller
{

    public function index()
    {
        return view('pages.checkout'); // ✅ Correct path
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string',
            'city' => 'required|string',
            'postal_code' => 'required|string',
            'delivery_address' => 'required|string',
            'delivery_instructions' => 'nullable|string',
        ]);

        $cart = session('cart', []);
        $totalPrice = collect($cart)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });

        $checkout = Checkout::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'city' => $request->city,
            'postal_code' => $request->postal_code,
            'delivery_address' => $request->delivery_address,
            'delivery_instructions' => $request->delivery_instructions,
            'total_price' => $totalPrice,
            'status' => 'Pending',
        ]);

        // Clear the cart session
        Session::forget('cart');

        return redirect()->route('home')->with('success', 'Order placed successfully!');
    }

    public function processCheckout(Request $request)
{
    $cart = session('cart', []);
    
    if (empty($cart)) {
        return response()->json(['success' => false, 'message' => 'Cart is empty!']);
    }

    foreach ($cart as $item) {
        $product = Product::find($item['id']);
        
        if ($product && $product->stock >= $item['quantity']) {
            // Reduce stock
            $product->stock -= $item['quantity'];
            $product->save();
        } else {
            return response()->json(['success' => false, 'message' => 'Some products are out of stock.']);
        }
    }

    // Clear cart session
    session()->forget('cart');

    return response()->json(['success' => true]);
}

}
