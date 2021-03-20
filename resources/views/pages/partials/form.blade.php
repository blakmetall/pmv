@php
$disabled = (isset($disabled) && $disabled === true) ? "disabled='disabled'" : '';
@endphp

@include('partials.form-error-alert')

<fieldset {{ $disabled }}>
    <!-- separator -->
    <div class="mb-4"></div>

    <!-- load english fields -->
    @include('pages.partials.form-translatable-fields', [
    'label' => __('ENGLISH'),
    'lang' => 'en',
    'row' => $row
    ])

    <!-- load spanish fields -->
    @include('pages.partials.form-translatable-fields', [
    'label' => __('SPANISH'),
    'lang' => 'es',
    'row' => $row
    ])

</fieldset>

<!-- form actions -->
@include('components.form.actions', [
'id' => $row->id,
'disabled' => $disabled,
'edit_route' => 'pages.edit',
'cancel_route' => 'pages',
'delete_route' => 'pages.destroy',
'skipDelete' => true
])
