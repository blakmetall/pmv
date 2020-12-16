<div class="header-container">
    <header id="navbar" role="banner" class="navbar container navbar-default">
        <div class="container">
            <div class="navbar-header">
                <a class="logo navbar-btn pull-left" href="/" title="Home">
                    <img src="{{ asset('assets/public/images/logo.png') }}" alt="Home" />
                </a>


                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>

            <div class="navbar-collapse collapse" id="navbar-collapse">
                <nav role="navigation">
                    @include('public.pages.partials.menu')
                    @include('public.pages.partials.languge-switcher')
                </nav>
            </div>
        </div>
    </header>
</div>
