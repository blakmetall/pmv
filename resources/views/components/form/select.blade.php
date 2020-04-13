@php
    $group = isset($group) ? $group : strtotime('now');
    $label = isset($label) ? $label : '';
    $name = isset($name) ? $name : '';
    $parentName = isset($parentName) ? $parentName : '';
    $lang = isset($lang) ? $lang : '';
    $required = isset($required) ? $required : false;
    $value = isset($value) ? $value : '';

    $options = isset($options) && count($options) ? $options : [];
    $optionLabelRef = isset($optionLabelRef) ? $optionLabelRef : '';
    $optionValueRef = isset($optionValueRef) ? $optionValueRef : '';

    $id = 'field_' . $group . '_' . $name . '_' . $lang;

     $inputName = $name;
    if ($lang) {
        $inputName = "{$lang}[{$name}]";
    } elseif ($parentName) {
        $inputName = "{$parentName}[{$name}]";
    }

    $requestName = $name;
    if ($lang) {
        $requestName = $lang . '.' . $name;
    } elseif ($parentName) {
        $requestName = $parentName . '.' . $name;
    }

@endphp

<div class="form-group row">   
    <label for="{{ $id }}" class="col-sm-2 col-form-label">
        {{ $label }}

        @if ($required)
            <span>*</span>
        @endif
    </label>

    <div class="col-sm-10">

        <select name="{{ $inputName }}" class="form-control" id="{{ $id }}">

            <option value="">{{ __('Select') }}</option>

            @foreach($options as $option)
                @php 
                    $selected = old($requestName, $value) == $option->{$optionValueRef} ? 'selected' : '';
                @endphp

                <option value="{{ $option->{$optionValueRef} }}" {{ $selected }}>
                    {{ $option->{$optionLabelRef} }}
                </option>
            @endforeach

        </select>

        @if ($errors->has($requestName))
            <div class="app-form-input-error">
                {{ $errors->first($requestName) }}
            </div>
        @endif
    </div>
</div>