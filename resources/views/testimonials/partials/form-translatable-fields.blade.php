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
        'group' => 'testimonial',
        'label' => __('Title'),
        'name' => 'title',
        'lang' => $lang,
        'required' => true,
        'value' => $row->{$lang}->title
        ])

        <!-- description -->
        @include('components.form.textarea', [
        'group' => 'testimonial',
        'label' => __('Description'),
        'name' => 'description',
        'lang' => $lang,
        'required' => true,
        'value' => $row->{$lang}->description,
        ])

        <!-- location -->
        @include('components.form.input', [
        'group' => 'testimonial',
        'label' => __('Location'),
        'name' => 'location',
        'lang' => $lang,
        'value' => $row->{$lang}->location
        ])

        <!-- occupation -->
        @include('components.form.input', [
        'group' => 'testimonial',
        'label' => __('Occupation'),
        'name' => 'occupation',
        'lang' => $lang,
        'value' => $row->{$lang}->occupation
        ])

    </div>
</div>

<!-- separator -->
<div class="mb-4"></div>

@section('bottom-js')

    {{-- ckeditor js --}}
    <script src="{{ asset('assets/js/vendor/ckeditor/ckeditor.js') }}"></script>

@endsection
