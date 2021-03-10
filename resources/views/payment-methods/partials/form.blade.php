@php
$disabled = (isset($disabled) && $disabled === true) ? "disabled='disabled'" : '';
@endphp

@include('partials.form-error-alert')

<fieldset {{ $disabled }}>
    <div class="card">
        <div class="card-body">
            <!-- icon -->
            @include('components.form.input', [
            'group' => 'payment-method',
            'label' => __('Icon'),
            'name' => 'icon',
            'value' => $row->icon
            ])
        </div>
    </div>

    <!-- separator -->
    <div class="mb-4"></div>

    <!-- load english fields -->
    @include('payment-methods.partials.form-translatable-fields', [
    'label' => __('ENGLISH'),
    'lang' => 'en',
    'row' => $row
    ])

    <!-- load spanish fields -->
    @include('payment-methods.partials.form-translatable-fields', [
    'label' => __('SPANISH'),
    'lang' => 'es',
    'row' => $row
    ])

</fieldset>

<!-- form actions -->
@include('components.form.actions', [
'id' => $row->id,
'disabled' => $disabled,
'edit_route' => 'payment-methods.edit',
'cancel_route' => 'payment-methods',
'delete_route' => 'payment-methods.destroy'
])
