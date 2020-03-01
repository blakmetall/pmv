<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Helpers\LanguageHelper;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('profile.edit')->with('profile', Auth::user()->profile);
    }

    public function update(Request $request)
    {
        $profile = Auth::user()->profile;

        $profile->firstname               = $request->firstname;
        $profile->lastname                = $request->lastname;
        $profile->country                 = $request->country;
        $profile->state                   = $request->state;
        $profile->city                    = $request->city;
        $profile->street                  = $request->street;
        $profile->zip                     = $request->zip;
        $profile->phone                   = $request->phone;
        $profile->mobile                  = $request->mobile;
        $profile->config_language         = $request->config_language;
        $profile->config_agent_commission = $request->config_agent_commission;
        $profile->save();

        return redirect(route('profile'));
    }
}
