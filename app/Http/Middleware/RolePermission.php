<?php

namespace App\Http\Middleware;

use App\Helpers\RoleHelper;
use Closure;

class RolePermission
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $section, $sub)
    {
        $current_role = RoleHelper::current();
        if ($current_role->isAllowed($section, $sub)) {
            return $next($request);
        }

        return redirect(route('error.forbidden'));
    }
}
