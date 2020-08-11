<!-- fields form -->
<div class="card">
    <div class="card-body">

        <!-- name -->
        @include('components.form.input', [
            'group' => 'building',
            'label' => __('Name'),
            'name' => 'name',
            'required' => true,
            'value' => $row->name
        ])

        <!-- description -->
        @include('components.form.textarea', [
            'group' => 'building',
            'label' => __('Description'),
            'name' => 'address',
            'value' => $row->description
        ])

    </div>
</div>

<!-- separator -->
<div class="mb-4"></div>
