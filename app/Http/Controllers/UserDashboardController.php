<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\DeliveryDetail;

class UserDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Fetch user's orders
        $orders = Order::where('user_id', $user->id)->get();
        
        // Fetch user's delivery details
        $deliveryDetails = DeliveryDetail::where('user_id', $user->id)->get();

        return view('dashboard', compact('orders', 'deliveryDetails'));
    }
}
