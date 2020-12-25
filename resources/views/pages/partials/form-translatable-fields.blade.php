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
        'group' => 'page',
        'label' => __('Title'),
        'name' => 'title',
        'lang' => $lang,
        'required' => true,
        'value' => $row->{$lang}->title
        ])

        <!-- slug -->
        @include('components.form.input', [
        'group' => 'page',
        'label' => __('Slug'),
        'name' => 'slug',
        'lang' => $lang,
        'value' => $row->{$lang}->slug
        ])

        <!-- description -->
        @include('components.form.textarea', [
        'group' => 'page',
        'label' => __('Description'),
        'name' => 'description',
        'lang' => $lang,
        'value' => $row->{$lang}->description,
        ])

        <!-- left_col -->
        @include('components.form.textarea', [
        'group' => 'page',
        'label' => __('Left Col'),
        'name' => 'left_col',
        'lang' => $lang,
        'value' => $row->{$lang}->left_col,
        ])

        <!-- right_col -->
        @include('components.form.textarea', [
        'group' => 'page',
        'label' => __('Right Col'),
        'name' => 'right_col',
        'lang' => $lang,
        'value' => $row->{$lang}->right_col,
        ])

        <!-- mid_description -->
        @include('components.form.textarea', [
        'group' => 'page',
        'label' => __('Mid Description'),
        'name' => 'mid_description',
        'lang' => $lang,
        'value' => $row->{$lang}->mid_description,
        ])

        <!-- bot_description -->
        @include('components.form.textarea', [
        'group' => 'page',
        'label' => __('Bot Description'),
        'name' => 'bot_description',
        'lang' => $lang,
        'value' => $row->{$lang}->bot_description,
        ])

    </div>
</div>

<!-- separator -->
<div class="mb-4"></div>

@section('bottom-js')

    {{-- ckeditor js --}}
    <script src="{{ asset('assets/js/vendor/ckeditor/ckeditor.js') }}"></script>

@endsection
