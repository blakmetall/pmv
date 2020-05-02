<!-- fields form -->
<div class="card">
    <div class="card-body">

        <!-- property_id -->
        @include('components.form.select', [
            'group' => 'cleaning-service',
            'label' => __('Property'),
            'name' => 'property_id',
            'required' => true,
            'value' => $row->property_id,
            'options' => $properties,
            'optionValueRef' => 'id',
            'optionLabelRef' => 'name',
        ])

        <!-- date -->
        @include('components.form.input', [
            'group' => 'cleaning-service',
            'type' => 'date',
            'label' => __('Date'),
            'name' => 'date',
            'required' => true,
            'value' => $row->date
        ])

        <!-- hours -->
        @include('components.form.input', [
            'group' => 'cleaning-service',
            'type' => 'time',
            'label' => __('Hour'),
            'name' => 'hour',
            'required' => true,
            'value' => $row->hour
        ])

        <!-- description -->
        @include('components.form.textarea', [
            'group' => 'cleaning-service',
            'label' => __('Description'),
            'name' => 'description',
            'required' => true,
            'value' => $row->description
        ])

        <!-- maid_fee -->
        @include('components.form.number', [
            'group' => 'cleaning-service',
            'type' => 'number',
            'label' => __('Maid Fee'),
            'name' => 'maid_fee',
            'required' => true,
            'value' => $row->maid_fee
        ])

        <!-- is_finished -->
        @include('components.form.checkbox', [
            'group' => 'cleaning-service',
            'label' => __('Status'),
            'name' => 'is_finished',
            'value' => 1,
            'default' => $row->is_finished,
        ])

        <!-- audit_datetime -->
        @include('components.form.input', [
            'group' => 'cleaning-service',
            'type' => 'datetime-local',
            'label' => __('Audit Datetime'),
            'name' => 'audit_datetime',
            'required' => true,
            'value' => $row->audit_datetime,
        ])

        <!-- audit_user_id -->
        @include('components.form.select', [
            'group' => 'cleaning-service',
            'label' => __('Auditor'),
            'name' => 'audit_user_id',
            'required' => true,
            'value' => $row->audit_user_id,
            'options' => $users,
            'optionValueRef' => 'id',
            'optionLabelRef' => 'profile,full_name',
        ])

        <!-- notes -->
        @include('components.form.textarea', [
            'group' => 'cleaning-service',
            'label' => __('Notes'),
            'name' => 'notes',
            'value' => $row->notes
        ])

    </div>
</div>

<!-- separator -->
<div class="mb-4"></div>
