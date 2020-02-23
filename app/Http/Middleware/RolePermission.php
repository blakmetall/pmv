<?php

namespace App\Http\Middleware;

use Closure;
use App\Helpers\Role;

class RolePermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $section, $sub)
    {
        $role = Role::current();
        if($role->isAllowed($section, $sub)) {
            return $next($request);
        }

        return redirect(route('error.forbidden'));
    }
}
