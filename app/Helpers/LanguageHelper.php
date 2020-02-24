<?php 

namespace App\Helpers;

use App;
use App\Models\Language;

class LanguageHelper
{
    public static function current()
    {
        $lang_code = 'en';

        $user = auth()->user();
        if ($user && $user->profile) {
            if (!self::hasValidLocale($user->profile->config_language)) {
                $user->profile->config_language = $lang_code;
                $user->profile->save();
            }else{
                $lang_code = $user->profile->config_language;
            }
        }

        return Language::where('code', $lang_code)->first();
    }

    public static function setLocale($locale) {
        $locale = self::hasValidLocale($locale) ? $locale : 'en';
        App::setLocale($locale);
    }

    public static function getLocale() {
        return App::getLocale();
    }

    public static function hasValidLocale($locale) {
        return in_array($locale, ['en', 'es']);
    }
    
    public static function getId($locale) {
        $locales = ['en' => 2, 'es' => 1];
        return (isset($locales[$locale])) ? $locales[$locale] : 2;
    }
}