@php
    $group = isset($group) ? $group : strtotime('now');
    $label = isset($label) ? $label : '';
    $name = isset($name) ? $name : '';
    $parentName = isset($parentName) ? $parentName : '';
    $lang = isset($lang) ? $lang : '';
    $values = isset($values) ? $values : '';
    $default = isset($default) ? $default : '';

    $id = 'field_' . $group . '_' . $name . '_' . $lang;

    $requestName = prepareFormRequestName($name, $parentName, $lang);    
    $inputName = prepareFormInputName($name, $parentName, $lang);
    
    // echo '<pre>', print_r($default), '</pre>';
@endphp

<!-- name -->
<div class="form-group row">
    <label for="{{ $id }}" class="col-sm-2 col-form-label">
        {{ $label }}
    </label>

    <div class="col-sm-10">

        @foreach($values as $key => $item)
            <label class="checkbox checkbox-primary mb-2">
                
                @php
                    // $checked = old($requestName, $default) ? 'checked' : '';
                    $checked = '';
                @endphp

                <input type="checkbox" 
                    value="{{ $item['value'] }}"
                    name="{{ $inputName }}[]"
                    id="{{ $id . '_' . $key }}"
                    {{ $checked }}
                />

                <span class="checkmark app-checkmark"></span>

                <div class="app-form-checkbox-label">
                    {{ $item['label']}}
                </div>

            </label>
        @endforeach

        @if ($errors->has($requestName))
            <div class="app-form-input-error">
                {{ $errors->first($requestName) }}
            </div>
        @endif
    </div>
</div>