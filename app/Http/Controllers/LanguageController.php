<?php

namespace App\Http\Controllers;

use App\Helpers\LanguageHelper;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    /**
     * Sets the active language for the user in the database
     */
    public function update(Request $request, $locale = 'en', $property = false) 
    {
        if (LanguageHelper::hasValidLocale($locale)) {
            $user = auth()->user();

            if ($user) {
                $profile = $user->profile;
                if ($profile) {
                    $profile->config_language = $locale;
                    $profile->save();
                }
            }

            LanguageHelper::setLocale($locale);
            $request->session()->put('locale', $locale);

            $prevUrl = url()->previous();
            
            if($locale == 'es') {
                if(isProduction()){
                    $newUrl = preg_replace('/.mx\/en/', ".mx/es", $prevUrl);
                }else{
                    $newUrl = preg_replace('/:8000\/en/', ":8000/es", $prevUrl);
                }
            }else{
                if(isProduction()){
                    $newUrl = preg_replace('/.mx\/es/', ".mx/en", $prevUrl);
                }else{
                    $newUrl = preg_replace('/:8000\/es/', ":8000/en", $prevUrl);
                }
            }

            return redirect($newUrl);
        }

        return back();
    }
}
