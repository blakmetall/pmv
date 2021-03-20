<!-- fields form -->
<div class="card">
    <div class="card-body">
        <span class="badge badge-primary r-badge mb-4">{{ __('GUEST') }}</span>

        <!-- property_id -->
        @include('components.form.input', [
            'group' => 'notification',
            'label' => __('Property'),
            'name' => 'property_id',
            'hidden' => 'true',
            'value' => $booking->property->id
        ])
        
        <!-- booking_id -->
        @include('components.form.input', [
            'group' => 'notification',
            'label' => __('Booking'),
            'name' => 'booking_id',
            'hidden' => 'true',
            'required' => true,
            'value' => $booking->id
        ])

        <!-- guests_recipients -->
        @include('components.form.input', [
            'group' => 'notification',
            'label' => __('Recipients'),
            'name'  => 'guests_recipients',
            'value' => $booking->email,
            'instruction' => __('Separate email addresses with a comma.')
        ])

        <!-- guest_email_content -->
        @include('components.form.guest-email', [
            'group' => 'notification',
            'label' => __('Email Content'),
            'name' => 'guest_email_content',
            'rows' => '20',
            'booking' => $booking
        ])

        <span class="badge badge-primary r-badge mb-4">{{ __('OWNER') }}</span>

        <!-- owners_recipients -->
        @include('components.form.input', [
            'group' => 'notification',
            'label' => __('Recipients'),
            'name'  => 'owners_recipients',
            'value' => $owners,
            'instruction' => __('Separate email addresses with a comma.')
        ])

        <!-- owners_email_content -->
        @include('components.form.owner-email', [
            'group' => 'notification',
            'label' => __('Email Content'),
            'name' => 'owners_email_content',
            'rows' => '20',
            'booking' => $booking
        ])
        
    </div>
</div>

<!-- separator -->
<div class="mb-4"></div>