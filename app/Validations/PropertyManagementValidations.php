<?php

namespace App\Validations;

use Illuminate\Http\Request;

class PropertyManagementValidations extends Validation
{  
    public function __construct()
    {
        $this->setDefaultValidations([
            'property_id' => 'required',
            'management_fee' => 'required|numeric|min:0',
            'start_date' => 'required|date_format:Y-m-d',
            'end_date' => 'nullable|date_format:Y-m-d|after:start_date',
        ]);
    }

    /*
        se necesita una validación para evitar que las fechas start_date y end_date se cruce 
        con ningún otro property management de la misma propiedad

        este codigo de abajo lo copié de una validación manual en el controller, tez sirva al aplicar la validacioön

        if($request->end_date > getCurrentDate()){
            $pm = PropertyManagement::where('property_id', $property->id)->where('is_finished', 0)->where('id', '!=', $id)->first();
        }
    */

    public function validate($validateEvent = '', Request $request, $id = '')
    {
        $eventValidations = [];
        $customValidationMessages = [];

        switch($validateEvent)   {
            case 'create': break;
            case 'edit': break;
        }

        $validations = array_merge($this->getDefaultValidations(), $eventValidations);

        $this->runValidations($request->all(), $validations, $customValidationMessages);
    }
}