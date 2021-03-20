<?php

namespace App\Validations;

use Illuminate\Http\Request;

class PropertyImagesValidations extends Validation
{  
    public function __construct()
    {
        $this->setDefaultValidations([
            'property_id' => 'required',
        ]);
    }

    public function validate($validateEvent, Request $request, $id = '')
    {
        $eventValidations = [];
        $customValidationMessages = [
            'photos.*.mimes' => __('Allowed formats: jpg, jpeg, png, bnm'),
            'photos.mimes' => __('Allowed formats: jpg, jpeg, png, bnm'),
        ];

        switch($validateEvent)   {
            case 'create': 
                $eventValidations['photos.*'] = 'required|mimes:jpeg,png,bmp';
            break;
            case 'edit': 
                $eventValidations['photos'] = 'required|mimes:jpeg,png,bmp';
            break;
        }

        $validations = array_merge($this->getDefaultValidations(), $eventValidations);

        $this->runValidations($request->all(), $validations, $customValidationMessages);
    }
}
