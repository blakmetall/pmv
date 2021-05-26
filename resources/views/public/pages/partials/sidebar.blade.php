
<aside class="col-sm-3" role="complementary">
    <div class="mb-5 mb-sm-0"></div>
    <div class="region region-sidebar-second">
        @if (Request::path() != 'availability-results')
            <section id="block-block-2" class="block block-block clearfix">
                <div class="text-right">
                    <a href="#" title="{{ __('Return to the Search Results') }}" id="return-availability-results">
                        <i class="fas fa-chevron-circle-left"></i> {{ __('Return to the Search Results') }}
                    </a>
                </div>
            </section>
        @endif
        {{-- <section id="block-recent-views-recent-views-block" class="block block-recent-views clearfix">
            <h2 class="block-title">{{ __('Recent Views') }}</h2>
            <div id="recent-views"></div>
        </section> --}}
        <section id="block-menu-menu-travel-resources" class="block block-menu clearfix">
            <h2 class="block-title">{{ __('Travel Resources') }}</h2>
            <ul class="menu nav">
                <li class="first leaf">
                    <a href="{{ route('public.about.puerto-vallarta-history', [App::getLocale()]) }}"
                        title="{{ __('Puerto Vallarta') }}">{{ __('Puerto Vallarta') }}</a>
                </li>
                <li class="leaf">
                    <a href="{{ route('public.about.nuevo-vallarta-history', [App::getLocale()]) }}"
                        title="{{ __('Nuevo Vallarta') }}">{{ __('Nuevo Vallarta') }}</a>
                </li>
                <li class="leaf">
                    <a href="{{ route('public.about.mazatlan-history', [App::getLocale()]) }}"
                        title="{{ __('Mazatlán') }}">{{ __('Mazatlán') }}</a>
                </li>
                <li class="leaf">
                    <a href="{{ route('public.concierge-services', [App::getLocale()]) }}"
                        title="{{ __('Concierge Services') }}">{{ __('Concierge Services') }}</a>
                </li>
                <li class="leaf">
                    <a href="{{ route('public.concierge-services.helpful-information', [App::getLocale()]) }}"
                        title="{{ __('Helpful Information') }}">{{ __('Helpful Information') }}</a>
                </li>
                <li class="leaf">
                    <a href="{{ route('public.vacation-services.accidental-rental-damage-insurance', [App::getLocale()]) }}"
                        title="{{ __('Damage Insurance (ARDI)') }}">{{ __('Damage Insurance (ARDI)') }}</a>
                </li>
                <li class="last leaf">
                    <a href="{{ route('public.vacation-services.rental-agreement', [App::getLocale()]) }}"
                        title="{{ __('Rental Agreement') }}">{{ __('Rental Agreement') }}</a>
                </li>
            </ul>
        </section>
    </div>
</aside>
