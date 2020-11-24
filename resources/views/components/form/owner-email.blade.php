@php
    $group = isset($group) ? $group : strtotime('now');
    $label = isset($label) ? $label : '';
    $name = isset($name) ? $name : '';
    $parentName = isset($parentName) ? $parentName : '';
    $required = isset($required) ? $required : false;
    $disabled = isset($disabled) ? $disabled : false;
    $value = isset($value) ? $value : '';
    $rows = isset($rows) && is_numeric($rows) ? (int) $rows : 3;
    $resize = isset($resize) ? $resize : false;
    $hidden = isset($hidden) ? (bool) $hidden : false;
    $instruction = isset($instruction) ? $instruction : false;

    $id = 'field_' . $group . '_' . $name . '_' . $lang;

    $requestName = prepareFormRequestName($name, $parentName, '');    
    $inputName = prepareFormInputName($name, $parentName, '');

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
            >Hello&#13;&#10;&#13;&#10;This is to let you know we made a wire transfer to your bank account in the amount of $ MXN pesos, this is a payment for the reservation detailed below:&#13;&#10;&#13;&#10;----------------------------------------&#13;&#10;TRAVEL DETAILS&#13;&#10;----------------------------------------&#13;&#10;&#13;&#10;PROPERTY: {{ $property->name }}&#13;&#10;RESERVATION NAME: {{ $booking->full_name }}&#13;&#10;DATES: {{ $booking->arrival_date }} - {{ $booking->departure_date }} | {{ $booking->nights }} Night(s)&#13;&#10;RATE: Avg. Nightly {{ $pricePerNight }} USD | Total for the Stay {{ $totalStay }} USD&#13;&#10;OCCUPANTS: {{ $adults }} Adults | {{ $kids }} Child&#13;&#10;PAYMENT BREAKDOWN: $ USD - $ USD (commission) = $ USD @  = $ MXN pesos&#13;&#10;&#13;&#10;If you have any questions, please let us know.&#13;&#10;&#13;&#10;Thank you.&#13;&#10;&#13;&#10;**********************************************************************&#13;&#10;&#13;&#10;Hola&#13;&#10;&#13;&#10;El presente email es para informarle que le hemos hecho una transferencia bancaria por la cantidad de $ MXN pesos, este pago es por la reservación detallada abajo:&#13;&#10;&#13;&#10;----------------------------------------&#13;&#10;DETALLES DE RESERVACIÓN&#13;&#10;----------------------------------------&#13;&#10;&#13;&#10;PROPIEDAD: {{ $property->name }}&#13;&#10;NOMBRE DE LA RESERVACIÓN: {{ $booking->full_name }}&#13;&#10;FECHAS: {{ $booking->arrival_date }} - {{ $booking->departure_date }} | {{ $booking->nights }} Noche(s)&#13;&#10;TARIFA: Prom. Noche {{ $pricePerNight }} USD | Total de la Estancia {{ $totalStay }} USD&#13;&#10;OCUPANTES: {{ $adults }} Adultos | {{ $kids }} Niños&#13;&#10;DESGLOSE DEL PAGO: $ USD - $ USD (comisión) = $ USD @  = $ MXN pesos&#13;&#10;&#13;&#10;Si tiene alguna pregunta no dude en comunicarse con nosotros.&#13;&#10;&#13;&#10;Gracias.
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