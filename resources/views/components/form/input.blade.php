@php
    $group = isset($group) ? $group : strtotime('now');
    $label = isset($label) ? $label : '';
    $name = isset($name) ? $name : '';
    $lang = isset($lang) ? $lang : '';
    $required = isset($required) ? $required : false;
    $value = isset($value) ? $value : '';

    $id = 'field_' . $group . '_' . $name . '_' . $lang;

    $oldName = $name;
    if ($lang) {
        $oldName = $lang . '.' . $name;
    }

@endphp

<!-- name -->
<div class="form-group row">
    <label for="{{ $id }}" class="col-sm-2 col-form-label">
        {{ __('Name') }}

        @if ($required)
            <span>*</span>
        @endif
    </label>

    <div class="col-sm-10">

        @if ($lang)
            <input type="text" 
                value="{{ old($oldName, $value) }}"
                name="{{ $lang }}[ {{ $name }} ]"
                class="form-control" 
                id="{{ $id }}"
            />
        @endif

        @if (!$lang)
            <input type="text" 
                value="{{ old(($oldName), $value) }}"
                name="{{ $name }}"
                class="form-control" 
                id="{{ $id }}"
            />
        @endif


        @if ($errors->has($oldName))
            <div class="app-form-input-error">
                {{ $errors->first($oldName) }}
            </div>
        @endif
    </div>
</div>