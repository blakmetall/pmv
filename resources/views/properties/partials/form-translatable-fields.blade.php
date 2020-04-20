@php
    $label = isset($label) ? $label : '';
@endphp

<div class="card">
    <div class="card-body">

        @if ($label)
            <span class="badge badge-primary r-badge mb-4">{{ $label }}</span>
        @endif 


    </div>
</div>

<!-- separator -->
<div class="mb-4"></div>