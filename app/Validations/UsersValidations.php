<?php

namespace App\Validations;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UsersValidations extends Validation
{  
    public function __construct()
    {
        $this->setDefaultValidations([
            'profile.firstname' => 'required',
            'profile.lastname' => 'required',
            'profile.country' => 'required',
            'profile.state' => 'required',
            'profile.city' => 'required',
            'profile.street' => 'required',
            'profile.zip' => 'required|numeric',
            'profile.config_agent_commission' => 'nullable|integer|between:0,100',
        ]);
    }

    public function validate($validateEvent, Request $request, $id = '')
    {
        $eventValidations = [];
        $customValidationMessages = [];
        
        $shouldUseDefaultValidations = true;

        switch($validateEvent)   {
            case 'create':
                $eventValidations = [
                    'email' => [
                        'required',
                        'email',
                        Rule::unique('users')
                    ],
                    'password' => 'required|confirmed|min:6',
                ];
            break;
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
            case 'edit-agent':
                $eventValidations = [
                    'profile.config_agent_commission' => 'integer|between:0,100',
                ];
                $shouldUseDefaultValidations = false;
            break;
        }
        
        if($shouldUseDefaultValidations) {
            $validations = array_merge($this->getDefaultValidations(), $eventValidations);
        } else {
            $validations = $eventValidations;
        }

        $this->runValidations($request->all(), $validations, $customValidationMessages);
    }
}