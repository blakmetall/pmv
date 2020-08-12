 @php
    $label = isset($label) ? $label : '';
    $breadcrumbs = isset($breadcrumbs) ? $breadcrumbs : [];
    $actions = isset($actions) ? $actions : [];
    $modalID = 'contact-create-' . strtotime('now') . rand(1,99999);
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


                <div class="col-sm-12 col-md-4 text-md-right app-heading-buttons">
                    <a href="#" class="btn btn-dark btn-icon ripple m-1" data-toggle="modal" data-target="#{{$modalID }}">
                        <span class="ul-btn__icon">
                            <i class="nav-icon i-Add"></i>
                        </span>
                        <span class="ul-btn__text">
                           {{ __('New') }}
                        </span>
                    </a>
                    @include('contacts.partials.modal-create')
                    @if (is_array($actions) && count($actions) )
                        @foreach($actions as $action)
                            
                            @php
                                $hasIcon = isset($action['icon']);
                                $btnIconClass = $hasIcon ? ' btn-icon ' : '';

                                $btnColor = isset($action['color']) ? $action['color'] : 'dark';

                                $hasActionLabel = isset($action['label']);
                            @endphp

                            <a href="{{ $action['url'] }}" class="btn btn-{{ $btnColor }} {{ $btnIconClass }} ripple m-1" role="button" >

                                @if ($hasIcon)
                                    <span class="ul-btn__icon">
                                        <i class="{{ $action['icon'] }}"></i>
                                    </span>

                                    @if ($hasActionLabel)
                                        <span class="ul-btn__text">
                                            {{ $action['label'] }}
                                        </span>
                                    @endif
                                @else
                                    @if ($hasActionLabel)
                                        {{ $action['label'] }}
                                    @endif
                                @endif
                            </a>

                        @endforeach
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>