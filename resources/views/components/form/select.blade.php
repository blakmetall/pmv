@php
    $group = isset($group) ? $group : strtotime('now');
    $label = isset($label) ? $label : '';
    $name = isset($name) ? $name : '';
    $lang = isset($lang) ? $lang : '';
    $required = isset($required) ? $required : false;
    $value = isset($value) ? $value : '';

    $options = isset($options) && count($options) ? $options : [];
    $optionLabelRef = isset($optionLabelRef) ? $optionLabelRef : '';
    $optionValueRef = isset($optionValueRef) ? $optionValueRef : '';

    $id = 'field_' . $group . '_' . $name . '_' . $lang;

    $oldName = $name;
    if ($lang) {
        $oldName = $lang . '.' . $name;
    }

@endphp

<div class="form-group row">   
    <label for="{{ $id }}" class="col-sm-2 col-form-label">
        {{ __($label) }}

        @if ($required)
            <span>*</span>
        @endif
    </label>

    <div class="col-sm-10">

        <select name="{{ $name }}" class="form-control" id="{{ $id }}">
            <option value="">{{ __('Select') }}</option>

            @foreach($options as $option)
                @php 
                    $selected = old($oldName, $value) == $option->{$optionValueRef} ? 'selected' : '';
                @endphp

                <option value="{{ $option->{$optionValueRef} }}" {{ $selected }}>
                    {{ $option->{$optionLabelRef} }}
                </option>
            @endforeach
        </select>

        @if ($errors->has($oldName))
            <div class="app-form-input-error">
                {{ $errors->first($oldName) }}
            </div>
        @endif
    </div>
</div>