<div class="content-top-container bg-none">
    <section class="content-top container">
        <div class="region region-content-top">
            @include('public.pages.partials.quick-search')
            <section id="block-search-breadcrumbs-search-breadcrumbs-block"
                class="block block-search-breadcrumbs clearfix">

                <h2 class="block-title">{{ __('Your Search') }}</h2>

                <div id="search-breadcrumbs" class="row">
                    <div class="col-xs-9"><span class="search-params-breadcrumbs"></span></div>
                    <div class="col-xs-3 text-right"><a href="# " id="toggle-search"
                            title="{{ __('Show Search Form') }}"
                            class="btn btn-warning btn-xs show-search">{{ __('Show Search Form') }}</a></div>
                </div>
            </section>
            <section id="block-avail-search-avail-search-block" class="block block-avail-search clearfix">

                @include('public.pages.partials.check-availability')

            </section>
        </div>
    </section>
</div>
