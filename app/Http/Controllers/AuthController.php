<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(RegisterRequest $request)
    {
        $data = $request->all();

        $response = $this->authService->register($data);

        if ($response['success']) {
            return response()->json([
                'message' => $response['message'],
                'user' => $response['user'],
            ], 201);
        }

        return response()->json([
            'message' => $response['message'],
        ], 400);
    }
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        $result = $this->authService->login($credentials);

        if (!$result['success']) {
            return response()->json(['message' => $result['message']], 401);
        }

        return response()->json([
            'message' => $result['message'],
            'access_token' => $result['token'],
        ]);
    }
}
