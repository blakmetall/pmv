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

        <!-- contact_id -->
        @include('components.form.checkbox-multiple', [
            'group' => 'property-contact',
            'label' => __('Contacts'),
            'name' => 'contacts_ids',
            'values' => prepareCheckboxValuesFromRows($contacts, [
                'valueRef' => 'id',
                'labelRef' => 'full_name'
            ]),
            'default' => prepareCheckboxDefaultValues($row->contacts, [
                'valueRef' => 'id',
            ]),
        ])

    </div>
</div>

<!-- separator -->
<div class="mb-4"></div>
