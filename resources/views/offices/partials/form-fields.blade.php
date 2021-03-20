<!-- fields form -->
<div class="card">
    <div class="card-body">

        <!-- state_id -->
        @include('components.form.select', [
        'group' => 'office',
        'label' => __('State'),
        'name' => 'state_id',
        'required' => true,
        'value' => $row->state_id,
        'options' => $states,
        'optionValueRef' => 'id',
        'optionLabelRef' => 'name',
        ])

        <!-- name -->
        @include('components.form.input', [
        'group' => 'office',
        'label' => __('Name'),
        'name' => 'name',
        'required' => true,
        'value' => $row->name
        ])

        <!-- email -->
        @include('components.form.input', [
        'group' => 'office',
        'label' => __('Email'),
        'name' => 'email',
        'required' => true,
        'value' => $row->email
        ])

        <!-- phone local-->
        @include('components.form.input', [
        'group' => 'office',
        'label' => __('Phone Local'),
        'name' => 'phone',
        'required' => true,
        'value' => $row->phone
        ])

        <!-- phone us can -->
        @include('components.form.input', [
        'group' => 'office',
        'label' => __('Phone US & CAN'),
        'name' => 'phone_us_can',
        'value' => $row->phone_us_can
        ])

        <!-- phone free-->
        @include('components.form.input', [
        'group' => 'office',
        'label' => __('Phone Free'),
        'name' => 'phone_free',
        'value' => $row->phone_free
        ])

        <!-- address -->
        @include('components.form.textarea', [
        'group' => 'office',
        'label' => __('Address'),
        'name' => 'address',
        'required' => true,
        'value' => $row->address
        ])

        <!-- google_map -->
        @include('components.form.map', [
        'group' => 'office',
        'label' => __('Location'),
        'latitudeName' => 'gmaps_lat',
        'longitudeName' => 'gmaps_lon',
        'latitude' => $row->gmaps_lat,
        'longitude' => $row->gmaps_lon
        ])

    </div>
</div>

<!-- separator -->
<div class="mb-4"></div>
