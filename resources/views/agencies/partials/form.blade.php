@php
$disabled = (isset($disabled) && $disabled === true) ? "disabled='disabled'" : '';
@endphp

@include('partials.form-error-alert')

<fieldset {{ $disabled }}>
    <div class="card">
        <div class="card-body">
            <!-- image -->
            @include('components.form.file', [
            'group' => 'agency',
            'label' => __('Images'),
            'name' => 'photo',
            'required' => true,
            'isMultiple' => false,
            'fileName' => $row->file_original_name,
            'filePath' => $row->file_path,
            'fileUrl' => $row->file_url,
            'fileExtension' => $row->file_extension,
            ])
        </div>
    </div>

    <!-- separator -->
    <div class="mb-4"></div>

    <!-- load english fields -->
    @include('agencies.partials.form-translatable-fields', [
    'label' => __('ENGLISH'),
    'lang' => 'en',
    'row' => $row
    ])

    <!-- load spanish fields -->
    @include('agencies.partials.form-translatable-fields', [
    'label' => __('SPANISH'),
    'lang' => 'es',
    'row' => $row
    ])

</fieldset>

<!-- form actions -->
@include('components.form.actions', [
'id' => $row->id,
'disabled' => $disabled,
'edit_route' => 'agencies.edit',
'cancel_route' => 'agencies',
'delete_route' => 'agencies.destroy'
])
