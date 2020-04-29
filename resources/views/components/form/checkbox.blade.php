@php
    $group = isset($group) ? $group : strtotime('now');
    $label = isset($label) ? $label : '';
    $name = isset($name) ? $name : '';
    $parentName = isset($parentName) ? $parentName : '';
    $lang = isset($lang) ? $lang : '';
    $disabled = isset($disabled) ? $disabled : false;
    $value = isset($value) ? $value : '';
    $default = isset($default) ? $default : '';
    $hidden = isset($hidden) ? (bool) $hidden : false;

    $id = 'field_' . $group . '_' . $name . '_' . $lang;

    $requestName = prepareFormRequestName($name, $parentName, $lang);    
    $inputName = prepareFormInputName($name, $parentName, $lang);
    
    $checkedProp = old($requestName, $default) ? 'checked' : '';
    $disabledProp = ($disabled) ? 'disabled' : '';
    $hiddenStyle = ($hidden) ? 'display: none;' : '';
    
@endphp

<!-- name -->
<div class="form-group row" style="{{ $hiddenStyle }}">
    <label for="{{ $id }}" class="col-sm-2 col-form-label">
        {{ $label }}
    </label>

    <div class="col-sm-10">

        <label class="checkbox checkbox-primary mb-2">
            <input type="checkbox" 
                value="{{ $value }}"
                name="{{ $inputName }}"
                id="{{ $id }}"
                {{ $checkedProp }}
                {{ $disabledProp }}
            />
            <span class="checkmark app-checkmark"></span>
        </label>

        @if ($errors->has($requestName))
            <div class="app-form-input-error">
                {{ $errors->first($requestName) }}
            </div>
        @endif
    </div>
</div>