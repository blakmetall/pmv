@php
    $group = isset($group) ? $group : strtotime('now');
    $label = isset($label) ? $label : '';
    $name = isset($name) ? $name : '';
    $parentName = isset($parentName) ? $parentName : '';
    $lang = isset($lang) ? $lang : '';
    $required = isset($required) ? (bool) $required : false;
    $disabled = isset($disabled) ? (bool) $disabled : false;
    $value = isset($value) ? $value : '';
    $hidden = isset($hidden) ? (bool) $hidden : false;
    $readOnly = isset($readOnly) ? (bool) $readOnly : false;
    $instruction = isset($instruction) ? $instruction : false;

    $validTypes = ['text', 'email', 'password', 'date', 'time', 'hidden'];
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

        <input type="{{ $type }}" 
            value="{{ old($requestName, $value) }}"
            name="{{ $inputName }}"
            class="form-control" 
            id="{{ $id }}"
            {{ $disabledProp }}
            {{ $readOnlyProp }}
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
