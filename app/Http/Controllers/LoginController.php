<?php

namespace App\Http\Controllers; // ✅ Correct Namespace

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Handle login request.
     */

    public function index()
    {
        return view('admin.dashboard');
    }

    public function login(Request $request)
    {
        // Validate user input
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        // Attempt to log in the user
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); // Secure session regeneration
            $user = Auth::user();

            // ✅ Redirect admins to the dashboard
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            // ✅ Redirect regular users to home
            return redirect()->route('dashboard');
        }

        // If login fails, return error message
        return back()->withErrors(['email' => 'Invalid credentials.'])->withInput();
    }

    /**
     * Handle logout request.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home'); // ✅ Redirect to home after logout
    }
}
