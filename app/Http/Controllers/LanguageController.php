<?php

namespace App\Http\Controllers;

use App\Helpers\Language;

class LanguageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function update($language_code) 
    {
        $profile = (auth()->user())->profile;
        if ($profile) {
            if(Language::hasValidLang($language_code)) {
                $profile->config_language = $language_code;
                $profile->save();

                session(['lang' => $language_code]);
            }
        }

        return back();
    }
}
