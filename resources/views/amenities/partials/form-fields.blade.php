<!-- english -->
<div class="card">
    <div class="card-body">

        @if ($label)
            <span class="badge badge-primary r-badge mb-4">{{ $label }}</span>
        @endif 
        
        <!-- name -->
        @include('components.form.input', [
            'group' => 'amenity',
            'label' => __('Name'),
            'name' => 'name',
            'lang' => $lang,
            'required' => true,
            'value' => $amenity->{$lang}->name
        ])

    </div>
</div>

<!-- separator -->
<div class="mb-4"></div>