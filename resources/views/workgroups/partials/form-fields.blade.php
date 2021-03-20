@php
    $label = isset($label) ? $label : '';
@endphp

<div class="card">
    <div class="card-body app-form-fields-container">       

        @include('components.form.select', [
            'group' => 'workgroup',
            'label' => __('City'),
            'name' => 'city_id',
            'required' => true,
            'value' => $workgroup->city_id,
            'options' => $cities,
            'optionValueRef' => 'id',
            'optionLabelRef' => 'name',
        ])

    </div>
</div>

<!-- separator -->
<div class="mb-4"></div>