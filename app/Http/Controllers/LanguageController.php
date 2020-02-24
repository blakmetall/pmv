<?php

namespace App\Http\Controllers;

use App;
use App\Helpers\LanguageHelper;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function __construct()
    {
        // public access to switch language enabled
    }

    /**
     * Sets the active language for the user in the database
     */
    public function update(Request $request, $locale = 'en') 
    {
        $user = auth()->user();
        if ($user) {
            $profile = $user->profile;
            if ($profile) {
                if(LanguageHelper::hasValidLocale($locale)) {
                    $profile->config_language = $locale;
                    $profile->save();
                }
            }
        }

        LanguageHelper::setLocale($locale);
        $request->session()->put('locale', $locale);

        return back();
    }
}
