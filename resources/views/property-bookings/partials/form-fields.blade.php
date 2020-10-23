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
            'value' => $property->id
        ])

        <!-- firstname -->
        @include('components.form.input', [
            'group' => 'booking',
            'label' => __('Firstname'),
            'name' => 'firstname',
            'required' => true,
            'value' => $row->firstname
        ])

        <!-- lastname -->
        @include('components.form.input', [
            'group' => 'booking',
            'label' => __('Lastname'),
            'name' => 'lastname',
            'required' => true,
            'value' => $row->lastname,
        ])

        <!-- country -->
        @include('components.form.input', [
            'group' => 'booking',
            'label' => __('Country'),
            'name' => 'country',
            'value' => $row->country,
        ])

        <!-- state -->
        @include('components.form.input', [
            'group' => 'booking',
            'label' => __('State'),
            'name' => 'state',
            'value' => $row->state,
        ])

        <!-- city -->
        @include('components.form.input', [
            'group' => 'booking',
            'label' => __('City'),
            'name' => 'city',
            'value' => $row->city,
        ])

        <!-- street -->
        @include('components.form.input', [
            'group' => 'booking',
            'label' => __('Street'),
            'name' => 'street',
            'value' => $row->street,
        ])

        <!-- zip -->
        @include('components.form.input', [
            'group' => 'booking',
            'label' => __('Zip'),
            'name' => 'zip',
            'value' => $row->zip,
        ])

        <!-- phone -->
        @include('components.form.input', [
            'group' => 'booking',
            'label' => __('Phone'),
            'name' => 'phone',
            'value' => $row->phone
        ])        

        <!-- mobile -->
        @include('components.form.input', [
            'group' => 'booking',
            'label' => __('Mobile'),
            'name' => 'mobile',
            'value' => $row->mobile
        ])

        <!-- comments -->
        @include('components.form.textarea', [
            'group' => 'booking',
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
        <span class="badge badge-primary r-badge mb-4">{{ __('ARRIVAL') }}</span>

        <!-- arrival_airline -->
        @include('components.form.input', [
            'group' => 'booking',
            'label' => __('Arrival Airline'),
            'name' => 'arrival_airline',
            'value' => $row->arrival_airline
        ])

        <!-- arrival_date -->
        @include('components.form.datepicker', [
            'group' => 'booking',
            'label' => __('Arrival Date'),
            'name' => 'arrival_date',
            'required' => true,
            'value' => $row->arrival_date,
            'maxDaysLimitFromNow' => 4000,
        ])

        <!-- arrival_flight_number -->
        @include('components.form.input', [
            'group' => 'booking',
            'label' => __('Arrival Flight Number'),
            'name' => 'arrival_flight_number',
            'value' => $row->arrival_flight_number
        ])

        <!-- arrival_time -->
        @include('components.form.input', [
            'group' => 'booking',
            'label' => __('Arrival Time'),
            'name' => 'arrival_time',
            'value' => $row->arrival_time
        ])

        <!-- check_in -->
        @include('components.form.input', [
            'group' => 'booking',
            'label' => __('Check In'),
            'name' => 'check_in',
            'value' => $row->check_in
        ])

        <!-- arrival_transportation -->
        @include('components.form.checkbox', [
            'group' => 'booking',
            'label' => __('Transportation'),
            'name' => 'arrival_transportation',
            'value' => 1,
            'default' => $row->arrival_transportation,
        ])
    </div>
</div>

<!-- separator -->
<div class="mb-4"></div>

<div class="card">
    <div class="card-body">
        <span class="badge badge-primary r-badge mb-4">{{ __('DEPARTURE') }}</span>

        <!-- departure_airline -->
        @include('components.form.input', [
            'group' => 'booking',
            'label' => __('Departure Airline'),
            'name' => 'departure_airline',
            'value' => $row->departure_airline
        ])

        <!-- departure_date -->
        @include('components.form.datepicker', [
            'group' => 'booking',
            'label' => __('Departure Date'),
            'name' => 'departure_date',
            'required' => true,
            'value' => $row->departure_date,
            'maxDaysLimitFromNow' => 4000,
        ])

        <!-- departure_flight_number -->
        @include('components.form.input', [
            'group' => 'booking',
            'label' => __('Departure Flight Number'),
            'name' => 'departure_flight_number',
            'value' => $row->departure_flight_number
        ])

        <!-- departure_time -->
        @include('components.form.input', [
            'group' => 'booking',
            'label' => __('Departure Time'),
            'name' => 'departure_time',
            'value' => $row->departure_time
        ])

        <!-- check_out -->
        @include('components.form.input', [
            'group' => 'booking',
            'label' => __('Check Out'),
            'name' => 'check_out',
            'value' => $row->check_out
        ])

        <!-- departure_transportation -->
        @include('components.form.checkbox', [
            'group' => 'booking',
            'label' => __('Transportation'),
            'name' => 'departure_transportation',
            'value' => 1,
            'default' => $row->departure_transportation,
        ])
    </div>
</div>

<!-- separator -->
<div class="mb-4"></div>

<div class="card">
    <div class="card-body">
        <span class="badge badge-primary r-badge mb-4">{{ __('BOOKING') }}</span>

        <!-- adults -->
        @include('components.form.input', [
            'group' => 'booking', 
            'label' => __('Adults'),
            'name' => 'adults',
            'required' => true,
            'value' => $row->adults,
        ])

        <!-- kids -->
        @include('components.form.input', [
            'group' => 'booking',
            'label' => __('Kids'),
            'name' => 'kids',
            'value' => $row->kids,
        ])

        <!-- damage_deposit_id -->
        @include('components.form.select', [
            'group' => 'booking',
            'label' => __('Damage Deposit'),
            'name' => 'damage_deposit_id',
            'required' => true,
            'value' => $row->damage_deposit_id,
            'options' => $damageDeposits,
            'optionValueRef' => 'damage_deposit_id',
            'optionLabelRef' => 'description',
        ])

        <!-- is_confirmed -->
        @include('components.form.checkbox', [
            'group' => 'booking',
            'label' => __('Confirmed'),
            'name' => 'is_confirmed',
            'value' => 1,
            'default' => $row->is_confirmed,
        ])

        @if($row->is_confirmed)
            <!-- is_refundable -->
            @include('components.form.checkbox', [
                'group' => 'booking',
                'label' => __('Refundable'),
                'name' => 'is_refundable',
                'value' => 1,
                'default' => $row->is_refundable,
            ])

            <!-- is_cancelled -->
            @include('components.form.checkbox', [
                'group' => 'booking',
                'label' => __('Cancelled'),
                'name' => 'is_cancelled',
                'value' => 1,
                'default' => $row->is_cancelled,
            ])

            <!-- is_paid -->
            @include('components.form.checkbox', [
                'group' => 'booking',
                'label' => __('Paid'),
                'name' => 'is_paid',
                'value' => 1,
                'default' => $row->is_paid,
            ])

            <!-- is_finished -->
            @include('components.form.checkbox', [
                'group' => 'booking',
                'label' => __('Finished'),
                'name' => 'is_finished',
                'value' => 1,
                'default' => $row->is_finished,
            ])
        @endif

    </div>
</div>

<!-- separator -->
<div class="mb-4"></div>