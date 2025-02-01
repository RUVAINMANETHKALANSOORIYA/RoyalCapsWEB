<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customization;

class CustomizationController extends Controller
{
    public function create()
    {
        return view('customization-form'); // Update if the view filename changes
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'address' => 'required|string',
            'contact_number' => 'required|string|max:20',
            'style' => 'required|string',
            'color' => 'required|string',
            'category' => 'required|string',
            'notes' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Image validation
        ]);

        // Handle file upload
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/logos'), $filename);
            $validatedData['logo'] = 'uploads/logos/' . $filename;
        }

        // Save data to database
        Customization::create($validatedData);

        return redirect()->route('customization.form')->with('success', 'Customization request submitted successfully!');
    }

}
