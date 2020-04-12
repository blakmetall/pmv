@php
    $disabled = (isset($disabled) && $disabled === true) ? "disabled='disabled'" : '';
@endphp


<fieldset {{ $disabled }}>

    <!-- load english fields -->
    @include('damage-deposits.partials.form-fields', [
        'label' => __('ENGLISH'),
        'lang' => 'en',
        'row' => $row
    ])

    <!-- load spanish fields -->
    @include('damage-deposits.partials.form-fields', [
        'label' => __('SPANISH'),
        'lang' => 'es',
        'row' => $row
    ])

    <!-- load spanish fields -->
    @include('damage-deposits.partials.form-fields-prices', [
        'label' => __('PRICES'),
        'row' => $row
    ])

</fieldset>

<!-- form actions -->
@include('components.form.actions', [
    'id' => $row->id,
    'disabled' => $disabled,
    'edit_route' => 'damage-deposits.edit',
    'cancel_route' => 'damage-deposits',
    'delete_route' => 'damage-deposits.destroy',
])