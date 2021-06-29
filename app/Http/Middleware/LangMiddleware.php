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
        // sets locale from session
        $saved_locale = $request->session()->get('locale');
        $has_saved_locale = !! $saved_locale;
        if ($has_saved_locale) {
            LanguageHelper::setLocale($saved_locale);
        }

        // change language for admin área according to user config language
        $user = Auth::user();
        if ($user && $user->profile) {
            LanguageHelper::setLocale($user->profile->config_language);
        }

        // change language for public area according to url segment
        $langSegments = request()->segments();
        if($langSegments[0] == 'en' || $langSegments[0] == 'es'){
            LanguageHelper::setLocale($langSegments[0]);
        }

        return $next($request);
    }
}
