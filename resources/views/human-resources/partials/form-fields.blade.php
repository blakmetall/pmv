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

        <!-- birthday -->
        @include('components.form.input', [
            'group' => 'human-resource',
            'label' => __('Birthday'),
            'name' => 'birthday',
            'value' => $row->birthday
        ])

        <!-- children -->
        @include('components.form.input', [
            'group' => 'human-resource',
            'type' => 'number',
            'label' => __('Children'),
            'name' => 'children',
            'value' => $row->children
        ])

        <hr>

        <!-- entry_at -->
        @include('components.form.input', [
            'group' => 'human-resource',
            'label' => __('Entry Date'),
            'name' => 'entry_at',
            'value' => $row->entry_at
        ])

        <!-- days_vacations -->
        @include('components.form.input', [
            'group' => 'human-resource',
            'type' => 'number',
            'label' => __('Vacation Days'),
            'name' => 'days_vacations',
            'value' => $row->days_vacations
        ])

        <!-- vacations_start_at -->
        @include('components.form.input', [
            'group' => 'human-resource',
            'label' => __('Start Date'),
            'name' => 'vacations_start_at',
            'value' => $row->vacations_start_at
        ])

        <!-- vacations_end_at -->
        @include('components.form.input', [
            'group' => 'human-resource',
            'label' => __('End Date'),
            'name' => 'vacations_end_at',
            'value' => $row->vacations_end_at
        ])

        <hr>

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
