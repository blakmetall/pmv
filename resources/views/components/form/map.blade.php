@php
    $group = isset($group) ? $group : strtotime('now');
    $label = isset($label) ? $label : '';
    $name = isset($name) ? $name : '';
    $hidden = isset($hidden) ? (bool) $hidden : false;

    $id = 'field_' . $group . '_' . $name;

    $disabledProp = ($disabled) ? 'disabled' : '';
    $hiddenStyle = ($hidden) ? 'display: none;' : '';

    $latitude = ($latitude) ? $latitude : '';
    $longitude = ($longitude) ? $longitude : '';

@endphp

<div class="form-group row" style="{{ $hiddenStyle }}">
    <label for="{{ $id }}" class="col-sm-2 col-form-label">
        {{ $label }}
    </label>

    <div class="col-sm-10">
        <div id="map" data-lat="{{ $latitude }}" data-lng="{{ $longitude }}"></div>
    </div>
</div>
