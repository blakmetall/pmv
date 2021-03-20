<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Helpers\LanguageHelper;

class LangMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $saved_locale = $request->session()->get('locale');
        $has_saved_locale = !! $saved_locale;
        if ($has_saved_locale) {
            LanguageHelper::setLocale($saved_locale);
        }

        $user = Auth::user();
        if ($user && $user->profile) {
            LanguageHelper::setLocale($user->profile->config_language);
        }

        return $next($request);
    }
}
