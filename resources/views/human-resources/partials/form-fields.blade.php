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

        <!-- address -->
        @include('components.form.textarea', [
            'group' => 'human-resource',
            'label' => __('Address'),
            'name' => 'address',
            'value' => $row->address
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

        <!-- department -->
        @include('components.form.input', [
            'group' => 'human-resource',
            'label' => __('Department'),
            'name' => 'department',
            'required' => true,
            'value' => $row->department
        ])

        <!-- entry_at -->
        @include('components.form.input', [
            'group' => 'human-resource',
            'label' => __('Entry At'),
            'name' => 'entry_at',
            'value' => $row->entry_at
        ])

        <!-- birthday -->
        @include('components.form.input', [
            'group' => 'human-resource',
            'label' => __('Birthday'),
            'name' => 'birthday',
            'value' => $row->birthday
        ])

        <!-- vacations_start_at -->
        @include('components.form.input', [
            'group' => 'human-resource',
            'label' => __('Vacations Start At'),
            'name' => 'vacations_start_at',
            'value' => $row->vacations_start_at
        ])

        <!-- vacations_end_at -->
        @include('components.form.input', [
            'group' => 'human-resource',
            'label' => __('Vacations End At'),
            'name' => 'vacations_end_at',
            'value' => $row->vacations_end_at
        ])

        <!-- days_vacations -->
        @include('components.form.input', [
            'group' => 'human-resource',
            'type' => 'number',
            'label' => __('Days Vacation'),
            'name' => 'days_vacations',
            'value' => $row->days_vacations
        ])

        <!-- children -->
        @include('components.form.input', [
            'group' => 'human-resource',
            'type' => 'number',
            'label' => __('Children'),
            'name' => 'children',
            'value' => $row->children
        ])

        <!-- is_active -->
        @include('components.form.checkbox', [
            'group' => 'human-resource',
            'label' => __('Active'),
            'name' => 'is_active',
            'value' => 1,
            'default' => $row->is_active,
        ])

    </div>
</div>

<!-- separator -->
<div class="mb-4"></div>
