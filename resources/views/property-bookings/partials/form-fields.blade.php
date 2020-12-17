@php
$modalID = 'calendar-availability-' . strtotime('now') . rand(1,99999);
$currentYear = (isset($_GET['year'])?$_GET['year']:'');
@endphp
@if ($row->firstname)
    @php
    $total = $row->total;
    $payments = $row->payments;
    $reduced = 0;
    foreach ($payments as $payment) {
    $reduced += $payment->amount;
    }
    $balance = $total - $reduced;

    @endphp
    <div class="card">
        <div class="card-body">
            <span class="badge badge-primary r-badge mb-4">{{ __('BALANCE') }}</span>

            <div class="form-group row" style="">
                <label class="col-sm-2 col-form-label">
                    {{ __('Insurance / Deposit') }}
                </label>

                <div class="col-sm-10">
                    {{ priceFormat($row->subtotal_damage_deposit) }} USD
                </div>
            </div>
            <div class="form-group row" style="">
                <label class="col-sm-2 col-form-label">
                    {{ __('Total Stay') }}
                </label>

                <div class="col-sm-10">
                    {{ priceFormat($row->subtotal_nights) }} USD
                </div>
            </div>
            <div class="form-group row" style="">
                <label class="col-sm-2 col-form-label">
                    {{ __('Total Booking') }}
                </label>

                <div class="col-sm-10">
                    {{ priceFormat($row->total) }} USD
                </div>
            </div>
            <div class="form-group row" style="">
                <label class="col-sm-2 col-form-label">
                    {{ __('Balance due') }}
                </label>

                <div class="col-sm-10" style="color:red">
                    {{ priceFormat($balance) }} USD
                </div>
            </div>
        </div>
    </div>
@endif

<!-- separator -->
<div class="mb-4"></div>

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

        <!-- email -->
        @include('components.form.input', [
        'group' => 'booking',
        'label' => __('Email'),
        'name' => 'email',
        'required' => true,
        'value' => $row->email,
        ])

        @if (!isRole('owner'))
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
        @endif

    </div>
</div>

<!-- separator -->
<div class="mb-4"></div>
@include('property-bookings.partials.modal-calendar')

<div class="card">
    <div class="card-body">
        <span class="badge badge-primary r-badge mb-4">{{ __('ARRIVAL') }}</span>
        <a href="#" data-toggle="modal" data-source="{{ $property->id }}" data-year="{{ $currentYear }}"
            data-target="#{{ $modalID }}" class="badge badge-primary ml-2 r-badge" style="padding: 5px; float: right">
            <i class="nav-icon i-Calendar-4 font-weight-bold"></i> {{ __('VIEW AVAILABILITY') }}
        </a>

        @if (!isRole('owner'))
            <!-- arrival_airline -->
            @include('components.form.input', [
            'group' => 'booking',
            'label' => __('Arrival Airline'),
            'name' => 'arrival_airline',
            'value' => $row->arrival_airline
            ])
        @endif

        <!-- arrival_date -->
        @include('components.form.datepicker', [
        'group' => 'booking',
        'label' => __('Arrival Date'),
        'name' => 'arrival_date',
        'required' => true,
        'value' => $row->arrival_date,
        'maxDaysLimitFromNow' => 4000,
        ])

        @if (!isRole('owner'))
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
            'label' => __('Check-in'),
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
        @endif
    </div>
</div>

<!-- separator -->
<div class="mb-4"></div>

<div class="card">
    <div class="card-body">
        <span class="badge badge-primary r-badge mb-4">{{ __('DEPARTURE') }}</span>
        <a href="#" data-toggle="modal" data-source="{{ $property->id }}" data-year="{{ $currentYear }}"
            data-target="#{{ $modalID }}" class="badge badge-primary ml-2 r-badge" style="padding: 5px; float: right">
            <i class="nav-icon i-Calendar-4 font-weight-bold"></i> {{ __('VIEW AVAILABILITY') }}
        </a>

        @if (!isRole('owner'))
            <!-- departure_airline -->
            @include('components.form.input', [
            'group' => 'booking',
            'label' => __('Departure Airline'),
            'name' => 'departure_airline',
            'value' => $row->departure_airline
            ])
        @endif

        <!-- departure_date -->
        @include('components.form.datepicker', [
        'group' => 'booking',
        'label' => __('Departure Date'),
        'name' => 'departure_date',
        'required' => true,
        'value' => $row->departure_date,
        'maxDaysLimitFromNow' => 4000,
        ])

        @if (!isRole('owner'))
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
            'label' => __('Check-out'),
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
        @endif
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
        'label' => __('Children'),
        'name' => 'kids',
        'value' => $row->kids,
        ])
        <!-- register_by -->
        @include('components.form.select-simple', [
        'group' => 'booking',
        'label' => __('Register By'),
        'name' => 'register_by',
        'value' => $row->register_by,
        'options' => $registers,
        'optionValueRef' => 'name',
        ])
        @if (!isRole('owner'))
            <!-- damage_deposit_id -->
            @include('components.form.select', [
            'group' => 'booking',
            'label' => __('Damage Deposit'),
            'name' => 'damage_deposit_id',
            'value' => $row->damage_deposit_id,
            'options' => $damageDeposits,
            'optionValueRef' => 'damage_deposit_id',
            'optionLabelRef' => 'description',
            ])

            @if ($row->is_confirmed)
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
        @endif
    </div>
</div>

<!-- separator -->
<div class="mb-4"></div>

<div class="card">
    <div class="card-body">
        <span class="badge badge-primary r-badge mb-4">{{ __('EMAIL NOTIFICATIONS') }}</span>

        <!-- guest_notification -->
        @include('components.form.checkbox', [
        'group' => 'notification',
        'label' => __('Guest'),
        'name' => 'guest',
        'value' => 1,
        ])

        <!-- office_notification -->
        @include('components.form.checkbox', [
        'group' => 'notification',
        'label' => __('Office'),
        'name' => 'office',
        'value' => 1,
        ])

        <!-- concierge_notification -->
        @include('components.form.checkbox', [
        'group' => 'notification',
        'label' => __('Concierge'),
        'name' => 'concierge',
        'value' => 1,
        ])

        <!-- home_owner_notification -->
        @include('components.form.checkbox', [
        'group' => 'notification',
        'label' => __('Home Owner'),
        'name' => 'home_owner',
        'value' => 1,
        ])
    </div>
</div>

<!-- separator -->
<div class="mb-4"></div>
