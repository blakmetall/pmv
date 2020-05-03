<!-- fields form -->
<div class="card">
    <div class="card-body">

        <!-- firstname -->
        @include('components.form.input', [
            'group' => 'cleaning-staff',
            'label' => __('Firstname'),
            'name' => 'firstname',
            'required' => true,
            'value' => $row->firstname
        ])

        <!-- lastname -->
        @include('components.form.input', [
            'group' => 'cleaning-staff',
            'label' => __('Lastname'),
            'name' => 'lastname',
            'required' => true,
            'value' => $row->lastname
        ])

    </div>
</div>

<!-- separator -->
<div class="mb-4"></div>
