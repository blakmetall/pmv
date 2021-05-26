@php
    $_current_lang = LanguageHelper::current();
    $isLoggedIn = Auth::id();
@endphp

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

<div class="header-container">
    {{-- top bar --}}
    <div class="region region-navigation top-bar">
        <section class="block block-locale clearfix">
            <div class="language-switcher-locale-url">
                @if($isLoggedIn)
                    <div class="en first"><a
                        href="/system"
                        class="language-divnk top-login-link"
                        xml:lang="en">{{ __('Dashboard') }}</a></div>
                @else
                    <div class="en first"><a
                        href="/login"
                        class="language-link top-login-link"
                        xml:lang="en">{{ __('Login') }}</a></div>
                @endif
    
                <div class="en first" {{ $_current_lang->id == 1 ? 'active' : '' }}><a
                        href="{{ route('language.update', ['en']) }}"
                        class="language-link {{ $_current_lang->id == 1 ? 'active' : '' }}"
                        xml:lang="en">{{ __('English') }}</a></div>
    
                <div class="es last {{ $_current_lang->id == 2 ? 'active' : '' }} mr-3"><a
                        href="{{ route('language.update', ['es']) }}"
                        class="language-link {{ $_current_lang->id == 2 ? 'active' : '' }}"
                        xml:lang="es">{{ __('Spanish') }}</a></div>
            </ul>
        </section>
    </div>

    {{-- main navbar --}}
    <nav class="navbar navbar-default">
        <div class="container-fluid">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <a class="navbar-brand logo navbar-btn" href="/">
                <img alt="Brand" src="{{ asset('assets/public/images/logo.png') }}">
            </a>

            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
          </div>
      
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="menu nav navbar-nav navbar-right">
                <li class="first leaf active" id="fa-home">
                    <a href="{{ route('public.home-default', [App::getLocale()]) }}" title="{{ __('Home') }}" class="active"><span
                            class="fa fa-home"></span>{{ __('Home') }}</a>
                </li>
                <li class="expanded dropdown" id="fa-flag">
                    <a href="{{ route('public.vacation-services', [App::getLocale()]) }}" title="{{ __('Vacation Services') }}"
                        class="dropdown-toggle" data-toggle="dropdown"><span
                            class="fa fa-flag"></span>{{ __('Vacation Services') }}<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li class="first leaf">
                            <a href="{{ route('public.vacation-services', [App::getLocale()]) }}"
                                title="{{ __('Vacation Services') }}">{{ __('Vacation Services') }}</a>
                        </li>
                        <li class="leaf">
                            <a href="{{ route('public.vacation-services.make-payment', [App::getLocale()]) }}"
                                title="{{ __('Make Payment') }}">{{ __('Make Payment') }}</a>
                        </li>
                        <li class="leaf">
                            <a href="{{ route('public.vacation-services.payment-methods', [App::getLocale()]) }}"
                                title="{{ __('Payment Methods') }}">{{ __('Payment Methods') }}</a>
                        </li>
                        <li class="leaf">
                            <a href="{{ route('public.vacation-services.rental-agreement', [App::getLocale()]) }}"
                                title="{{ __('Rental Agreement') }}">{{ __('Rental Agreement') }}</a>
                        </li>
                        <li class="last leaf">
                            <a href="{{ route('public.vacation-services.accidental-rental-damage-insurance', [App::getLocale()]) }}"
                                title="{{ __('Accidental Rental Damage Insurance (ARDI)') }}">{{ __('Accidental Rental Damage Insurance (ARDI)') }}</a>
                        </li>
                    </ul>
                </li>
            
                <li class="expanded dropdown" id="fa-star">
                    <a href="{{ route('public.concierge-services', [App::getLocale()]) }}" title="{{ __('Concierge Services') }}"
                        class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-star"></span>
                        {{ __('Concierge Services') }} <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="first leaf">
                            <a href="{{ route('public.concierge-services', [App::getLocale()]) }}"
                                title="{{ __('Concierge Services') }}">{{ __('Concierge Services') }}</a>
                        </li>
                        <li class="last leaf">
                            <a href="{{ route('public.concierge-services.helpful-information', [App::getLocale()]) }}"
                                title="{{ __('Helpful Information') }}">{{ __('Helpful Information') }}</a>
                        </li>
                    </ul>
                </li>
            
                <li class="expanded dropdown" id="fa-bell">
                    <a href="{{ route('public.property-management', [App::getLocale()]) }}" title="{{ __('Property Management') }}"
                        class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-bell"></span>
                        {{ __('Property Management') }} <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="first leaf">
                            <a href="{{ route('public.property-management', [App::getLocale()]) }}"
                                title="{{ __('Property Management') }}">{{ __('Property Management') }}</a>
                        </li>
                        <li class="last leaf">
                            <a href="{{ route('dashboard') }}" title="{{ __('Property Owner Login') }}" target="_blank">
                                {{ __('Property Owner Login') }}
                            </a>
                        </li>
                    </ul>
                </li>
            
                <li class="expanded dropdown" id="fa-about">
                    <a href="{{ route('public.about', [App::getLocale()]) }}" title="{{ __('About Palmera Vacations') }}" class="dropdown-toggle"
                        data-toggle="dropdown"><span class="fa fa-heart"></span> {{ __('About') }} <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="first leaf">
                            <a href="{{ route('public.about', [App::getLocale()]) }}"
                                title="{{ __('Palmera Vacations') }}">{{ __('Palmera Vacations') }}</a>
                        </li>
                        <li class="leaf">
                            <a href="{{ route('public.about.puerto-vallarta-history', [App::getLocale()]) }}"
                                title="{{ __('Puerto Vallarta History') }}">{{ __('Puerto Vallarta') }}</a>
                        </li>
                        <li class="leaf">
                            <a href="{{ route('public.about.nuevo-vallarta-history', [App::getLocale()]) }}"
                                title="{{ __('Nuevo Vallarta History') }}">{{ __('Nuevo Vallarta') }}</a>
                        </li>
                        <li class="leaf">
                            <a href="{{ route('public.about.mazatlan-history', [App::getLocale()]) }}"
                                title="{{ __('Mazatlán') }}">{{ __('Mazatlán') }}</a>
                        </li>
                        <li class="leaf">
                            <a href="{{ route('public.about.testimonials', [App::getLocale()]) }}"
                                title="{{ __('Testimonials') }}">{{ __('Testimonials') }}</a>
                        </li>
                        <li class="leaf">
                            <a href="{{ route('public.about.privacy-policy', [App::getLocale()]) }}"
                                title="{{ __('Privacy Policy') }}">{{ __('Privacy Policy') }}</a>
                        </li>
                        <li class="leaf">
                            <a href="{{ route('public.about.terms-of-use', [App::getLocale()]) }}"
                                title="{{ __('Terms of Use') }}">{{ __('Terms of Use') }}</a>
                        </li>
                        <li class="leaf">
                            <a href="{{ route('public.about.real-estate-business-directory', [App::getLocale()]) }}"
                                title="{{ __('Real Estate Business Directory') }}">{{ __('Real Estate Business Directory') }}</a>
                        </li>
                        <li class="last leaf">
                            <a href="{{ route('public.about.lgbt-business-directory', [App::getLocale()]) }}"
                                title="{{ __('LGBT Business Directory') }}">{{ __('LGBT Business Directory') }}</a>
                        </li>
                    </ul>
                </li>
                
                <li class="last leaf" id="fa-user">
                    <a href="{{ route('public.contact', [App::getLocale()]) }}" title="{{ __('Contact Us') }}"><span
                            class="fa fa-user"></span>{{ __('Contact Us') }}</a>
                </li>
            </ul>
            
          </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
      </nav>
</div>

