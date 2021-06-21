<!-- fields form -->
<div class="card">
    <div class="card-body">

        <!-- city_id -->
        @include('components.form.select', [
            'group' => 'human-resource',
            'label' => __('City'),
            'name' => 'city_id',
            'required' => true,
            'value' => $row->city_id,
            'options' => $cities,
            'optionValueRef' => 'id',
            'optionLabelRef' => 'name',
        ])

        <!-- firstname -->
        @include('components.form.input', [
            'group' => 'human-resource',
            'label' => __('Firstname'),
            'name' => 'firstname',
            'required' => true,
            'value' => $row->firstname
        ])

        <!-- lastname -->
        @include('components.form.input', [
            'group' => 'human-resource',
            'label' => __('Lastname'),
            'name' => 'lastname',
            'required' => true,
            'value' => $row->lastname
        ])

        <!-- scholarship -->
        @include('components.form.input', [
            'group' => 'human-resource',
            'label' => __('Scholarship'),
            'name' => 'scholarship',
            'value' => $row->scholarship
        ])

        <!-- address -->
        @include('components.form.textarea', [
            'group' => 'human-resource',
            'label' => __('Address'),
            'name' => 'address',
            'value' => $row->address
        ])

        <!-- department -->
        @include('components.form.input', [
            'group' => 'human-resource',
            'label' => __('Department'),
            'name' => 'department',
            'value' => $row->department
        ])

        <!-- position -->
        @include('components.form.input', [
            'group' => 'human-resource',
            'label' => __('Position'),
            'name' => 'position',
            'value' => $row->position
        ])

        <!-- phone -->
        @include('components.form.input', [
            'group' => 'human-resource',
            'label' => __('Phone'),
            'name' => 'phone',
            'value' => $row->phone
        ])

        <!-- emergency_phone -->
        @include('components.form.input', [
            'group' => 'human-resource',
            'label' => __('Emergency Phone'),
            'name' => 'emergency_phone',
            'value' => $row->emergency_phone
        ])

        <!-- mobile -->
        @include('components.form.input', [
            'group' => 'human-resource',
            'label' => __('Mobile'),
            'name' => 'mobile',
            'value' => $row->mobile
        ])

        <!-- birthday -->
        @include('components.form.datepicker', [
            'group' => 'human-resource',
            'label' => __('Birthday'),
            'name' => 'birthday',
            'value' => $row->birthday,
        ])

        <!-- age -->
        @if($row->birthday)
            @include('components.form.input', [
                'group' => 'human-resource',
                'label' => __('Age'),
                'name' => '_age',
                'value' => getAge($row->birthday) . ' ' . __('years'),
                'disabled' => true,
            ])
        @endif

        <!-- children -->
        @include('components.form.input', [
            'group' => 'human-resource',
            'type' => 'number',
            'label' => __('Children'),
            'name' => 'children',
            'value' => $row->children
        ])

        <!-- notes -->
        @include('components.form.textarea', [
            'group' => 'human-resource',
            'label' => __('Notes'),
            'name' => 'notes',
            'value' => $row->notes
        ])

        <hr>

        <!-- entry_at -->
        @include('components.form.datepicker', [
            'group' => 'human-resource',
            'label' => __('Entry Date'),
            'name' => 'entry_at',
            'value' => $row->entry_at,
        ])

        <!-- antiqueness -->
        @if($row->entry_at)
            @include('components.form.input', [
                'group' => 'human-resource',
                'label' => __('Antiqueness'),
                'name' => '_antiqueness',
                'value' => getAge($row->entry_at) . ' ' . __('years'),
                'disabled' => true,
            ])
        @endif

        <!-- vacation_days -->
        {{-- @include('components.form.input', [
            'group' => 'human-resource',
            'type' => 'number',
            'label' => __('Vacation Days'),
            'name' => 'vacation_days',
            'value' => $row->vacation_days
        ]) --}}

        <!-- vacation_start_date -->
        {{-- @include('components.form.datepicker', [
            'group' => 'human-resource',
            'label' => __('Start Date'),
            'name' => 'vacation_start_date',
            'value' => $row->vacation_start_date,
            'maxDaysLimitFromNow' => 730,
        ]) --}}

        <!-- vacation_end_date -->
        {{-- @include('components.form.datepicker', [
            'group' => 'human-resource',
            'label' => __('End Date'),
            'name' => 'vacation_end_date',
            'value' => $row->vacation_end_date,
            'maxDaysLimitFromNow' => 730,
        ]) --}}

        <hr>

        <!-- is_active -->
        @include('components.form.checkbox', [
            'group' => 'human-resource',
            'label' => __('Active'),
            'name' => 'is_active',
            'value' => 1,
            'default' => $row->is_active,
        ])

        <!-- is_cleaning_staff -->
        @include('components.form.checkbox', [
            'group' => 'human-resource',
            'label' => __('Is cleaning staff?'),
            'name' => 'is_cleaning_staff',
            'value' => 1,
            'default' => $row->is_cleaning_staff,
        ])

    </div>
</div>

<!-- separator -->
<div class="mb-4"></div>
