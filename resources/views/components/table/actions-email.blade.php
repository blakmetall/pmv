@php

    $params = isset($params) && is_array($params) ? $params : [];
    $emailRoute = isset($emailRoute) ? $emailRoute : '';
    $showRoute = isset($showRoute) ? $showRoute : '';
    $editRoute = isset($editRoute) ? $editRoute : '';
    $deleteRoute = isset($deleteRoute) ? $deleteRoute : '';

    $skipEmail = isset($skipEmail) ? (bool) $skipEmail : false;
    $skipShow = isset($skipShow) ? (bool) $skipShow : false;
    $skipEdit = isset($skipEdit) ? (bool) $skipEdit : false;
    $skipDelete = isset($skipDelete) ? (bool) $skipDelete : false;

@endphp

<div class="d-block text-right">
    @if (!$skipEmail)
        <a href="{{ route($emailRoute, $params) }}" class="text-primary mr-2" title="<?=__('Send reset password email')?>">
            <img src="/images/email.svg" alt="" style="width: 17px; position: relative; top: -3px;">
        </a>
    @endif

    @if (!$skipShow)
        <a href="{{ route($showRoute, $params) }}" class="text-primary mr-2">
            <i class="nav-icon i-Eye font-weight-bold"></i>
        </a>
    @endif

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
