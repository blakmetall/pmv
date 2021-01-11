<aside class="col-sm-3" role="complementary">
    <div class="region region-sidebar-second">
        @if (Request::path() != 'availability-results')
            <section id="block-block-2" class="block block-block clearfix">
                <div class="text-right">
                    <a href="#" title="Return to the Search Results" id="return-availability-results">
                        <i class="fas fa-chevron-circle-left"></i> Return to the Search Results
                    </a>
                </div>
            </section>
        @endif
        <section id="block-recent-views-recent-views-block" class="block block-recent-views clearfix">

            <h2 class="block-title">Recent Views</h2>

            <div id="recent-views">
            </div>
        </section>
        <section id="block-menu-menu-travel-resources" class="block block-menu clearfix">
            <h2 class="block-title">Travel Resources</h2>
            <ul class="menu nav">
                <li class="first leaf">
                    <a href="{{ route('public.about.puerto-vallarta-history') }}" title="Puerto Vallarta">Puerto
                        Vallarta</a>
                </li>
                <li class="leaf">
                    <a href="{{ route('public.about.nuevo-vallarta-history') }}" title="Nuevo Vallarta">Nuevo
                        Vallarta</a>
                </li>
                <li class="leaf">
                    <a href="{{ route('public.about.mazatlan-history') }}" title="Mazatlán">Mazatlán</a>
                </li>
                <li class="leaf">
                    <a href="{{ route('public.concierge-services') }}" title="Concierge Services">Concierge
                        Service</a>
                </li>
                <li class="leaf">
                    <a href="{{ route('public.concierge-services.helpful-information') }}"
                        title="Helpful Information">Helpful Information</a>
                </li>
                <li class="leaf">
                    <a href="{{ route('public.vacation-services.accidental-rental-damage-insurance') }}"
                        title="Damage Insurance (ARDI)">Damage Insurance (ARDI)</a>
                </li>
                <li class="last leaf">
                    <a href="{{ route('public.vacation-services.rental-agreement') }}" title="Rental Agreement">Rental
                        Agreement</a>
                </li>
            </ul>
        </section>
    </div>
</aside>
