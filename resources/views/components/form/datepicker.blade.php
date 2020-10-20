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
    $dateFormatJS = isset($dateFormatJS) ? $dateFormatJS : 'yyyy-mm-dd';
    $maxDaysLimitFromNow = isset($maxDaysLimitFromNow) ? $maxDaysLimitFromNow : '0';
    $instruction = isset($instruction) ? $instruction : false;

    $validTypes = ['text', 'hidden'];
    $type = isset($type) && in_array($type, $validTypes) ? $type : 'text';

    $id = 'field_' . $group . '_' . $name . '_' . $lang;

    $requestName = prepareFormRequestName($name, $parentName, $lang);
    $inputName = prepareFormInputName($name, $parentName, $lang);

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

        <div class="input-right-icon">
            <input type="{{ $type }}" 
                value="{{ old($requestName, $value) }}"
                name="{{ $inputName }}"
                class="form-control app-input-datepicker" 
                id="{{ $id }}"
                {{ $disabledProp }}
                {{ $readOnlyProp }}

                data-format="{{ $dateFormatJS }}"
                data-max-days-limit-from-now="{{ $maxDaysLimitFromNow }}"
            />
            <span class="span-right-input-icon">
                <i class="ul-form__icon i-Calendar-4"></i>
            </span>
        </div>

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
