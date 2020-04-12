@php 
    $should_render = isset($items) && is_array($items);
@endphp

@if ($should_render)
    
        <div class="list-group">
            @foreach ($items as $item)

                @if (isset($item['url']))
                    <a href="{{ $item['url'] }}" class="list-group-item list-group-item-action">
                        {{ $item['label'] }}
                    </a>
                @else
                    <div class="list-group-item list-group-item-action">
                        {{ $item['label'] }}
                    </div>
                @endif

            @endforeach
        </div>
        
@endif