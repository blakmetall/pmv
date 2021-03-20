<?php

namespace App\Http\Middleware;

use App;
use Closure;

class ForceHttps 
{
    public function handle($request, Closure $next)
    {
        if (
            !$request->secure() && 
            (
                (App::environment() === 'production' || App::environment() === 'staging')
                &&
                hasSSL()
            )
        ) {
            return redirect()->secure($request->getRequestUri());
        }

        return $next($request); 
    }
}