@php
$label = isset($label) ? $label : '';
@endphp

<div class="card">
    <div class="card-body">

        @if ($label)
            <span class="badge badge-primary r-badge mb-4">{{ $label }}</span>
        @endif

        <!-- title -->
        @include('components.form.input', [
        'group' => 'payment-method',
        'label' => __('Title'),
        'name' => 'title',
        'lang' => $lang,
        'required' => true,
        'value' => $row->{$lang}->title
        ])

        <!-- description -->
        @include('components.form.textarea', [
        'group' => 'payment-method',
        'label' => __('Description'),
        'name' => 'description',
        'lang' => $lang,
        'value' => $row->{$lang}->description,
        ])

    </div>
</div>

<!-- separator -->
<div class="mb-4"></div>

@section('bottom-js')

    {{-- ckeditor js --}}
    <script src="{{ asset('assets/js/vendor/ckeditor/ckeditor.js') }}"></script>

@endsection
