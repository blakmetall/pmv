<!-- fields form -->
<div class="card">
    <div class="card-body">

        <!-- property -->
        @include('components.form.input', [
            'group' => 'property-management-transaction',
            'label' => __('Property'),
            'name' => 'property_id',
            'value' => $pm->property->translate()->name,
            'disabled' => true,
        ])

        <!-- property_management_id -->
        @include('components.form.select', [
            'group' => 'property-management-transaction',
            'label' => __('Property Management'),
            'name' => 'property_management_id',
            'required' => true,
            'value' => $row->property_management_id,
            'options' => [$pm],
            'optionValueRef' => 'id',
            'optionLabelRef' => 'id',
            'hidden' => true,
            'disableDefaultOption' => true
        ])

        <!-- transaction_type_id -->
        @include('components.form.select', [
            'group' => 'property-management-transaction',
            'label' => __('Transaction'),
            'name' => 'transaction_type_id',
            'value' => $row->transaction_type_id,
            'options' => $transactionTypes,
            'optionValueRef' => 'transaction_type_id',
            'optionLabelRef' => 'transactionType:translate,name',
            'required' => true,
        ])

        <!-- amount -->
        @include('components.form.input', [
            'group' => 'property-management-transaction',
            'label' => __('Amount'),
            'name' => 'amount',
            'value' => $row->amount,
            'required' => true
        ])

        <!-- transaction_type_id -->
        @include('components.form.select', [
            'group' => 'property-management-transaction',
            'label' => __('Operation Type'),
            'name' => 'operation_type',
            'value' => $row->operation_type,
            'options' => $paymentTypes,
            'translatable' => false,
            'optionValueRef' => 'id',
            'optionLabelRef' => 'label',
            'required' => true,
            'disableDefaultOption' => true
        ])

        <!-- post_date -->
        @include('components.form.datepicker', [
            'group' => 'property-management-transaction',
            'label' => __('Date'),
            'name' => 'post_date',
            'value' => $row->post_date,
            'maxDaysLimitFromNow' => 360,
            'required' => true,
        ])

        <!-- period_start_date -->
        @include('components.form.datepicker', [
            'group' => 'property-management-transaction',
            'label' => __('Period Start Date'),
            'name' => 'period_start_date',
            'value' => $row->period_start_date,
            'maxDaysLimitFromNow' => 360,
        ])

        <!-- period_end_date -->
        @include('components.form.datepicker', [
            'group' => 'property-management-transaction',
            'label' => __('Period End Date'),
            'name' => 'period_end_date',
            'value' => $row->period_end_date,
            'maxDaysLimitFromNow' => 730,
        ])

        <!-- description -->
        @include('components.form.textarea', [
            'group' => 'property-management-transaction',
            'label' => __('Description'),
            'name' => 'description',
            'value' => $row->description,
        ])

        <!-- transaction file -->
        @include('components.form.file', [
            'group' => 'property-management-transaction',
            'label' => __('File'),
            'name' => 'transaction_file',
            'isMultiple' => false,
            'fileName' => $row->file_original_name,
            'filePath' => $row->file_path,
            'fileUrl' => $row->file_url,
            'fileExtension' => $row->file_extension,
        ])

        <?php
            /* deshabilitado checbkox de auditar en el formulario por solicitud de PMV

            <!-- do audit -->
            @include('components.form.checkbox', [
                'group' => 'property-management-transaction',
                'label' => __('Audit'),
                'name' => 'do_audit',
                'value' => 1,
                'default' => !! $row->audit_user_id,
            ])
            */
        ?>

        <!-- audit -->
        @if($row->auditedBy)
            @include('components.form.input', [
            'group' => 'property-management-transaction',
            'label' => __('Audited by'),
            'name' => '__',
            'value' => $row->auditedBy->profile->full_name,
            'disabled' => true,
            ])
        @endif

    </div>
</div>

<!-- separator -->
<div class="mb-4"></div>
