<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\DeliveryDetail;
use App\Models\Customization; // ✅ Import Customization Model
use App\Models\Order;

class AdminDashboardController extends Controller
{
    /**
     * Show the admin dashboard with delivery details.
     */
    public function index()
    {
        // Get all admins
        $admins = User::where('role', 'admin')->get();
        
        $customizations = Customization::all(); // ✅ Fetch all customizations

        $orders = Order::all(); // ✅ Fetch all orders


        // Get all regular users
        $users = User::where('role', 'user')->get();

        // Get all delivery details
        $deliveryDetails = DeliveryDetail::all(); 

        return view('admin.dashboard', compact('admins', 'users', 'deliveryDetails', 'customizations', 'orders')); // ✅ Pass customizations and orders to the view
    }
}
