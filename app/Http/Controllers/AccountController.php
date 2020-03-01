<?php

namespace App\Http\Controllers;

use Auth;
use Hash;
use Illuminate\Http\Request;
use App\Models\User;

class AccountController extends Controller
{
    public function edit()
    {
        return view('account.edit')->with('user', Auth::user());
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $user->email = $request->email;
        
        if ( !empty($request->password) ) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect(route('account'));
    }
}
