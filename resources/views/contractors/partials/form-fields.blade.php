<!-- fields form -->
<div class="card">
    <div class="card-body">

        <!-- city_id -->
        @include('components.form.select', [
            'group' => 'contractor',
            'label' => __('City'),
            'name' => 'city_id',
            'required' => true,
            'value' => $row->city_id,
            'options' => $cities,
            'optionValueRef' => 'id',
            'optionLabelRef' => 'name',
        ])

        <!-- company -->
        @include('components.form.input', [
            'group' => 'contractor',
            'label' => __('Company'),
            'name' => 'company',
            'required' => true,
            'value' => $row->company
        ])

        <!-- contact_name -->
        @include('components.form.input', [
            'group' => 'contractor',
            'label' => __('Contact'),
            'name' => 'contact_name',
            'required' => true,
            'value' => $row->contact_name
        ])

        <!-- phone -->
        @include('components.form.input', [
            'group' => 'contractor',
            'label' => __('Phone'),
            'name' => 'phone',
            'value' => $row->phone
        ])

        <!-- mobile -->
        @include('components.form.input', [
            'group' => 'contractor',
            'label' => __('Mobile'),
            'name' => 'mobile',
            'value' => $row->mobile
        ])

        <!-- email -->
        @include('components.form.input', [
            'group' => 'contractor',
            'label' => __('Email'),
            'name' => 'email',
            'value' => $row->email,
            'type' => 'email',
        ])

        <!-- address -->
        @include('components.form.textarea', [
            'group' => 'contractor',
            'label' => __('Address'),
            'name' => 'address',
            'value' => $row->address,
        ])

    </div>
</div>

<!-- separator -->
<div class="mb-4"></div>
