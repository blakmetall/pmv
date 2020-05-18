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

    $validTypes = ['text', 'email', 'password', 'date', 'time', 'datetime-local'];
    $type = isset($type) && in_array($type, $validTypes) ? $type : 'text';

    $id = 'field_' . $group . '_' . $name . '_' . $lang;

    $requestName = prepareFormRequestName($name, $parentName, $lang);
    $inputName = prepareFormInputName($name, $parentName, $lang);

    $edit_route = (\Route::current()->getName() != 'cleaning-services.create')?true:false;
    $requestValue = ($type == 'datetime-local' && $edit_route )?\Carbon\Carbon::parse(old($requestName, $value))->format('Y-m-d\TH:i'):old($requestName, $value);

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
            value="{{ $requestValue }}"
            name="{{ $inputName }}"
            class="form-control" 
            id="{{ $id }}"
            {{ $disabledProp }}
            {{ $readOnlyProp }}
        />


        @if ($errors->has($requestName))
            <div class="app-form-input-error">
                {{ $errors->first($requestName) }}
            </div>
        @endif
    </div>
</div>
