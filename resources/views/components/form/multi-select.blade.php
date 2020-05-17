@php
    $group = isset($group) ? $group : strtotime('now');
    $label = isset($label) ? $label : '';
    $name = isset($name) ? $name : '';
    $parentName = isset($parentName) ? $parentName : '';
    $lang = isset($lang) ? $lang : '';
    $required = isset($required) ? $required : false;
    $disabled = isset($disabled) ? $disabled : false;
    $disableDefaultOption = isset($disableDefaultOption) ? (bool) $disableDefaultOption : false;
    $hidden = isset($hidden) ? (bool) $hidden : false;

    $options = isset($options) && count($options) ? $options : [];

    $id = 'field_' . $group . '_' . $name . '_' . $lang;
    $className = 'field_multiselect';
    $placeholder = ($placeholder) ? $placeholder : '';

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
            multiple
            name="{{ $inputName }}"
            class="{{ $className }} form-control"
            id="{{ $id }}"
            data-placeholder="{{ $placeholder }}"
            {{ $disabledProp }} >

            @if (!$disableDefaultOption)
                <option value="">{{ __('Select') }}</option>
            @endif

            @foreach($options as $option)
                @php
                    $selected = (in_array($option['value'], old($requestName, $default)))?'selected':'';
                @endphp

                <option value="{{ $option['value'] }}" {{ $selected }}>
                    {{ $option['label'] }}
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
