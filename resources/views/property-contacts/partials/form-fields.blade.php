<!-- fields form -->
<div class="card">
    <div class="card-body">

        <!-- property_id -->
        @include('components.form.select', [
            'group' => 'property-contact',
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

        <!-- name -->
        @include('components.form.input', [
            'group' => 'property-contact',
            'label' => __('Name'),
            'name' => 'name',
            'value' => $row->name,
            'required' => true,
        ])

        <!-- email -->
        @include('components.form.input', [
            'group' => 'property-contact',
            'label' => __('Email'),
            'name' => 'email',
            'value' => $row->email,
            'type' => 'email',
        ])

        <!-- phone -->
        @include('components.form.input', [
            'group' => 'property-contact',
            'label' => __('Phone'),
            'name' => 'phone',
            'value' => $row->phone,
        ])

        <!-- mobile -->
        @include('components.form.input', [
            'group' => 'property-contact',
            'label' => __('Mobile'),
            'name' => 'mobile',
            'value' => $row->mobile,
        ])
        

    </div>
</div>

<!-- separator -->
<div class="mb-4"></div>
