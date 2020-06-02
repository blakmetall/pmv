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
        <input type="file" class="form-control" name="property_image" />

    </div>
</div>

<!-- separator -->
<div class="mb-4"></div>
