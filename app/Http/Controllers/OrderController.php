<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\DeliveryDetail;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Store order details in the database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'phone' => 'required|string',
            'delivery_instructions' => 'nullable|string',
        ]);
    
        // Create a new delivery detail entry
        $deliveryDetail = DeliveryDetail::create([
            'user_id' => Auth::id(),
            'name' => Auth::user()->name, // Assuming the user's name is stored in the User model
            'email' => Auth::user()->email, // Assuming the user's email is stored in the User model
            'phone' => $request->phone,
            'city' => $request->city, // Assuming city is passed in the request
            'postal_code' => $request->postal_code, // Assuming postal code is passed in the request
            'delivery_address' => $request->delivery_address, // Assuming delivery address is passed in the request
            'delivery_instructions' => $request->delivery_instructions,
            'status' => 'Pending',
        ]);
    
        // Get cart products (assuming session-based cart)
        $cart = session()->get('cart', []);
    
        if (empty($cart)) {
            return back()->with('error', 'Your cart is empty.');
        }
    
        foreach ($cart as $cartItem) {
            $product = Product::findOrFail($cartItem['id']);
    
            // Check if stock is available
            if ($product->stock < $cartItem['quantity']) {
                return back()->with('error', "Not enough stock available for {$product->name}.");
            }
    
            // Deduct stock
            $product->stock -= $cartItem['quantity'];
            $product->save();
    
            // Create order for each item
            Order::create([
                'user_id' => Auth::id(),
                'delivery_detail_id' => $deliveryDetail->id,
                'status' => 'Pending',
            ]);
        }
    
        // Clear the cart
        session()->forget('cart');
    
        return redirect()->route('home')->with('success', 'Order placed successfully!');
    }

    /**
     * Update the order status.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Pending,Accepted,Rejected,Shipped,Delivered',
        ]);

        $order = Order::findOrFail($id);
        $order->update(['status' => $request->status]);

        return redirect()->route('admin.dashboard')->with('success', 'Order status updated successfully.');
    }
}
