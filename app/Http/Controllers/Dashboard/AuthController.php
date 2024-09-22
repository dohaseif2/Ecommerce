<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
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

        return redirect()->route('index');
    }
    public function index()
    {
        return view('auth.login');
    }

    public function logout(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            $user->tokens()->delete();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('login.index');
        }
    }
}