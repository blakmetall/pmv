@php
    $group = isset($group) ? $group : strtotime('now');
    $label = isset($label) ? $label : '';
    $name = isset($name) ? $name : '';
    $parentName = isset($parentName) ? $parentName : '';
    $lang = isset($lang) ? $lang : '';
    $required = isset($required) ? $required : false;
    $disabled = isset($disabled) ? $disabled : false;
    $value = isset($value) ? $value : '';
    $isTranslatable = isset($translatable) ? (bool) $translatable : false;
    $disableDefaultOption = isset($disableDefaultOption) ? (bool) $disableDefaultOption : false;
    $hidden = isset($hidden) ? (bool) $hidden : false;
    $instruction = isset($instruction) ? $instruction : false;

    $options = isset($options) && count($options) ? $options : [];

    $id = 'field_' . $group . '_' . $name . '_' . $lang;

    $requestName = prepareFormRequestName($name, $parentName, $lang);
    $inputName = prepareFormInputName($name, $parentName, $lang);

    $disabledProp = ($disabled) ? 'disabled' : '';
    $hiddenStyle = ($hidden) ? 'display: none;' : '';

@endphp

<div class="form-group row" style="{{ $hiddenStyle }} ">
    <label for="{{ $id }}" class="col-sm-2 col-form-label">
        {{ $label }}

        @if ($required)
            <span>*</span>
        @endif
    </label>
    <div class="col-sm-10">

        <select
            name="{{ $inputName }}"
            class="form-control"
            id="{{ $id }}"
            {{ $disabledProp }} >

            @if (!$disableDefaultOption)
                <option value="">{{ __('Select') }}</option>
            @endif
            @foreach($options as $option)
                @php
                    $selected = old($requestName, $value) == $option['name'] ? 'selected' : '';
                @endphp

                <option value="{{ $option['name'] }}" {{ $selected }}>
                    {{ __($option['name']) }}
                </option>
            @endforeach

        </select>

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
