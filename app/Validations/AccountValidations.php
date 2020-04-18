<?php

namespace App\Validations;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AccountValidations
{  
    public static function validateOnEdit(Request $request, $id)
    {
        return self::validate('edit', $request, $id);
    }

    public static function getDefaultValidations()
    {
        $defaultValidations = [];
        return $defaultValidations;
    }

    public static function validate($validateEvent, Request $request, $id)
    {
        $redirectRoute = '';
        $validations = [];

        switch($validateEvent)   {
            case 'edit':
                $redirectRoute = 'account';
                $validations = [
                    'email' => [
                        'required',
                        Rule::unique('users')->ignore($id)
                    ],
                    'password' => 'nullable|confirmed|min:6'
                ];
            break;
        }

        $validations = array_merge(self::getDefaultValidations(), $validations);

        $validator = Validator::make($request->all(), $validations);

        if( $validator->fails() ) {
            throw new ValidationException($validator);
        }
    }
}