<!-- fields form -->
<div class="card">
    <div class="card-body">

        <!-- property_id -->
        @include('components.form.input', [
            'group' => 'cleaning-service',
            'label' => __('Property'),
            'name' => 'property_id',
            'value' => $row->property_id,
            'hidden' => true
        ])

        <!-- date -->
        @include('components.form.input', [
            'group' => 'cleaning-service',
            'label' => __('Date'),
            'name' => 'date',
            'value' => $row->date,
            'hidden' => true
        ])

        <!-- hours -->
        @include('components.form.timepicker', [
            'group' => 'cleaning-service',
            'label' => __('Hour'),
            'name' => 'hour',
            'value' => $row->hour,
            'timeInterval' => 15,
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
            'label' => __('Finished'),
            'name' => 'is_finished',
            'value' => 1,
            'default' => $row->is_finished,
        ])

        <!-- audit -->
        @if ($row->auditedBy)
            @include('components.form.input', [
                'group' => 'cleaning-service',
                'label' => __('Audited by'),
                'name' => 'audited_by',
                'value' => $row->auditedBy->profile->full_name,
                'disabled' => true,
            ])
        @endif

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
