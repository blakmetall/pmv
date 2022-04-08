<!-- property_id -->
<div class="app-pm-property-select-wrapper"
    data-generate-booking-url="{{ route('property-bookings.generate-booking-url') }}">
    <div class="all-dates">
        {{ __('Invalid Dates') }}: <span></span>
    </div>
    <div class="some-dates">
        {{ __('Some Dates') }}: <span></span>
    </div>

    <form action="{{ route('property-bookings.check-availability') }}" id="form-check-availability" method="post">
        <!-- arrival_date -->
        @include('components.form.datepicker', [
            'group' => 'booking',
            'label' => __('Arrival Date'),
            'name' => 'arrival_date',
            'required' => true,
            'maxDaysLimitFromNow' => 3600,
        ])

        <!-- departure_date -->
        @include('components.form.datepicker', [
            'group' => 'booking',
            'label' => __('Departure Date'),
            'name' => 'departure_date',
            'required' => true,
            'maxDaysLimitFromNow' => 3600,
        ])

        @include('components.form.select', [
            'group' => 'properties',
            'label' => __('Property'),
            'name' => 'property_id',
            'required' => true,
            'value' => '',
            'options' => $properties,
            'optionValueRef' => 'property_id',
            'optionLabelRef' => 'name',
        ])

        <button type="submit" class="btn btn-primary m-1">
            {{ __('Check Availability') }}
        </button>
    </form>
    
    <div id="details-property"></div>
</div>
