<?php

namespace App\Http\Controllers\Auth;

use Velocix\Http\Controller;
use Velocix\Http\Request;
use Velocix\Auth\Auth;
use Velocix\Validation\Validator;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return $this->view('auth.login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->json([
                'error' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        if (Auth::attempt($request->only(['email', 'password']))) {
            return $this->json([
                'message' => 'Login successful',
                'redirect' => '/dashboard'
            ]);
        }

        return $this->json([
            'error' => 'Invalid credentials'
        ], 401);
    }

    public function logout()
    {
        Auth::logout();
        
        // Return JSON for AJAX/SPA requests
        return $this->json([
            'message' => 'Logged out successfully',
            'redirect' => '/login'
        ]);
    }
}