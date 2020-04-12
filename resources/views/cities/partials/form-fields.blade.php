<div class="card">
    <div class="card-body">       

        <!-- state_id -->
        @include('components.form.select', [
            'group' => 'city',
            'label' => __('State'),
            'name' => 'state_id',
            'required' => true,
            'value' => $city->state_id,
            'options' => $states,
            'optionValueRef' => 'id',
            'optionLabelRef' => 'name',
        ])

        <!-- name -->
        @include('components.form.input', [
            'group' => 'city',
            'label' => __('City'),
            'name' => 'name',
            'required' => true,
            'value' => $city->name
        ])

    </div>
</div>

<!-- separator -->
<div class="mb-4"></div>