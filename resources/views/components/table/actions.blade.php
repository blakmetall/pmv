@php
    $params = isset($params) && is_array($params) ? $params : [];
    $showRoute = isset($showRoute) ? $showRoute : '';
    $editRoute = isset($editRoute) ? $editRoute : '';
    $deleteRoute = isset($deleteRoute) ? $deleteRoute : '';
@endphp


<a href="{{ route($showRoute, $params) }}" class="text-primary mr-2">
    <i class="nav-icon i-Eye font-weight-bold"></i>
</a>

<a href="{{ route($editRoute, $params) }}" class="text-success mr-2">
    <i class="nav-icon i-Pen-2 font-weight-bold"></i>
</a>

<a href="{{ route($deleteRoute, $params) }}" class="text-danger mr-2">
    <i class="nav-icon i-Close-Window font-weight-bold"></i>
</a>