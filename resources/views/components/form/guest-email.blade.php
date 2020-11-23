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
            >Hello , &#13;&#10;&#13;&#10;This notification is to let you know we received a payment to guarantee your reservation, below is a reservation update confirming your payment.&#13;&#10;&#13;&#10;----------------------------------------&#13;&#10;TRAVEL DETAILS&#13;&#10;----------------------------------------&#13;&#10;PROPERTY: {{ $property->name }}&#13;&#10;RESERVATION NAME: {{ $booking->full_name }} &#13;&#10;OCCUPANTS: {{ $adults }} Adults | {{ $kids }} Child&#13;&#10;DATES: {{ $booking->arrival_date }} - {{ $booking->departure_date }} | {{ $booking->nights }} Night(s)&#13;&#10; RATE: Avg. Night {{ $pricePerNight }} USD | &#13;&#10;Total for the Stay {{ $totalStay }} USD&#13;&#10;DAMAGE INSURANCE: {{ $damageDeposit }} USD&#13;&#10;TOTAL: {{ $total }} USD&#13;&#10;&#13;&#10;----------------------------------------&#13;&#10;PAYMENTS AND BALANCE&#13;&#10;----------------------------------------&#13;&#10;BALANCE DUE: $0.00 USD&#13;&#10;&#13;&#10;If you have any questions please do not hesitate to contact us, thank you.&#13;&#10;&#13;&#10;**********************************************************************&#13;&#10;&#13;&#10;Hola,&#13;&#10;&#13;&#10;El presente es para confirmarle la recepción de su pago para garantizar su reservación, esta es una actualización de su reservación confirmando su pago.&#13;&#10;&#13;&#10;----------------------------------------&#13;&#10;DETALLES DE RESERVACIÓN&#13;&#10;----------------------------------------&#13;&#10;PROPIEDAD: {{ $property->name }}&#13;&#10;NOMBRE DE RESERVACIÓN: {{ $booking->full_name }}&#13;&#10; OCUPANTES: {{ $adults }} Adultos | {{ $kids }} Niños&#13;&#10;FECHAS DE VIAJE: {{ $booking->arrival_date }} - {{ $booking->departure_date }} | {{ $booking->nights }} Noche(s)&#13;&#10;TARIFA: Prom. Noche {{ $pricePerNight }} USD | Total de la Estancia {{ $totalStay }} USD&#13;&#10;SEGURO DE DAÑOS: {{ $damageDeposit }} USD&#13;&#10;TOTAL: {{ $total }} USD&#13;&#10;&#13;&#10;----------------------------------------&#13;&#10;PAGOS Y BALANCE&#13;&#10;----------------------------------------&#13;&#10;BALANCE: $0.00 USD&#13;&#10;&#13;&#10;Si tiene alguna pregunta no dude en comunicarse con nosotros, gracias.
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