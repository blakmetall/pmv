<?php

namespace App\Http\Controllers;

use Auth;
use Hash;
use Illuminate\Http\Request;
use App\Models\User;
use App\Validations\AccountValidations;

class AccountController extends Controller
{
    private $validation;

    public function __construct()
    {
        $this->validation = new AccountValidations();
    }

    public function edit()
    {
        return view('account.edit')->with('user', Auth::user());
    }

    public function update(Request $request)
    {
        dd('asasas');
        $user = Auth::user();

        $this->validation->validate('edit', $request, $user->id);

        $user->email = $request->email;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        $request->session()->flash('success', __('Account updated successfully'));

        return redirect(route('account'));
    }
}
