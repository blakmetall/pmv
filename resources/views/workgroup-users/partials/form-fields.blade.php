<!-- fields form -->
<div class="card">
    <div class="card-body">

        <!-- workgroup_id -->
        @include('components.form.select', [
            'group' => 'workgroup-user',
            'label' => __('Workgroup'),
            'name' => 'workgroup_id',
            'required' => true,
            'value' => $row->workgroup_id,
            'options' => [$workgroup],
            'optionValueRef' => 'id',
            'optionLabelRef' => 'id',
            'hidden' => true,
            'disableDefaultOption' => true
        ]) 

        <!-- user_id -->
        @include('components.form.select', [
            'group' => 'workgroup-user',
            'label' => __('User'),
            'name' => 'user_id',
            'required' => true,
            'value' => $row->user_id,
            'options' => $users,
            'optionValueRef' => 'id',
            'optionLabelRef' => 'profile,full_name',
        ])

    </div>
</div>

<!-- separator -->
<div class="mb-4"></div>
