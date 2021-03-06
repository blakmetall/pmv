<!-- fields form -->
<div class="card">
    <div class="card-body">

        <!-- property_id -->
        @include('components.form.select', [
            'group' => 'property-image',
            'label' => __('Property'),
            'name' => 'property_id',
            'required' => true,
            'value' => $row->property_id,
            'options' => [$property],
            'optionValueRef' => 'id',
            'optionLabelRef' => 'name',
            'translatable' => true,
            'disableDefaultOption' => true
        ])

        <img src="{{ asset($row->file_path) }}" alt="" width="100">

        <!-- images -->
        @php
            $isMultiple = !$row->id ? true :  false;    
        @endphp

        @include('components.form.file', [
            'group' => 'property-image',
            'label' => __('Images'),
            'name' => 'photos',
            'required' => true,
            'isMultiple' => $isMultiple,
            'fileName' => $row->file_original_name,
            'filePath' => $row->file_path,
            'fileUrl' => $row->file_url,
            'fileExtension' => $row->file_extension,
        ])

    </div>
</div>

<!-- separator -->
<div class="mb-4"></div>
