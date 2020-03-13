@php 
    $should_render = isset($menu) && is_array($menu);
@endphp

@if ($should_render)
    <div class="list-group">
        @foreach ($menu as $option)
            <a href="{{ $option['url'] }}" class="list-group-item list-group-item-action">
                {{ $option['label'] }}
            </a>
        @endforeach
    </div>
@endif