<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class AdminOnly
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::user()->role !== User::ROLE_ADMIN) {
            return response([
                'code' => 'NOT_AUTHORIZED',
                'message' => 'You don\'t have privileges to do this action',
            ], 401);
        }

        return $next($request);
    }
}
