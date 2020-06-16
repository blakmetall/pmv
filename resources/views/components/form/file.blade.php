@php
    $group = isset($group) ? $group : strtotime('now');
    $label = isset($label) ? $label : '';
    $name = isset($name) ? $name : '';
    $parentName = isset($parentName) ? $parentName : '';
    $lang = isset($lang) ? $lang : '';
    $required = isset($required) ? $required : false;
    $disabled = isset($disabled) ? $disabled : false;
    $hidden = isset($hidden) ? (bool) $hidden : false;
    $readOnly = isset($readOnly) ? (bool) $readOnly : false;
    $isMultiple = isset($isMultiple) ? (bool) $isMultiple : false;

    $fileName = isset($fileName) ? $fileName : '';
    $filePath = isset($filePath) ? $filePath : false;
    $fileUrl = isset($fileUrl) ? $fileUrl : false;
    $fileExtension = isset($fileExtension) ? $fileExtension : false;
    
    $isImage = false;
    $validImageExtensions = Config::get('constants.valid_image_types');
    if ($fileExtension !== false && in_array($fileExtension, $validImageExtensions)) {
        $isImage = true;
    }

    $id = 'field_' . $group . '_' . $name . '_' . $lang;

    $requestName = prepareFormRequestName($name, $parentName, $lang);
    $inputName = prepareFormInputName($name, $parentName, $lang);
    if ($isMultiple) {
        $inputName .= '[]';
    }

    $disabledProp = ($disabled) ? ' disabled' : '';
    $hiddenStyle = ($hidden) ? ' display: none; ' : '';
    $readOnlyProp = ($readOnly) ? ' readonly ' : '';
    $multipleProp = $isMultiple ? ' multiple ' : '';
    
@endphp

<!-- name -->
<div class="form-group row" style="{{ $hiddenStyle }}">
    <label for="{{ $id }}" class="col-sm-2 col-form-label">
        {{ $label }}

        @if ($required)
            <span>*</span>
        @endif
    </label>

    <div class="col-sm-10">

        <div>
            <input type="file"
                name="{{ $inputName }}"
                class="form-control" 
                id="{{ $id }}"
                {{ $disabledProp }}
                {{ $readOnlyProp }}
                {{ $multipleProp }}
            />

            @if ($errors->has($requestName))
                <div class="app-form-input-error">
                    {{ $errors->first($requestName) }}
                </div>
            @endif
        </div>

        @if ($fileUrl !== false)
            <div class="app-file-card pt-4">
                <div class="card">

                    @if ($isImage)
                        <img class="card-img" src="{{ asset(getUrlPath($fileUrl)) }}" alt="Card image">
                    @endif

                    @php 
                        $overlayClass = $isImage ? 'card-img-overlay' : 'app-card-text-overlay';
                        $textBgClass = $isImage ? 'text-white' : ''; 
                    @endphp
                    <div class="{{ $overlayClass }}">

                        @if ($fileName !== '')
                            <h5 class="card-title {{ $textBgClass }}">
                                <a href="{{ asset(getUrlPath($fileUrl)) }}" target="_blank">
                                    {{ $fileName }}
                                </a>
                            </h5>
                        @endif
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
