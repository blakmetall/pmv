<?php

namespace App\Validations;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UsersValidations
{  
    public static function validateOnCreate(Request $request)
    {
        return self::validate('create', $request);
    }

    public static function validateOnEdit(Request $request, $id = '')
    {
        return self::validate('edit', $request, $id);
    }

    public static function getDefaultValidations()
    {
        $defaultValidations = [
            'profile.firstname' => 'required',
            'profile.lastname' => 'required',
            'profile.country' => 'required',
            'profile.state' => 'required',
            'profile.city' => 'required',
            'profile.street' => 'required',
            'profile.zip' => 'required|numeric',
            'profile.config_agent_commission' => 'nullable|integer|between:0,100',
        ];

        return $defaultValidations;
    }

    public static function validate($validateEvent, Request $request, $id = '')
    {
        $redirectRoute = '';
        $validations = [];

        switch($validateEvent)   {
            case 'create':
                $redirectRoute = 'users.create';
                $validations = [
                    'email' => [
                        'required',
                        Rule::unique('users')
                    ],
                    'password' => 'required|confirmed|min:6',
                ];
            break;
            case 'edit':
                $redirectRoute = 'users.edit';
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