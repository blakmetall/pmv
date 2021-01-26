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
<div class="form-group" style="display: flex">
    <label for="{{ $id }}" style="margin-right: 10px">
        {{ $label }}
    </label>
    <label class="checkbox checkbox-primary">
        <input type="checkbox" value="{{ $value }}" name="{{ $inputName }}" id="{{ $id }}" {{ $checkedProp }}
            {{ $disabledProp }} />
        <span class="checkmark app-checkmark" style="top: 0"></span>
    </label>

    @if ($errors->has($requestName))
        <div class="app-form-input-error">
            {{ $errors->first($requestName) }}
        </div>
    @endif
</div>
