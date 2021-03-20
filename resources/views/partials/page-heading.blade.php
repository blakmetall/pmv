<div class="breadcrumb app-breadcrumb">

    @if( isset($title) )
        <h1>{{ $title }}</h1>
    @endif

    @if( isset($breadcrumbs) && is_array($breadcrumbs) && count($breadcrumbs) )
        <div>
            <ul>
                <!-- needed for first empty breadcrumb spacer -->
                <li>&nbsp;</li>

                <!-- breadcrumbs list -->
                @foreach($breadcrumbs as $b)
                    <li>
                        <a href="{{ $b['url'] }}">
                            {{ $b['label'] }}
                        </a>
                    </li>
                @endforeach

            </ul>
        </div>
    @endif

</div>


<!-- <div class="separator-breadcrumb border-top"></div> -->

