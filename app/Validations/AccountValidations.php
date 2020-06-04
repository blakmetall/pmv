<?php

namespace App\Validations;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AccountValidations extends Validation
{  
    public function validate($validateEvent, Request $request, $id)
    {
        $eventValidations = [];
        $customValidationMessages = [];
    
        switch($validateEvent)   {
            case 'edit':
                $eventValidations = [
                    'email' => [
                        'required',
                        'email',
                        Rule::unique('users')->ignore($id)
                    ],
                    'password' => 'nullable|confirmed|min:6'
                ];
            break;
        }

        $validations = array_merge(self::getDefaultValidations(), $eventValidations);

        $this->runValidations($request->all(), $validations, $customValidationMessages);
    }
}