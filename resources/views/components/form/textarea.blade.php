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

    $id = 'field_' . $group . '_' . $name . '_' . $lang;

    $requestName = prepareFormRequestName($name, $parentName, $lang);    
    $inputName = prepareFormInputName($name, $parentName, $lang);

    $disabledProp = ($disabled) ? 'disabled' : '';
    $resizeStyle = ($resize) ? 'resize: vertical;' : 'resize: none;';
    $hiddenStyle = ($hidden) ? 'display: none;' : '';
    
@endphp


<div class="form-group row">
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
            style="{{ $resizeStyle }} {{ $hiddenStyle }}"
            {{ $disabledProp }}
            >{{ old($requestName, $value) }}</textarea>

        @if ($errors->has($requestName))
            <div class="app-form-input-error">
                {{ $errors->first($requestName) }}
            </div>
        @endif
    </div>
</div>