<!-- fields form -->
<div class="card">
    <div class="card-body">

        <!-- user_id -->
        @include('components.form.select', [
            'group' => 'staff-groups',
            'label' => __('User'),
            'name' => 'user_id',
            'required' => true,
            'value' => $row->user_id,
            'options' => $users,
            'optionValueRef' => 'id',
            'optionLabelRef' => 'profile,full_name',
        ])

        <!-- city_id -->
        @include('components.form.select', [
            'group' => 'staff-groups',
            'label' => __('City'),
            'name' => 'city_id',
            'required' => true,
            'value' => $row->city_id,
            'options' => $cities,
            'optionValueRef' => 'id',
            'optionLabelRef' => 'name',
        ])

        <!-- location -->
        @include('components.form.input', [
            'group' => 'staff-groups',
            'label' => __('Location'),
            'name' => 'location',
            'required' => true,
            'value' => $row->location
        ])

    </div>
</div>

<!-- separator -->
<div class="mb-4"></div>
