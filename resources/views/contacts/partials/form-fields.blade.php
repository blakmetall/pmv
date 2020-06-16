<!-- fields form -->
<div class="card">
    <div class="card-body">

        <!-- firstname -->
        @include('components.form.input', [
            'group' => 'contact',
            'label' => __('Firstname'),
            'name' => 'firstname',
            'required' => true,
            'value' => $row->firstname
        ])

        <!-- lastname -->
        @include('components.form.input', [
            'group' => 'contact',
            'label' => __('Lastname'),
            'name' => 'lastname',
            'required' => true,
            'value' => $row->lastname,
        ])

        <!-- email -->
        @include('components.form.input', [
            'group' => 'contact',
            'type' => 'email',
            'label' => __('Email'),
            'name' => 'email',
            'required' => true,
            'value' => $row->email
        ])

        <!-- phone -->
        @include('components.form.input', [
            'group' => 'contact',
            'label' => __('Phone'),
            'name' => 'phone',
            'value' => $row->phone
        ])        

        <!-- mobile -->
        @include('components.form.input', [
            'group' => 'contact',
            'label' => __('Mobile'),
            'name' => 'mobile',
            'value' => $row->mobile
        ])

        <!-- emergency phone -->
        @include('components.form.input', [
            'group' => 'contact',
            'label' => __('Emergency Phone'),
            'name' => 'emergency_phone',
            'required' => true,
            'value' => $row->emergency_phone
        ])

        <!-- address -->
        @include('components.form.textarea', [
            'group' => 'contact',
            'label' => __('Address'),
            'name' => 'address',
            'value' => $row->address
        ])

        <!-- type -->
        @include('components.form.select', [
            'group' => 'contact',
            'label' => __('Contact Type'),
            'name' => 'contact_type',
            'value' => $row->contact_type,
            'options' => $types,
            'optionValueRef' => 'id',
            'optionLabelRef' => 'label',
        ]) 

        <!-- is_active -->
        @include('components.form.checkbox', [
            'group' => 'contact',
            'label' => __('Active'),
            'name' => 'is_active',
            'value' => 1,
            'default' => $row->is_active,
        ])

    </div>
</div>

<!-- separator -->
<div class="mb-4"></div>
