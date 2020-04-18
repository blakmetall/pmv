<!-- fields form -->
<div class="card">
    <div class="card-body">

        <!-- email -->
        @include('components.form.input', [
            'group' => 'account',
            'label' => __('Email'),
            'name' => 'email',
            'required' => true,
            'value' => $row->email
        ])

        <!-- password -->
        @include('components.form.input', [
            'group' => 'account',
            'type' => 'password',
            'label' => __('Password'),
            'name' => 'password',
            'required' => true,
            'value' => ''
        ])

        <!-- password confirmation -->
        @include('components.form.input', [
            'group' => 'account',
            'type' => 'password',
            'label' => __('Confirm Password'),
            'name' => 'password_confirmation',
            'required' => true,
            'value' => ''
        ])

    </div>
</div>

<!-- separator -->
<div class="mb-4"></div>