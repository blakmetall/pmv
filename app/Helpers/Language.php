<?php 

namespace App\Helpers;

class Language
{
    public static function current()
    {
        $lang_code = 'en';

        $user = auth()->user();
        if ($user && $user->profile) {
            if (!Language::hasValidLang($user->profile->config_language)) {
                $user->profile->config_language = $lang_code;
                $user->profile->save();
            }else{
                $lang_code = $user->profile->config_language;
            }
        }

        return \App\Models\Language::where('code', $lang_code)->first();
    }

    public static function getId($code) {
        switch($code) {
            case 'es': $id = 2; break;
            case 'en':
            default:
                $id = 1;
        }
        return $id;
    }

    public static function hasValidLang($lang) {
        $allowed_languages = ['en', 'es'];
        if (in_array($lang, $allowed_languages)) {
            return true;
        }
        return false;
    }
}