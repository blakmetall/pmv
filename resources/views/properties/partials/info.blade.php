@php
$lang = LanguageHelper::current();
$property = isset($property) ? $property : false;
@endphp

@if ($property)
    <div class="container app-container mb-4 app-property-info">
        <div class="card">
            <div class="card-body">

                <div class="row align-items-center">
                    <div class="col-sm-2 col-md-1 d-none d-sm-inline-block">
                        @if ($property->hasDefaultImage())
                            @php
                                $propertyImg = $property->getDefaultImage();
                            @endphp

                            <a href="{{ route('properties.show', [$property->id]) }}">
                                <img src="{{ asset(getUrlPath($propertyImg->file_url, 'small-ls')) }}" alt="" width="100">
                            </a>
                        @else
                            <a href="{{ route('properties.show', [$property->id]) }}">
                                <img src="/images/thumb-placeholder.jpg" alt="" width="100">
                            </a>
                        @endif
                    </div>
                    <div class="col-sm-4 col-md-4 mb-2 mb-sm-0">
                        <div class="app-property-info-title">
                            <a href="{{ route('properties.show', [$property->id]) }}" class="text-primary">
                                {{ $property->translate()->name }}
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-7 text-left text-md-right app-property-info-icons">

                        <!-- property view -->
                        <!-- Por que un dueño no puede ver los detalles de su propiedad? -->
                        @if (!isRole('owner'))
                            <a role="button" href="{{ route('properties.show', [$property->id]) }}"
                                class="btn btn-sm btn-secondary app-icon-link mb-1 mb-sm-0" title="{{ __('View') }}"
                                alt="{{ __('View') }}">
                                <i class="nav-icon i-Eye font-weight-bold"></i>
                            </a>
                        @endif

                        <!-- property images -->
                        @if (!isRole('owner'))
                            <a role="button" href="{{ route('property-images', [$property->id]) }}"
                                class="btn btn-sm btn-secondary app-icon-link mb-1 mb-sm-0" title="{{ __('Images') }}"
                                alt="{{ __('Images') }}">
                                <i class="nav-icon i-Old-Camera font-weight-bold"></i>
                            </a>
                        @endif

                        <!-- bookings from specific to property -->
                        @if (!isRole('owner'))
                            <a role="button" href="{{ route('property-bookings.by-property', [$property->id]) }}"
                                class="btn btn-sm btn-secondary app-icon-link mb-1 mb-sm-0"
                                title="{{ __('Reservations') }}" alt="{{ __('Reservations') }}">
                                <i class="nav-icon i-Calendar-2 font-weight-bold"></i>
                            </a>
                        @endif

                        <!-- property rates -->
                        @if (!isRole('owner'))
                            <a role="button" href="{{ route('property-rates', [$property->id]) }}"
                                class="btn btn-sm btn-secondary app-icon-link mb-1 mb-sm-0" title="{{ __('Rates') }}"
                                alt="{{ __('Rates') }}">
                                <i class="nav-icon i-Money-2 font-weight-bold"></i>
                            </a>
                        @endif

                        <!-- Policies cancelar actividad -->
                        {{-- @if (!isRole('owner'))
                            <a href="{{ route('maintenance') }}"
                                class="btn btn-sm btn-secondary app-icon-link mb-1 mb-md-0"
                                title="{{ __('Policies') }}" alt="{{ __('Policies') }}">
                                <i class="nav-icon i-Files font-weight-bold"></i>
                            </a>
                        @endif --}}

                        <!-- property contacts -->
                        @if (!isRole('owner'))
                            <a role="button" href="{{ route('property-contacts', [$property->id]) }}"
                                class="btn btn-sm btn-secondary app-icon-link mb-1 mb-sm-0"
                                title="{{ __('Contacts') }}" alt="{{ __('Contacts') }}">
                                <i class="nav-icon i-Administrator font-weight-bold"></i>
                            </a>
                        @endif

                        <!-- property notes -->
                        @if (!isRole('owner'))
                            <a role="button" href="{{ route('property-notes', [$property->id]) }}"
                                class="btn btn-sm btn-secondary app-icon-link mb-1 mb-md-0" title="{{ __('Notes') }}"
                                alt="{{ __('Notes') }}">
                                <i class="nav-icon i-Notepad font-weight-bold"></i>
                            </a>
                        @endif

                        <!-- property calendar -->
                        <a href="{{ route('property-calendar', [$property->id]) }}"
                            class="btn btn-sm btn-secondary app-icon-link mb-1 mb-md-0" title="{{ __('Calendar') }}"
                            alt="{{ __('Calendar') }}">
                            <i class="nav-icon i-Calendar-4 font-weight-bold"></i>
                        </a>

                        <!-- property preview -->
                        @if (!isRole('owner') && $property->is_online)
                            <a role="button" href="{{ route('public.property-detail', [getZone($property->id), $property->translate()->slug]) }}"
                                class="btn btn-sm btn-secondary app-icon-link mb-1 mb-md-0"
                                title="{{ __('Preview') }}" alt="{{ __('Preview') }}">
                                <i class="nav-icon i-Right font-weight-bold"></i>
                            </a>
                        @endif

                        <!-- property management -->
                        @if (!isRole('owner'))
                            <a role="button" href="{{ route('property-management', [$property->id]) }}"
                                class="btn btn-sm btn-secondary app-icon-link mb-1 mb-sm-0"
                                title="{{ __('Property Management') }}" alt="{{ __('Property Management') }}">
                                <i class="nav-icon i-Building font-weight-bold"></i>
                            </a>
                        @endif

                    </div>
                </div>

            </div>
        </div>
    </div>
@endif
