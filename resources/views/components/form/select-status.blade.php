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

    $options = isset($options) && count($options) ? $options : [];
    $optionValueRef = isset($optionValueRef) ? $optionValueRef : '';


    $optionLabelRef = isset($optionLabelRef) ? $optionLabelRef : '';
    $optionLabelDepth = explode(',', $optionLabelRef);
    $hasLabelDepth = count($optionLabelDepth) == 2;


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
                    $optionLabel = '';
                    $optionLabel = $option;

                    $selected = old($requestName, $value) == $option ? 'selected' : '';
                @endphp

                <option value="{{ $option }}" {{ $selected }}>
                    {{ $optionLabel }}
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
