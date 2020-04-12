 @php
    $label = isset($label) ? $label : '';
    $breadcrumbs = isset($breadcrumbs) ? $breadcrumbs : [];
    $actions = isset($actions) ? $actions : [];
 @endphp
 
 <!-- heading -->
<div class="container app-container">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12 col-md-8">
                    <div class="breadcrumb app-breadcrumb">
                        @if ($label)
                            <h1>{{ $label }}</h1>
                        @endif

                        @if (is_array($breadcrumbs) && count($breadcrumbs) )
                            <div>
                                <ul>
                                    <!-- needed for first empty breadcrumb spacer -->
                                    <li>&nbsp;</li>

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
                </div>

                @if (is_array($actions) && count($actions) )
                    <div class="col-sm-12 col-md-4 text-md-right app-heading-buttons">
                        @foreach($actions as $action)
                            
                            @php
                                $btnColor = isset($action['color']) ? $action['color'] : 'dark';
                            @endphp

                            <a href="{{ $action['url'] }}" class="btn btn-{{ $btnColor }} ripple m-1" role="button" >
                                {{ $action['label'] }}
                            </a>

                        @endforeach
                    </div>
                @endif
            </div>

        </div>
    </div>
</div>