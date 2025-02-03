<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $user = Auth::user();

        $token = $user->createToken($user->email);

        // Store token in session if session is available
        if ($request->hasSession()) {
            $request->session()->put('auth_token', $token->plainTextToken);
            $request->session()->regenerate();
        }

        if ($request->wantsJson()) {
            return response()->json([
                'status' => true,
                'message' => 'Successfully logged in',
                'user' => $user,
                'token' => $token->plainTextToken,
                'token_type' => 'Bearer'
            ], 200);
        }

        return redirect()->route('dashboard');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::user()->tokens()->delete();

        if ($request->hasSession()) {
            // Clear the session token
            $request->session()->forget('auth_token');

            // Invalidate session
            $request->session()->invalidate();

            // Regenerate CSRF token
            $request->session()->regenerateToken();
        }

         // Logout user
         Auth::guard('web')->logout();

         $response = [
             'status' => true,
             'message' => 'Logged out successfully'
         ];
 
         if ($request->expectsJson()) {
             return new JsonResponse($response, 200);
         }
 
         return redirect('/')->with('status', 'Logged out successfully');

    }
}
