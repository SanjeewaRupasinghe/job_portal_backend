<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): JsonResponse
    {
        // validate request
        $request->validate([
            'email'      => ['required', 'string', 'lowercase', 'email', 'max:255'],
            'password'   => ['required']
        ]);

        // authenticate user
        $request->authenticate();

        // get user
        $user = $request->user();

        // Revoke all existing tokens (optional, for security)
        $user->tokens()->delete();

        // Create a new token for the user
        $token = $user->createToken('auth_token')->plainTextToken;

        // Activity log
        activity()
            ->causedBy($user)
            ->useLog('Auth')
            ->withProperties([
                'time' => now()->format('Y-m-d H:i'),
                'ip' => request()->ip()
            ])
            ->log('Logged in');

        // return response
        return response()->json([
            'message' => 'User logged in successfully',
            'data' => $user,
            'access_token' => $token,
            'token_type' => 'Bearer',
        ], 200);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): Response
    {
        // logout user
        Auth::guard('web')->logout();

        // invalidate session
        $request->session()->invalidate();

        // regenerate token
        $request->session()->regenerateToken();

        return response()->noContent();
    }
}
