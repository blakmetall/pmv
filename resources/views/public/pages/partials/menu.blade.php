<ul class="menu nav navbar-nav">
    <li class="first leaf active" id="fa-home"><a href="{{ route('public.home') }}" title="Home" class="active"><span
                class="fa fa-home"></span>
            Home</a></li>
    <li class="expanded dropdown" id="fa-flag"><a href="{{ route('public.vacation-services') }}"
            title="Vacation Services" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-flag"></span>
            Vacation Services <span class="caret"></span></a>
        <ul class="dropdown-menu">
            <li class="first leaf"><a href="/vacation-services" title="Vacation Services">Vacation Services</a></li>
            <li class="leaf"><a href="/make-payment" title="Make Payment">Make Payment</a></li>
            <li class="leaf"><a href="/payment-methods" title="Payment Methods">Payment Methods</a></li>
            <li class="leaf"><a href="/rental-agreement" title="Rental Agreement">Rental Agreement</a></li>
            <li class="last leaf"><a href="/accidental-rental-damage-insurance"
                    title="Accidental Rental Damage Insurance">Accidental Rental Damage Insurance (ARDI)</a></li>
        </ul>
    </li>
    <li class="expanded dropdown" id="fa-star"><a href="/concierge-services" title="Concierge Services"
            class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-star"></span> Concierge Services <span
                class="caret"></span></a>
        <ul class="dropdown-menu">
            <li class="first leaf"><a href="/concierge-services" title="Concierge Services">Concierge Services</a></li>
            <li class="last leaf"><a href="/helpful-information" title="Helpful Information">Helpful Information</a>
            </li>
        </ul>
    </li>
    <li class="expanded dropdown" id="fa-bell"><a href="/property-management" title="Property Management"
            class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-bell"></span> Property Management <span
                class="caret"></span></a>
        <ul class="dropdown-menu">
            <li class="first leaf"><a href="/property-management" title="Property Management">Property Management</a>
            </li>
            <li class="last leaf">
                <a href="{{ route('dashboard') }}" title="Property Owner Login">
                    Property Owner Login
                </a>
            </li>
        </ul>
    </li>
    <li class="expanded dropdown" id="fa-about"><a href="/about-palmera-vacations" title="About Palmera Vacations"
            class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-heart"></span> About <span
                class="caret"></span></a>
        <ul class="dropdown-menu">
            <li class="first leaf"><a href="/about-palmera-vacations" title="Palmera Vacations">Palmera Vacations</a>
            </li>
            <li class="leaf"><a href="/puerto-vallarta-history" title="Puerto Vallarta History">Puerto Vallarta</a></li>
            <li class="leaf"><a href="/nuevo-vallarta-history" title="Nuevo Vallarta History">Nuevo Vallarta</a></li>
            <li class="leaf"><a href="/mazatlan-history" title="Mazatlán">Mazatlán</a></li>
            <li class="leaf"><a href="/testimonials" title="Testimonials">Testimonials</a></li>
            <li class="leaf"><a href="/privacy-policy" title="Privacy Policy">Privacy Policy</a></li>
            <li class="leaf"><a href="/terms-of-use" title="Terms of Use">Terms of Use</a></li>
            <li class="leaf"><a href="/real-estate-business-directory" title="Real Estate Business Directory">Real
                    Estate Business Directory</a></li>
            <li class="last leaf"><a href="/lgbt-business-directory" title="LGBT Business Directory">LGBT Business
                    Directory</a></li>
        </ul>
    </li>
    <li class="last leaf" id="fa-user"><a href="/contact" title="Contact Us"><span class="fa fa-user"></span>Contact
            Us</a></li>
</ul>
