<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DeliveryDetail;

class DeliveryDetailsApiController extends Controller
{
    /**
     * Get delivery details for the authenticated user.
     */
    public function index()
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized access',
            ], 401);
        }

        $deliveryDetails = DeliveryDetail::where('user_id', $user->id)->get();

        return response()->json([
            'status' => true,
            'message' => 'User delivery details retrieved successfully',
            'data' => $deliveryDetails,
        ], 200);
    }

    /**
     * Store delivery details for the authenticated user.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized access',
            ], 401);
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

        $deliveryDetail = DeliveryDetail::create([
            'user_id' => $user->id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'city' => $request->city,
            'postal_code' => $request->postal_code,
            'delivery_address' => $request->delivery_address,
            'delivery_instructions' => $request->delivery_instructions,
            'status' => 'Pending',
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Delivery details saved successfully',
            'data' => $deliveryDetail,
        ], 201);
    }
}
