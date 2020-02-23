<?php

namespace App\Http\Controllers;

use App;
use App\Helpers\LanguageHelper;

class LanguageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Sets the active language for the user in the database
     */
    public function update($language_code) 
    {
        $profile = (auth()->user())->profile;
        if ($profile) {
            if(LanguageHelper::hasValidLang($language_code)) {
                $profile->config_language = $language_code;
                $profile->save();

                session(['lang' => $language_code]);
                App::setLocale($language_code);
            }
        }

        return back();
    }
}
