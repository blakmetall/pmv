<?php

namespace App\Validations;

use Auth;
use Illuminate\Http\Request;

class PropertyCheckListValidations extends Validation
{
    public function __construct()
    {
        $validations = [
            'property_id' => 'required',
        ];

        $this->setDefaultValidations($validations);
    }

    public function validate($validateEvent = '', Request $request, $id = '')
    {
        $eventValidations = [];
        $customValidationMessages = [];

        switch ($validateEvent) {
            case 'create':
                break;
            case 'edit':
                break;
        }

        $validations = array_merge($this->getDefaultValidations(), $eventValidations);

        $this->runValidations($request->all(), $validations, $customValidationMessages);
    }
}
