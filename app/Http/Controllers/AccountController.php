<?php

namespace App\Http\Controllers;

use Auth;
use Hash;
use Illuminate\Http\Request;
use App\Models\User;
use App\Validations\AccountValidations;

class AccountController extends Controller
{
    public function edit()
    {
        return view('account.edit')->with('user', Auth::user());
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        
        AccountValidations::validateOnEdit($request, $user->id);

        $user->email = $request->email;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        $request->session()->flash('success', __('Account updated successfully'));

        return redirect(route('account'));
    }
}
