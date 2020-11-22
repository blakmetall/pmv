<!-- fields form -->
<div class="card">
    <div class="card-body">
        <span class="badge badge-primary r-badge mb-4">{{ __('INFORMATION') }}</span>

        <!-- property_id -->
        @include('components.form.input', [
            'group' => 'booking',
            'label' => __('Property'),
            'name' => 'property_id',
            'hidden' => 'true',
            'value' => $booking->property->id
        ])
        
        <!-- booking_id -->
        @include('components.form.input', [
            'group' => 'payment',
            'label' => __('Booking'),
            'name' => 'booking_id',
            'hidden' => 'true',
            'required' => true,
            'value' => $booking->id
        ])

        <!-- transaction_source_id -->
        @include('components.form.select', [
            'group' => 'payment',
            'label' => __('Transaction Source'),
            'name' => 'transaction_source_id',
            'required' => true,
            'value' => $row->transaction_source_id,
            'options' => $transactionSources,
            'optionValueRef' => 'transaction_source_id',
            'optionLabelRef' => 'name',
        ])

        <!-- amount -->
        @include('components.form.input', [
            'group' => 'payment',
            'label' => __('Amount'),
            'name' => 'amount',
            'required' => true,
            'value' => $row->amount,
            'instruction' => __('Enter the amount of the payment received.')
        ])

        <!-- exchange_rate -->
        @include('components.form.input', [
            'group' => 'payment',
            'label' => __('Exchange Rate'),
            'name' => 'exchange_rate',
            'required' => true,
            'value' => $row->exchange_rate,
            'instruction' => __('Enter the exchange rate published on the day when the payment was received.')
        ])

        <!-- damage_insurance -->
        @include('components.form.input', [
            'group' => 'payment',
            'label' => __('Damage Insurance'),
            'name' => 'damage_insurance',
            'required' => true,
            'value' => $row->damage_insurance,
            'instruction' => __('Enter the damage insurance or security deposit amount.')
        ])

        <!-- comission -->
        @include('components.form.input', [
            'group' => 'payment',
            'label' => __('Comission'),
            'name' => 'comission',
            'required' => true,
            'value' => $row->comission,
            'instruction' => __('Enter the commission percentage received for this booking.')
        ])

        <!-- bank_fees -->
        @include('components.form.input', [
            'group' => 'payment',
            'label' => __('Bank Fees'),
            'name' => 'bank_fees',
            'required' => true,
            'value' => $row->bank_fees,
            'instruction' => __('Enter the amount for the total fees that were deducted on this payment, ie: bank or paypal commissions.')
        ])

        <!-- net_comission -->
        @include('components.form.input', [
            'group' => 'payment',
            'label' => __('Net Comission'),
            'name' => 'net_comission',
            'value' => $row->net_comission,
            'instruction' => __('Enter the amount of the commission that Palmera will received for this booking.')
        ])

        <!-- post_date -->
        @include('components.form.datepicker', [
            'group' => 'payment',
            'label' => __('Post Date'),
            'name' => 'post_date',
            'required' => true,
            'value' => $row->post_date,
            'instruction' => __('Select the date the payment was received.')
        ])

        <!-- is_paid -->
        @include('components.form.checkbox', [
            'group' => 'payment',
            'label' => __('Paid'),
            'name' => 'is_paid',
            'value' => 1,
            'default' => $row->is_paid,
        ])

        <!-- comments -->
        @include('components.form.textarea', [
            'group' => 'payment',
            'label' => __('Comments'),
            'name' => 'comments',
            'value' => $row->comments
        ])

    </div>
</div>

<!-- separator -->
<div class="mb-4"></div>

<div class="card">
    <div class="card-body">
        <span class="badge badge-primary r-badge mb-4">{{ __('PM Credit') }}</span>

        <!-- credit_amount -->
        @include('components.form.input', [
            'group' => 'credit',
            'label' => __('Credit Amount'),
            'name' => 'credit_amount',
            'value' => $row->credit_amount,
            'instruction' => __('Enter the amount in MXN pesos to credit the property.')
        ])

        <!-- credit_notes -->
        @include('components.form.textarea', [
            'group' => 'credit',
            'label' => __('Notes'),
            'name' => 'credit_notes',
            'value' => __('Booking') .' #'.$booking->id
        ])
    </div>
</div>

<!-- separator -->
<div class="mb-4"></div>

<div class="card">
    <div class="card-body">
        <span class="badge badge-primary r-badge mb-4">{{ __('Email Notifications') }}</span>

        <!-- guest_notification -->
        @include('components.form.checkbox', [
            'group' => 'notification',
            'label' => __('Guest'),
            'name' => 'guest',
        ])

        <!-- office_notification -->
        @include('components.form.checkbox', [
            'group' => 'notification',
            'label' => __('Office'),
            'name' => 'office',
        ])

        <!-- concierge_notification -->
        @include('components.form.checkbox', [
            'group' => 'notification',
            'label' => __('Concierge'),
            'name' => 'concierge',
        ])

        <!-- home_owner_notification -->
        @include('components.form.checkbox', [
            'group' => 'notification',
            'label' => __('Home Owner'),
            'name' => 'home_owner',
        ])
    </div>
</div>

<!-- separator -->
<div class="mb-4"></div>