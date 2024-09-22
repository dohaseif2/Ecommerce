<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        if ($role === 'admin' && $user->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized for admin'], 403);
        }

        if ($role === 'user' && $user->role !== 'user') {
            return response()->json(['message' => 'Unauthorized for users'], 403);
        }

        return $next($request);
    }
}
