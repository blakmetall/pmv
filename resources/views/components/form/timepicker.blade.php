@php
    $group = isset($group) ? $group : strtotime('now');
    $label = isset($label) ? $label : '';
    $name = isset($name) ? $name : '';
    $parentName = isset($parentName) ? $parentName : '';
    $lang = isset($lang) ? $lang : '';
    $required = isset($required) ? $required : false;
    $disabled = isset($disabled) ? $disabled : false;
    $value = isset($value) ? $value : '';
    $hidden = isset($hidden) ? (bool) $hidden : false;
    $readOnly = isset($readOnly) ? (bool) $readOnly : false;
    $timeInterval = isset($timeInterval) ? (integer) $timeInterval : 15;
    $timeFormatJS = isset($timeFormatJS) ? $timeFormatJS : 'HH:mm';
    $instruction = isset($instruction) ? $instruction : false;

    $id = 'field_' . $group . '_' . $name . '_' . $lang;

    $requestName = prepareFormRequestName($name, $parentName, $lang);
    $inputName = prepareFormInputName($name, $parentName, $lang);

    $value = old($requestName, $value);
    $valueWithoutSeconds = date('H:i', strtotime($value));

    $disabledProp = ($disabled) ? 'disabled' : '';
    $hiddenStyle = ($hidden) ? 'display: none;' : '';
    $readOnlyProp = ($readOnly) ? 'readonly' : '';
    
@endphp

<!-- name -->
<div class="form-group row" style="{{ $hiddenStyle }}">
    <label for="{{ $id }}" class="col-sm-2 col-form-label">
        {{ $label }}

        @if ($required)
            <span>*</span>
        @endif
    </label>

    <div class="col-sm-10">

        <input type="text" 
            value="{{ $valueWithoutSeconds }}"
            name="{{ $inputName }}"
            class="form-control app-input-timepicker" 
            id="{{ $id }}"
            {{ $disabledProp }}
            {{ $readOnlyProp }}

            data-time-interval="{{ $timeInterval }}"
            data-time-format="{{ $timeFormatJS }}"
        />

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
