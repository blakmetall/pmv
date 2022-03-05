@php
    $group = isset($group) ? $group : strtotime('now');
    $label = isset($label) ? $label : '';
    $name = isset($name) ? $name : '';
    $parentName = isset($parentName) ? $parentName : '';
    $lang = isset($lang) ? $lang : '';
    $disabled = isset($disabled) ? $disabled : false;
    $values = isset($values) ? $values : '';
    $default = isset($default)  ? $default : [];
    $hidden = isset($hidden) ? (bool) $hidden : false;

    $id = 'field_' . $group . '_' . $name . '_' . $lang;

    $requestName = prepareFormRequestName($name, $parentName, $lang);
    $inputName = prepareFormInputName($name, $parentName, $lang);
    
    $disabledProp = ($disabled) ? 'disabled' : '';
    $hiddenStyle = ($hidden) ? 'display: none;' : '';

@endphp

<div class="form-group row mb-3" style="{{ $hiddenStyle }}">
    <label for="{{ $id }}" class="col-sm-2 col-form-label">
        {{ $label }}
    </label>

    <div class="col-sm-10">

        @foreach($values as $key => $item)
            <label class="checkbox checkbox-primary mb-2" style="display: inline-block; margin-right: 10px">
                
                @php
                   
                    $checkedProp = '';
                    if($default == $item['value']) {
                        $checkedProp = 'checked';
                    }

                @endphp

                <input type="radio" 
                    value="{{ $item['value'] }}"
                    name="{{ $inputName }}"
                    id="{{ $id . '_' . $key }}"
                    {{ $checkedProp }}
                    {{ $disabledProp }}
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