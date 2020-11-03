<!-- fields form -->
<div class="card">
    <div class="card-body">

        <!-- is_contact -->
        @include('components.form.input', [
            'group' => 'contact',
            'name' => 'is_contact',
            'hidden' => 'true',
            'value' => true
        ])

        <!-- password -->
        @include('components.form.input', [
            'group' => 'contact',
            'name' => 'password',
            'hidden' => 'true',
            'value' => '123456'
        ])

        <!-- password -->
        @include('components.form.input', [
            'group' => 'contact',
            'name' => 'password_confirmation',
            'hidden' => 'true',
            'value' => '123456'
        ])

        <!-- roles -->
        @include('components.form.input', [
            'group' => 'contact',
            'name' => 'roles_ids[]',
            'hidden' => 'true',
            'value' => 14
        ])

        <!-- firstname -->
        @include('components.form.input', [
            'group' => 'contact',
            'label' => __('Firstname'),
            'name' => 'firstname',
            'parentName' => 'profile',
            'required' => true,
            'value' => $row->profile->firstname
        ])

        <!-- lastname -->
        @include('components.form.input', [
            'group' => 'contact',
            'label' => __('Lastname'),
            'parentName' => 'profile',
            'name' => 'lastname',
            'required' => true,
            'value' => $row->profile->lastname
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
            'parentName' => 'profile',
            'name' => 'phone',
            'value' => $row->profile->phone
        ])        

        <!-- mobile -->
        @include('components.form.input', [
            'group' => 'contact',
            'label' => __('Mobile'),
            'parentName' => 'profile',
            'name' => 'mobile',
            'value' => $row->profile->mobile
        ])

        <!-- emergency phone -->
        @include('components.form.input', [
            'group' => 'contact',
            'label' => __('Emergency Phone'),
            'parentName' => 'profile',
            'name' => 'emergency_phone',
            'required' => true,
            'value' => $row->profile->emergency_phone
        ])

        <!-- country -->
        @include('components.form.input', [
            'group' => 'user',
            'label' => __('Country'),
            'name' => 'country',
            'parentName' => 'profile',
            'required' => true,
            'value' => $row->profile->country
        ])

        <!-- state -->
        @include('components.form.input', [
            'group' => 'user',
            'label' => __('State'),
            'name' => 'state',
            'parentName' => 'profile',
            'required' => true,
            'value' => $row->profile->state
        ])

        <!-- city -->
        @include('components.form.input', [
            'group' => 'user',
            'label' => __('City'),
            'name' => 'city',
            'parentName' => 'profile',
            'required' => true,
            'value' => $row->profile->city
        ])

        <!-- street -->
        @include('components.form.input', [
            'group' => 'user',
            'label' => __('Street'),
            'name' => 'street',
            'parentName' => 'profile',
            'required' => true,
            'value' => $row->profile->street
        ])

        <!-- zip -->
        @include('components.form.input', [
            'group' => 'user',
            'label' => __('Zip'),
            'name' => 'zip',
            'parentName' => 'profile',
            'required' => true,
            'value' => $row->profile->zip
        ])

        <!-- type -->
        @include('components.form.select', [
            'group' => 'contact',
            'label' => __('Contact Type'),
            'parentName' => 'profile',
            'name' => 'contact_type',
            'options' => $types,
            'value' => $row->profile->contact_type,
            'optionValueRef' => 'id',
            'optionLabelRef' => 'label',
        ]) 

        <!-- is_enabled -->
        @include('components.form.checkbox', [
            'group' => 'contact',
            'label' => __('Active'),
            'name' => 'is_enabled',
            'value' => 1,
            'default' => $row->is_enabled,
        ])

    </div>
</div>

<!-- separator -->
<div class="mb-4"></div>
