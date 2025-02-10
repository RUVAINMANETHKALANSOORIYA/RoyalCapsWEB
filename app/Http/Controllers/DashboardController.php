<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\Customization;
use App\Models\Product; // ✅ Import Product Model

class DashboardController extends Controller
{
    /**
     * Show the dashboard page with admin, user, and customization data.
     */
    public function index()
    {
        // Get all admins
        $admins = User::where('role', 'admin')->get();

        // Get all regular users
        $users = User::where('role', 'user')->get();

        $orders = Order::with('user')->get();

        
        // Get all customizations from 'custom' table
        $customizations = Customization::all(); 

        // ✅ Get all products from 'products' table
        $products = Product::all();

        return view('dashboard', compact('admins', 'users', 'customizations', 'products', 'orders'));
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('admin.dashboard')->with('error', 'User not found.');
        }

        $user->delete();

        return redirect()->route('admin.dashboard')->with('success', 'User deleted successfully.');
    }
}
