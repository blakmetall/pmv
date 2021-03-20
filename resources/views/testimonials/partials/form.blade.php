@php
$disabled = (isset($disabled) && $disabled === true) ? "disabled='disabled'" : '';
@endphp

@include('partials.form-error-alert')

<fieldset {{ $disabled }}>
    <!-- separator -->
    <div class="mb-4"></div>

    <!-- load english fields -->
    @include('testimonials.partials.form-translatable-fields', [
    'label' => __('ENGLISH'),
    'lang' => 'en',
    'row' => $row
    ])

    <!-- load spanish fields -->
    @include('testimonials.partials.form-translatable-fields', [
    'label' => __('SPANISH'),
    'lang' => 'es',
    'row' => $row
    ])

</fieldset>

<!-- form actions -->
@include('components.form.actions', [
'id' => $row->id,
'disabled' => $disabled,
'edit_route' => 'testimonials.edit',
'cancel_route' => 'testimonials',
'delete_route' => 'testimonials.destroy',
])
