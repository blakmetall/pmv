@php
    $group = isset($group) ? $group : strtotime('now');
    $label = isset($label) ? $label : '';
    $name = isset($name) ? $name : '';
    $lang = isset($lang) ? $lang : '';
    $required = isset($required) ? $required : false;
    $value = isset($value) ? $value : '';

    $id = 'field_' . $group . '_' . $name . '_' . $lang;

    $inputName = $name;
    if ($lang) {
        $inputName = "{$lang}[{$name}]";
    }

    $requestName = $name;
    if ($lang) {
        $requestName = $lang . '.' . $name;
    }
    
@endphp

<!-- name -->
<div class="form-group row">
    <label for="{{ $id }}" class="col-sm-2 col-form-label">
        {{ $label }}

        @if ($required)
            <span>*</span>
        @endif
    </label>

    <div class="col-sm-10">

        <input type="text" 
            value="{{ old($requestName, $value) }}"
            name="{{ $inputName }}"
            class="form-control" 
            id="{{ $id }}"
        />


        @if ($errors->has($requestName))
            <div class="app-form-input-error">
                {{ $errors->first($requestName) }}
            </div>
        @endif
    </div>
</div>