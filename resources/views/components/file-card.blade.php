 @php
    $shouldRender = isset($url) && isset($extension);
    $name = isset($name) ? $name : '';
    $extension = isset($extension) ? $extension : '';
    $imgSize = isset($imgSize) ? $imgSize : '';

    $isImage = isImage($extension);


 @endphp
 
 @if ($shouldRender)
    <div class="app-file-card">
        <div class="card">

            @if ($isImage)
                <img class="card-img" src="{{ asset(getUrlPath($url, $imgSize)) }}" alt="Card image">
            @endif

            @php 
                $overlayClass = $isImage ? 'card-img-overlay' : 'app-card-text-overlay';
                $textBgClass = $isImage ? 'text-white' : ''; 
            @endphp
            <div class="{{ $overlayClass }}">

                @if ($name !== '')
                    <h5 class="card-title {{ $textBgClass }}">
                        <a href="{{ asset(getUrlPath($url)) }}" target="_blank">
                            {{ $name }}
                        </a>
                    </h5>
                @endif
            </div>
        </div>
    </div>
@endif