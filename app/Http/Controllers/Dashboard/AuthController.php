<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $response = $this->authService->login($request->only('email', 'password'));

        if (!$response['success']) {
            return back()->withErrors([
                'email' => $response['message'],
            ])->withInput();
        }

        return view('index');
    }
    public function index()
    {
        return view('auth.login');
    }
}
