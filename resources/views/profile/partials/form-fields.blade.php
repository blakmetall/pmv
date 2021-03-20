<!-- fields form -->
<div class="card">
    <div class="card-body">

        <!-- firstname -->
        @include('components.form.input', [
            'group' => 'profile',
            'label' => __('Firstname'),
            'name' => 'firstname',
            'required' => true,
            'value' => $row->firstname
        ])

        <!-- lastname -->
        @include('components.form.input', [
            'group' => 'profile',
            'label' => __('Lastname'),
            'name' => 'lastname',
            'required' => true,
            'value' => $row->lastname
        ])

        <!-- country -->
        @include('components.form.input', [
            'group' => 'profile',
            'label' => __('Country'),
            'name' => 'country',
            'required' => true,
            'value' => $row->country
        ])

        <!-- state -->
        @include('components.form.input', [
            'group' => 'profile',
            'label' => __('State'),
            'name' => 'state',
            'required' => true,
            'value' => $row->state
        ])

        <!-- city -->
        @include('components.form.input', [
            'group' => 'profile',
            'label' => __('City'),
            'name' => 'city',
            'required' => true,
            'value' => $row->city
        ])

        <!-- street -->
        @include('components.form.input', [
            'group' => 'profile',
            'label' => __('Street'),
            'name' => 'street',
            'required' => true,
            'value' => $row->street
        ])

        <!-- zip -->
        @include('components.form.input', [
            'group' => 'profile',
            'label' => __('Zip'),
            'name' => 'zip',
            'required' => true,
            'value' => $row->zip
        ])

        <!-- phone -->
        @include('components.form.input', [
            'group' => 'profile',
            'label' => __('Phone'),
            'name' => 'phone',
            'value' => $row->phone
        ])

        <!-- mobile -->
        @include('components.form.input', [
            'group' => 'profile',
            'label' => __('Mobile'),
            'name' => 'mobile',
            'value' => $row->mobile
        ])

    </div>
</div>

<!-- separator -->
<div class="mb-4"></div>