<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Helpers\UserHelper;
use App\Helpers\RoleHelper;

class RedirectIfAuthenticated
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
        if (Auth::check()) {
            $isAdmin = RoleHelper::is('super') || RoleHelper::is('admin');
            if (!$isAdmin) {
                if (Auth::guard($guard)->check()) {
                    return redirect('/system/dashboard');
                }
            }
        } else {
            if (Auth::guard($guard)->check()) {
                return redirect('/system/dashboard');
            }
        }

        return $next($request);
    }
}
