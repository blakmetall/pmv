<?php

namespace App\Http\Middleware;

use App;
use Closure;

class ForceHttps 
{
    public function handle($request, Closure $next)
    {
        $request->setTrustedProxies( [ $request->getClientIp() ] );
        
        if (
            !$request->secure() && 
            (App::environment() === 'production' || App::environment() === 'staging')
        ) {
            return redirect()->secure($request->getRequestUri());
        }

        return $next($request); 
    }
}