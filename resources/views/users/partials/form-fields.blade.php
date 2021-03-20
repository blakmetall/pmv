@php
    $label = isset($label) ? $label : '';
@endphp

<div class="card">
    <div class="card-body">

        @if ($label)
            <span class="badge badge-primary r-badge mb-4">{{ $label }}</span>
        @endif 

        <!-- email -->
        @include('components.form.input', [
            'group' => 'user',
            'type' => 'email',
            'label' => __('Email'),
            'name' => 'email',
            'required' => true,
            'value' => $row->email,
        ])

        <!-- password -->
        @include('components.form.input', [
            'group' => 'user',
            'type' => 'password',
            'label' => __('Password'),
            'name' => 'password',
        ])

        <!-- confirm password -->
        @include('components.form.input', [
            'group' => 'user',
            'type' => 'password',
            'label' => __('Confirm Password'),
            'name' => 'password_confirmation',
        ])

        <!-- is_enabled -->
        @include('components.form.checkbox', [
            'group' => 'user',
            'label' => __('Enabled'),
            'name' => 'is_enabled',
            'value' => 1,
            'default' => $row->is_enabled,
        ])

        <!-- roles -->
        @include('components.form.checkbox-multiple', [
            'group' => 'user',
            'label' => __('Roles'),
            'name' => 'roles_ids',
            'values' => prepareCheckboxValuesFromRows($roles, [
                'valueRef' => 'role_id'
            ]),
            'default' => prepareCheckboxDefaultValues($row->roles, [
                'valueRef' => 'id',
            ]),
        ])

        @if (!$row->id)
            <!-- request_reset_password -->
            @include('components.form.checkbox', [
                'group' => 'user',
                'label' => __('Request password reset'),
                'name' => 'request_password_reset',
                'value' => 1,
            ])
        @endif

    </div>
</div>

<!-- separator -->
<div class="mb-4"></div>

<!-- fields form -->
<div class="card">
    <div class="card-body">

        <!-- firstname -->
        @include('components.form.input', [
            'group' => 'user',
            'label' => __('Firstname'),
            'name' => 'firstname',
            'parentName' => 'profile',
            'required' => true,
            'value' => $row->profile->firstname
        ])

        <!-- lastname -->
        @include('components.form.input', [
            'group' => 'user',
            'label' => __('Lastname'),
            'name' => 'lastname',
            'parentName' => 'profile',
            'required' => true,
            'value' => $row->profile->lastname
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

        <!-- phone -->
        @include('components.form.input', [
            'group' => 'user',
            'label' => __('Phone'),
            'name' => 'phone',
            'parentName' => 'profile',
            'value' => $row->profile->phone
        ])        

        <!-- mobile -->
        @include('components.form.input', [
            'group' => 'user',
            'label' => __('Mobile'),
            'name' => 'mobile',
            'parentName' => 'profile',
            'value' => $row->profile->mobile
        ])

        <hr>

        <!-- agent enabled status -->
        @include('components.form.checkbox', [
            'group' => 'user',
            'label' => __('Agent Enabled'),
            'name' => 'config_agent_is_enabled',
            'parentName' => 'profile',
            'value' => 1,
            'default' => $row->profile->config_agent_is_enabled
        ])

        <!-- commission -->
        @include('components.form.input', [
            'group' => 'user',
            'label' => __('Agent Commission') . ' %',
            'name' => 'config_agent_commission',
            'parentName' => 'profile',
            'value' => $row->profile->config_agent_commission
        ])

        <hr>

        <!-- workgroup selection -->
        @include('components.form.checkbox-multiple', [
            'group' => 'user',
            'label' => __('Workgroups'),
            'name' => 'workgroups_ids',
            'values' => prepareCheckboxValuesFromRows($workgroups, [
                'valueRef' => 'id'
            ]),
            'default' => prepareCheckboxDefaultValues($row->workgroups, [
                'valueRef' => 'id',
            ]),
        ])

    </div>
</div>

<!-- separator -->
<div class="mb-4"></div>
