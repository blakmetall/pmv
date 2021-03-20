<ul class="menu nav navbar-nav">
    <li class="first leaf active" id="fa-home">
        <a href="{{ route('public.home') }}" title="{{ __('Home') }}" class="active"><span
                class="fa fa-home"></span>{{ __('Home') }}</a>
    </li>
    <li class="expanded dropdown" id="fa-flag">
        <a href="{{ route('public.vacation-services') }}" title="{{ __('Vacation Services') }}"
            class="dropdown-toggle" data-toggle="dropdown"><span
                class="fa fa-flag"></span>{{ __('Vacation Services') }}<span class="caret"></span></a>
        <ul class="dropdown-menu">
            <li class="first leaf">
                <a href="{{ route('public.vacation-services') }}"
                    title="{{ __('Vacation Services') }}">{{ __('Vacation Services') }}</a>
            </li>
            <li class="leaf">
                <a href="{{ route('public.vacation-services.make-payment') }}"
                    title="{{ __('Make Payment') }}">{{ __('Make Payment') }}</a>
            </li>
            <li class="leaf">
                <a href="{{ route('public.vacation-services.payment-methods') }}"
                    title="{{ __('Payment Methods') }}">{{ __('Payment Methods') }}</a>
            </li>
            <li class="leaf">
                <a href="{{ route('public.vacation-services.rental-agreement') }}"
                    title="{{ __('Rental Agreement') }}">{{ __('Rental Agreement') }}</a>
            </li>
            <li class="last leaf">
                <a href="{{ route('public.vacation-services.accidental-rental-damage-insurance') }}"
                    title="{{ __('Accidental Rental Damage Insurance (ARDI)') }}">{{ __('Accidental Rental Damage Insurance (ARDI)') }}</a>
            </li>
        </ul>
    </li>
    <li class="expanded dropdown" id="fa-star">
        <a href="{{ route('public.concierge-services') }}" title="{{ __('Concierge Services') }}"
            class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-star"></span>
            {{ __('Concierge Services') }} <span class="caret"></span>
        </a>
        <ul class="dropdown-menu">
            <li class="first leaf">
                <a href="{{ route('public.concierge-services') }}"
                    title="{{ __('Concierge Services') }}">{{ __('Concierge Services') }}</a>
            </li>
            <li class="last leaf">
                <a href="{{ route('public.concierge-services.helpful-information') }}"
                    title="{{ __('Helpful Information') }}">{{ __('Helpful Information') }}</a>
            </li>
        </ul>
    </li>
    <li class="expanded dropdown" id="fa-bell">
        <a href="{{ route('public.property-management') }}" title="{{ __('Property Management') }}"
            class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-bell"></span>
            {{ __('Property Management') }} <span class="caret"></span>
        </a>
        <ul class="dropdown-menu">
            <li class="first leaf">
                <a href="{{ route('public.property-management') }}"
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
        <a href="{{ route('public.about') }}" title="{{ __('About Palmera Vacations') }}" class="dropdown-toggle"
            data-toggle="dropdown"><span class="fa fa-heart"></span> {{ __('About') }} <span class="caret"></span>
        </a>
        <ul class="dropdown-menu">
            <li class="first leaf">
                <a href="{{ route('public.about') }}"
                    title="{{ __('Palmera Vacations') }}">{{ __('Palmera Vacations') }}</a>
            </li>
            <li class="leaf">
                <a href="{{ route('public.about.puerto-vallarta-history') }}"
                    title="{{ __('Puerto Vallarta History') }}">{{ __('Puerto Vallarta') }}</a>
            </li>
            <li class="leaf">
                <a href="{{ route('public.about.nuevo-vallarta-history') }}"
                    title="{{ __('Nuevo Vallarta History') }}">{{ __('Nuevo Vallarta') }}</a>
            </li>
            <li class="leaf">
                <a href="{{ route('public.about.mazatlan-history') }}"
                    title="{{ __('Mazatlán') }}">{{ __('Mazatlán') }}</a>
            </li>
            <li class="leaf">
                <a href="{{ route('public.about.testimonials') }}"
                    title="{{ __('Testimonials') }}">{{ __('Testimonials') }}</a>
            </li>
            <li class="leaf">
                <a href="{{ route('public.about.privacy-policy') }}"
                    title="{{ __('Privacy Policy') }}">{{ __('Privacy Policy') }}</a>
            </li>
            <li class="leaf">
                <a href="{{ route('public.about.terms-of-use') }}"
                    title="{{ __('Terms of Use') }}">{{ __('Terms of Use') }}</a>
            </li>
            <li class="leaf">
                <a href="{{ route('public.about.real-estate-business-directory') }}"
                    title="{{ __('Real Estate Business Directory') }}">{{ __('Real Estate Business Directory') }}</a>
            </li>
            <li class="last leaf">
                <a href="{{ route('public.about.lgbt-business-directory') }}"
                    title="{{ __('LGBT Business Directory') }}">{{ __('LGBT Business Directory') }}</a>
            </li>
        </ul>
    </li>
    <li class="last leaf" id="fa-user">
        <a href="{{ route('public.contact') }}" title="{{ __('Contact Us') }}"><span
                class="fa fa-user"></span>{{ __('Contact Us') }}</a>
    </li>
</ul>
