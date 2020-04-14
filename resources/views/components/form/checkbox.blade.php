@php
    $group = isset($group) ? $group : strtotime('now');
    $label = isset($label) ? $label : '';
    $name = isset($name) ? $name : '';
    $parentName = isset($parentName) ? $parentName : '';
    $lang = isset($lang) ? $lang : '';
    $value = isset($value) ? $value : '';
    $default = isset($default) ? $default : '';

    $id = 'field_' . $group . '_' . $name . '_' . $lang;

    $requestName = prepareFormRequestName($name, $parentName, $lang);    
    $inputName = prepareFormInputName($name, $parentName, $lang);
    
    $checked = old($requestName, $default) ? 'checked' : '';
    
@endphp

<!-- name -->
<div class="form-group row">
    <label for="{{ $id }}" class="col-sm-2 col-form-label">
        {{ $label }}
    </label>

    <div class="col-sm-10">

        <label class="checkbox checkbox-primary">
            <input type="checkbox" 
                value="{{ $value }}"
                name="{{ $inputName }}"
                id="{{ $id }}"
                {{ $checked }}
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