<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthService
{
    public function register(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone' => $data['phone'],
            'role' => $data['role']
        ]);

        return [
            'success' => true,
            'message' => 'User registered successfully',
            'user' => $user
        ];
    }
    public function login(array $credentials)
    {
        if (!Auth::attempt($credentials)) {
            return ['success' => false, 'message' => 'Invalid login credentials.'];
        }

        $user = User::where('email', $credentials['email'])->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;

        return [
            'success' => true,
            'token' => $token,
            'message' => 'Login successful!',
        ];
    }
    public function logout()
    {
        $user = Auth::user();

        if ($user) {
            $user->tokens()->delete();
            return true;
        }

        return false;
    }
}