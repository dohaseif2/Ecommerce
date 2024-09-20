<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;

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
}
