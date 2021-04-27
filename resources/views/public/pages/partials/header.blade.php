<div class="header-container">
    @php
        $dataTranslate = [
            'ViewFullDetails' => __('View FULL details'),
            'AvgNight' => __('Avg. night'),
            'Bedrooms' => __('Bedrooms'),
            'Bathrooms' => __('Bathrooms'),
            'MaxOccupancy' => __('Max. Occupancy'),
            'TravelDates' => __('Travel Dates'),
            'Bedrooms' => __('Bedrooms'),
            'Adults' => __('Adults'),
            'Children' => __('Children'),
        ];
    @endphp
    <header id="navbar" role="banner" class="navbar container navbar-default"
        data-all="{{ json_encode($dataTranslate) }}">
        <div class="container container-public">
            <div class="navbar-header">
                <a class="logo navbar-btn pull-left" href="/" title="{{ __('Home') }}">
                    <img src="{{ asset('assets/public/images/logo.png') }}" alt="{{ __('Home') }}" />
                </a>


                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
                    <span class="sr-only">{{ __('Toggle navigation') }}</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>

            <div class="navbar-collapse collapse app-navbar-collapse" id="navbar-collapse">
                <nav role="navigation">
                    @include('public.pages.partials.menu')
                    @include('public.pages.partials.language-switcher')
                </nav>
            </div>
        </div>
    </header>
</div>
