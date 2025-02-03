<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\DeliveryDetail;
use App\Models\Customization; // ✅ Import Customization Model
use App\Models\Order;
use App\Models\Product; // ✅ Import Product Model

class AdminDashboardController extends Controller
{
    /**
     * Show the admin dashboard with delivery details.
     */
    public function index()
    {
        // Get all admins
        $admins = User::where('role', 'admin')->get();
        
        // Fetch customizations
        $customizations = Customization::all();

        // Fetch all orders
        $orders = Order::all();

        // Get all regular users
        $users = User::where('role', 'user')->get();

        // ✅ Fetch all delivery details from the database
        $deliveryDetails = DeliveryDetail::all();

        $products = Product::all();

        // ✅ Pass deliveryDetails to the admin dashboard view
        return view('admin.dashboard', compact('admins', 'users', 'deliveryDetails', 'customizations', 'orders', 'products'));
    }
}

