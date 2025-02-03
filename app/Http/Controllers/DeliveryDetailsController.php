<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DeliveryDetail;

class DeliveryDetailsController extends Controller
{
    /**
     * Store delivery details in the database.
     */
    public function store(Request $request)
{
    if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'You must be logged in to place an order.');
    }

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'phone' => 'required|string',
        'city' => 'required|string',
        'postal_code' => 'required|string',
        'delivery_address' => 'required|string',
        'delivery_instructions' => 'nullable|string',
    ]);

    // Store Delivery Details Only
    $delivery = DeliveryDetail::create([
        'user_id' => Auth::id(),
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'city' => $request->city,
        'postal_code' => $request->postal_code,
        'delivery_address' => $request->delivery_address,
        'delivery_instructions' => $request->delivery_instructions,
        'status' => 'Pending',
    ]);

    if ($delivery) {
        \Log::info('Delivery details stored successfully', ['id' => $delivery->id]);
    } else {
        \Log::error('Failed to store delivery details');
    }

    // Redirect to order confirmation page
    $cart = session()->get('cart', []);
    foreach ($cart as $productId => $item) {
        $product = \App\Models\Product::find($productId);
        if ($product) {
            $product->stock -= $item['quantity']; // Reduce stock
            $product->save();
        }
    }
    session()->forget('cart'); // Clear cart

    // Redirect to order confirmation page
    return redirect()->route('order.confirm')->with('success', 'Your delivery details have been saved successfully!');
}

    /**
     * Store delivery details in the database.
     */




    /**
     * Show a list of all delivery details (for admin view).
     */
    public function index()
    {
        $deliveryDetails = DeliveryDetail::all();
        return view('admin.delivery_details', compact('deliveryDetails'));
    }

    /**
     * Update the delivery status.
     */
    

    public function update(Request $request, $id)
{
    $request->validate([
        'status' => 'required|in:Pending,Accepted,Rejected',
    ]);

    $delivery = DeliveryDetail::findOrFail($id); // ✅ Correct Model Name
    $delivery->update(['status' => $request->status]);

    return redirect()->route('admin.dashboard')->with('success', 'Delivery status updated successfully.');
}


    
}
