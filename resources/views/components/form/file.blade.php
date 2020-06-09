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

    $folderName = isset($folderName) ? $folderName : '';
    $fileName = isset($fileName) ? $fileName : '';
    $filePath = isset($filePath) ? $filePath : false;
    $fileUrl = isset($fileUrl) ? $fileUrl : false;
    $isImage = isset($isImage) ? true : false;

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
            <div class="app-file-wrapper">
                <div class="card bg-dark text-white o-hidden mb-4">

                    @if ($isImage)
                        <img class="card-img" src="{{ asset(getUrlPath($fileUrl, $folderName)) }}" alt="Card image">
                    @endif

                    @if ($fileName !== '')
                        <div class="card-img-overlay">
                            @php 
                                $textBgClass = $isImage ? 'text-white' : ''; 
                            @endphp

                            <h5 class="card-title {{ $textBgClass }}">
                                {{ $fileName }}
                            </h5>
                        </div>
                    @endif
                </div>
            </div>
        @endif
    </div>
</div>
