@php
    $group = isset($group) ? $group : strtotime('now');
    $label = isset($label) ? $label : '';
    $name = isset($name) ? $name : '';
    $parentName = isset($parentName) ? $parentName : '';
    $lang = isset($lang) ? $lang : '';
    $required = isset($required) ? $required : false;
    $disabled = isset($disabled) ? $disabled : false;
    $value = isset($value) ? $value : '';
    $rows = isset($rows) && is_numeric($rows) ? (int) $rows : 3;
    $resize = isset($resize) ? $resize : false;
    $hidden = isset($hidden) ? (bool) $hidden : false;
    $instruction = isset($instruction) ? $instruction : false;

    $id = 'field_' . $group . '_' . $name . '_' . $lang;

    $requestName = prepareFormRequestName($name, $parentName, $lang);    
    $inputName = prepareFormInputName($name, $parentName, $lang);

    $disabledProp = ($disabled) ? 'disabled' : '';
    $resizeStyle = ($resize) ? 'resize: vertical;' : 'resize: none;';
    $hiddenStyle = ($hidden) ? 'display: none;' : '';

    $property      = $booking->property->translations()->where('language_id', $lang->id)->first();
    $adults        = ($booking->adults) ? $booking->adults : 0;
    $kids          = ($booking->kids) ? $booking->kids : 0;
    $pricePerNight = ($booking->price_per_night) ? priceFormat($booking->price_per_night) : 0;
    $totalStay     = ($booking->subtotal_nights) ? priceFormat($booking->subtotal_nights) : 0;
    $damageDeposit = ($booking->subtotal_damage_deposit) ? $booking->subtotal_damage_deposit : 0;
    $getTotal      = ($booking->total) ? $booking->total : 0;
    $total         = priceFormat($damageDeposit + $getTotal);
    
@endphp


<div class="form-group row" style="{{ $hiddenStyle }}">
    <label for="{{ $id }}" class="col-sm-2 col-form-label">
        {{ $label }}

        @if ($required)
            <span>*</span>
        @endif
    </label>

    <div class="col-sm-10">
        <textarea 
            name="{{ $inputName }}"
            class="form-control" 
            rows="{{ $rows }}"
            id="{{ $id }}"
            style="{{ $resizeStyle }}"
            {{ $disabledProp }}
            >Hello 

This is to let you know we made a wire transfer to your bank account in the amount of $ MXN pesos, this is a payment for the reservation detailed below:

----------------------------------------
TRAVEL DETAILS
----------------------------------------
PROPERTY:  
CONFIRMATION:  0
RESERVATION NAME:  
DATES:   -  | 0 Night(s)
RATE:  Avg. Nightly $0 USD | Total for the Stay $0 USD
OCCUPANTS:  0 Adult | 0 Child
PAYMENT BREAKDOWN: $ USD - $ USD (commission) = $ USD @  = $ MXN pesos

If you have any questions, please let us know.

Thank you.

**********************************************************************
		  
Hola 

El presente email es para informarle que le hemos hecho una transferencia bancaria por la cantidad de $ MXN pesos, este pago es por la reservación detallada abajo:

----------------------------------------
DETALLES DE RESERVACIÓN
----------------------------------------
PROPIEDAD:  
CONFIRMACIÓN:  0
NOMBRE DE LA RESERVACIÓN:  
FECHAS:   -  | 0 Noche(s)
TARIFA:  Prom. Noche $0 USD | Total de la Estancia $0 USD
OCUPANTES:  0 Adultos | 0 Niños
DESGLOSE DEL PAGO: $ USD - $ USD (comisión) = $ USD @  = $ MXN pesos

Si tiene alguna pregunta no dude en comunicarse con nosotros.

Gracias.
        </textarea>

        @if ($instruction)
            <small>{{ $instruction }}</small>
        @endif

        @if ($errors->has($requestName))
            <div class="app-form-input-error">
                {{ $errors->first($requestName) }}
            </div>
        @endif
    </div>
</div>