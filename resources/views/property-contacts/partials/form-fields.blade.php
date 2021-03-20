<!-- fields form -->
<div class="card">
    <div class="card-body">

        <!-- property_id -->
        @include('components.form.input', [
            'group' => 'property-contact',
            'label' => __('Property'),
            'name' => 'property_id',
            'hidden' => 'true',
            'value' => $row->id
        ])

        <!-- contacts_id -->
        @include('components.form.fast-select', [
            'group' => 'property-contact',
            'label' => __('Contacts'),
            'multiple' => true,
            'name' => 'contacts_ids',
            'options' => prepareSelectValuesFromRows($contacts, ['labelRef' => 'full_name']),
            'default' => prepareSelectDefaultValues($row->contacts, ['valueRef' => 'id']),
        ])

    </div>
</div>

<!-- separator -->
<div class="mb-4"></div>
