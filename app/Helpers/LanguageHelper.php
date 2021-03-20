<?php 

namespace App\Helpers;

use App;
use Config;
use App\Models\Language;

class LanguageHelper
{
    public static function current()
    {
        $locale = self::getDefaultLocale();

        $user = auth()->user();
        if ($user && $user->profile) {
            if (!self::hasValidLocale($user->profile->config_language)) {
                $user->profile->config_language = $locale;
                $user->profile->save();
            }else{
                $locale = $user->profile->config_language;
            }
        }

        return Language::where('code', $locale)->first();
    }

    public static function setLocale($locale) {
        $locale = self::hasValidLocale($locale) ? $locale : self::getDefaultLocale();
        App::setLocale($locale);
    }

    public static function getLocale() {
        return App::getLocale();
    }

    public static function hasValidLocale($locale) {
        return in_array($locale, ['en', 'es']);
    }
    
    public static function getId($locale) {
        $locales = ['en' => 1, 'es' => 2];
        return (isset($locales[$locale])) ? $locales[$locale] : $locales[self::getDefaultLocale()];
    }

    public static function getDefaultLocale() {
        return Config::get('app.locale');
    }
}