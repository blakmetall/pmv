<?php

namespace App\Http\Middleware;

use App\Helpers\RoleHelper;
use Closure;

class SectionPermission
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $section)
    {
        $current_role = RoleHelper::current();
        $sectionPermission = \App\Models\SectionPermission::;

        // if ($current_role->isAllowed($section, $sub)) {
        //     return $next($request);
        // }

        return redirect(route('error.forbidden'));
    }
}
