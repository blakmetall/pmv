<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Validations\ProfileValidations;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('profile.edit')->with('profile', Auth::user()->profile);
    }

    public function update(Request $request)
    {
        ProfileValidations::validateOnEdit($request);
        $profile = Auth::user()->profile;
        $profile->fill($request->all());
        $profile->save();
        $request->session()->flash('success', __('Profile updated successfully'));

        return redirect(route('profile'));
    }
}
