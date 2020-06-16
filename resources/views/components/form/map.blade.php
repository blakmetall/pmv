@php
    $group = isset($group) ? $group : strtotime('now');
    $label = isset($label) ? $label : '';
    $latitudeName = isset($latitudeName) ? $latitudeName : '';
    $longitudeName = isset($longitudeName) ? $longitudeName : '';
    $latitude = isset($latitude) ? $latitude : '';
    $longitude = isset($longitude) ? $longitude : '';
    $hidden = isset($hidden) ? (bool) $hidden : false;
    $disabled = isset($disabled) ? (bool) $disabled : false;
    $readOnly = isset($readOnly) ? (bool) $readOnly : false;

    $id = 'field_' . $group . '_' . $latitudeName;

    $hiddenStyle = ($hidden) ? 'display: none;' : '';
    $disabledProp = ($disabled) ? ' disabled ' : '';
    $readOnlyProp = ($readOnly) ? ' readonly ' : '';

@endphp

<div class="form-group row" style="{{ $hiddenStyle }}">
    <label for="{{ $id }}" class="col-sm-2 col-form-label">
        {{ $label }}
    </label>

    <div class="col-sm-10 app-map-wrapper">
        <div 
            id="{{ $id }}"
            class="app-google-map" 
            data-lat="{{ $latitude }}" 
            data-lng="{{ $longitude }}"
            data-map-id="{{ $id }}"
            data-disabled="{{ $disabledProp }}"
            data-read-only="{{ $readOnlyProp }}"
            ></div>

        <br>

        <div class="latitude-wrapper">
            @include('components.form.input', [
                'group' => $group,
                'labrel' => __('Latitude'),
                'name' => $latitudeName,
                'readOnly' => true,
                'value' => $latitude,
                'disabled' => $disabled,
                'readOnly' => $readOnly,
            ])
        </div>

        <div class="longitude-wrapper">
            @include('components.form.input', [
                'group' => $group,
                'label' => __('Longitude'),
                'name' => $longitudeName,
                'readOnly' => true,
                'value' => $longitude,
                'disabled' => $disabled,
                'readOnly' => $readOnly,
            ])
        </div>

        <div class="text-right">
            <button type="button" class="btn btn-outline-secondary btn-sm app-google-clear-map">
                {{  __('Reset Map') }}
            </button>
        </div>
    </div>

</div>
