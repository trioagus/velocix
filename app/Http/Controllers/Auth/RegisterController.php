<?php

namespace App\Http\Controllers\Auth;

use Velocix\Http\Controller;
use Velocix\Http\Request;
use Velocix\Auth\Auth;
use Velocix\Validation\Validator;
use App\Models\User;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return $this->view('auth.register');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return $this->json([
                'error' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $user = User::create($request->only(['name', 'email', 'password']));

        Auth::login($user->toArray());

        return $this->json([
            'message' => 'Registration successful',
            'redirect' => '/dashboard'
        ], 201);
    }
}