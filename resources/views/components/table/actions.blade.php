@php

    $params = isset($params) && is_array($params) ? $params : [];
    $showRoute = isset($showRoute) ? $showRoute : '';
    $editRoute = isset($editRoute) ? $editRoute : '';
    $deleteRoute = isset($deleteRoute) ? $deleteRoute : '';

    $skipEdit = isset($skipEdit) ? (bool) $skipEdit : false;
    $skipDelete = isset($skipDelete) ? (bool) $skipDelete : false;

@endphp

<div class="d-block text-right">
    <a href="{{ route($showRoute, $params) }}" class="text-primary mr-2">
        <i class="nav-icon i-Eye font-weight-bold"></i>
    </a>

    @if (!$skipEdit)
        <a href="{{ route($editRoute, $params) }}" class="text-success mr-2">
            <i class="nav-icon i-Pen-2 font-weight-bold"></i>
        </a>
    @endif

    @if (!$skipDelete)
        <a 
            href="{{ route($deleteRoute, $params) }}" 
            class="text-danger mr-2 app-confirm"
            data-label="{{ __('Confirm Deletion') }}"
            >
            <i class="nav-icon i-Close-Window font-weight-bold"></i>
        </a>
    @endif
</div>
