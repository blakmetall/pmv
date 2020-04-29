<!-- fields form -->
<div class="card">
    <div class="card-body">

        <!-- city_id -->
        @include('components.form.select', [
            'group' => 'property-note',
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

        <!-- description -->
        @include('components.form.textarea', [
            'group' => 'property-note',
            'label' => __('Description'),
            'name' => 'description',
            'value' => $row->description,
        ])

    </div>
</div>

<!-- separator -->
<div class="mb-4"></div>
