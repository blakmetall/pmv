 @php
    $group = isset($label) ? $label : false;
    $icon = isset($icon) ? $icon : '';
    $url = isset($url) ? $url : '#';
 @endphp

<div class="col-sm-12 col-md-2 text-md-right app-heading-buttons">
    <a href="{{ $url }}" class="btn btn-success btn-icon mr-2">
        <span class="{{ $icon }}">
            {{ $label }}
        </span>
    </a>
</div>
