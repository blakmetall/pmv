@php
    $_role = \App\Helpers\Role::current();
@endphp

<div class="horizontal-bar-wrap">
    <div class="header-topnav">
        <div class="container-fluid">
            <div class=" topnav rtl-ps-none" id="" data-perfect-scrollbar data-suppress-scroll-x="true">
                <ul class="menu float-left">

                    @if ($_role->isAllowed('calendar', 'heading-menu'))
                        <li>
                            <div>
                                <div>
                                    <a href="#">
                                        <i class="nav-icon mr-2 i-Calendar-2"></i>
                                        {{ __('Calendar') }}
                                    </a>
                                </div>
                            </div>
                        </li>
                    @endif

                    @if ($_role->isAllowed('booking', 'heading-menu'))
                        <li>
                            <div>
                                <div>
                                    <!-- label for menu and sidebar menu for responsive -->
                                    <label class="toggle" for="dropdownMenuBooking">
                                        {{ __('Bookings') }}
                                    </label>
                                    <a href="">
                                        <i class="nav-icon mr-2 i-Calendar-4"></i>
                                        {{ __('Bookings') }}
                                    </a>

                                    <!-- dropdown menu -->
                                    <input type="checkbox" id="dropdownMenuBooking">
                                    <ul>
                                        @if ($_role->isAllowed('booking', 'index'))
                                            <li class="nav-item">
                                                <a class="" href="#">
                                                    <span class="item-name">{{ __('All') }}</span>
                                                </a>
                                            </li>
                                        @endif

                                        @if ($_role->isAllowed('booking', 'requests'))
                                            <li class="nav-item">
                                                <a class="" href="#">
                                                    <span class="item-name">{{ __('Requests') }}</span>
                                                </a>
                                            </li>
                                        @endif

                                        @if ($_role->isAllowed('booking', 'agents'))
                                            <li class="nav-item">
                                                <a class="" href="#">
                                                    <span class="item-name">{{ __('Agents') }}</span>
                                                </a>
                                            </li>
                                        @endif

                                        @if ($_role->isAllowed('booking', 'commisions'))
                                            <li class="nav-item">
                                                <a class="" href="#">
                                                    <span class="item-name">{{ __('Commisions') }}</span>
                                                </a>
                                            </li>
                                        @endif

                                        @if ($_role->isAllowed('booking', 'general-availability'))
                                            <li class="nav-item">
                                                <a class="" href="#">
                                                    <span class="item-name">{{ __('General Availability') }}</span>
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </li>
                    @endif

                    @if ($_role->isAllowed('properties', 'heading-menu'))
                        <li>
                            <div>
                                    <div>
                                        <!-- label for menu and sidebar menu for responsive -->
                                        <label class="toggle" for="dropdownMenuProperties">
                                            {{  __('Properties') }}
                                        </label>
                                        <a href="">
                                            <i class="nav-icon mr-2 i-Home1"></i>
                                            {{  __('Properties') }}
                                        </a>

                                        <!-- dropdown menu -->
                                        <input type="checkbox" id="dropdownMenuBooking">
                                        <ul>
                                            @if ($_role->isAllowed('properties', 'index'))
                                                <li class="nav-item">
                                                    <a class="" href="{{ route('properties-all') }}">
                                                        <span class="item-name">{{ __('All') }}</span>
                                                    </a>
                                                </li>
                                            @endif

                                            @if ($_role->isAllowed('properties', 'property-types'))
                                                <li class="nav-item">
                                                    <a class="" href="{{ route('types-all') }} ">
                                                        <span class="item-name">{{ __('Property Types') }}</span>
                                                    </a>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                            </div>
                        </li>
                    @endif

                    @if ($_role->isAllowed('property-management', 'heading-menu'))
                        <li>
                            <div>
                                <div>
                                    <!-- label for menu and sidebar menu for responsive -->
                                    <label class="toggle" for="dropdownMenuBooking">
                                        {{ __('Property Management') }}
                                    </label>
                                    <a href="">
                                        <i class="nav-icon mr-2 i-Home-2"></i>
                                        {{ __('Property Management') }}
                                    </a>

                                    <!-- dropdown menu -->
                                    <input type="checkbox" id="dropdownMenuBooking">
                                    <ul>
                                        @if ($_role->isAllowed('property-management', 'index'))
                                            <li class="nav-item">
                                                <a class="" href="#">
                                                    <span class="item-name">{{ __('All') }}</span>
                                                </a>
                                            </li>
                                        @endif

                                        @if ($_role->isAllowed('property-management', 'balances'))
                                            <li class="nav-item">
                                                <a class="" href="#">
                                                    <span class="item-name">{{ __('Balances') }}</span>
                                                </a>
                                            </li>
                                        @endif

                                        @if ($_role->isAllowed('property-management', 'transactions'))
                                            <li class="nav-item">
                                                <a class="" href="#">
                                                    <span class="item-name">{{ __('Transactions') }}</span>
                                                </a>
                                            </li>
                                        @endif

                                        @if ($_role->isAllowed('property-management', 'pending-audits'))
                                            <li class="nav-item">
                                                <a class="" href="#">
                                                    <span class="item-name">{{ __('Pending Audits') }}</span>
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </li>
                    @endif

                    @if ($_role->isAllowed('cleaning-services', 'heading-menu'))
                        <li>
                            <div>
                                <div>
                                    <!-- label for menu and sidebar menu for responsive -->
                                    <label class="toggle" for="dropdownMenuBooking">
                                        {{ __('Cleaning Services') }}
                                    </label>
                                    <a href="">
                                        <i class="nav-icon mr-2 i-Green-House"></i>
                                        {{ __('Cleaning Services') }}
                                    </a>

                                    <!-- dropdown menu -->
                                    <input type="checkbox" id="dropdownMenuBooking">
                                    <ul>
                                        @if ($_role->isAllowed('cleaning-services', 'index'))
                                            <li class="nav-item">
                                                <a class="" href="#">
                                                    <span class="item-name">{{ __('All') }}</span>
                                                </a>
                                            </li>
                                        @endif;

                                        @if ($_role->isAllowed('cleaning-services', 'staff'))
                                            <li class="nav-item">
                                                <a class="" href="#">
                                                    <span class="item-name">{{ __('Staff') }}</span>
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </li>
                    @endif

                    @if ($_role->isAllowed('contractors', 'heading-menu'))
                        <li>
                            <div>
                                <div>
                                    <!-- label for menu and sidebar menu for responsive -->
                                    <label class="toggle" for="dropdownMenuBooking">
                                        {{ __('Contractors') }}
                                    </label>
                                    <a href="">
                                        <i class="nav-icon mr-2 i-Engineering"></i>
                                        {{ __('Contractors') }}
                                    </a>

                                    <!-- dropdown menu -->
                                    <input type="checkbox" id="dropdownMenuBooking">
                                    <ul>
                                        @if ($_role->isAllowed('contractors', 'index'))
                                            <li class="nav-item">
                                                <a class="" href="#">
                                                    <span class="item-name">{{ __('All') }}</span>
                                                </a>
                                            </li>
                                        @endif

                                        @if ($_role->isAllowed('contractors', 'services'))
                                            <li class="nav-item">
                                                <a class="" href="#">
                                                    <span class="item-name">{{ __('Services') }}</span>
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </li>
                    @endif

                    @if ($_role->isAllowed('users', 'heading-menu'))
                        <li>
                            <div>
                                <div>
                                    <!-- label for menu and sidebar menu for responsive -->
                                    <label class="toggle" for="dropdownMenuBooking">
                                        {{ __('Users') }}
                                    </label>
                                    <a href="#">
                                        <i class="nav-icon mr-2 i-Mens"></i>
                                        {{ __('Users') }}
                                    </a>

                                    <!-- dropdown menu -->
                                    <input type="checkbox" id="dropdownMenuBooking">
                                    <ul>
                                        @if ($_role->isAllowed('users', 'index'))
                                            <li class="nav-item">
                                                <a class="" href="{{ route('users') }}">
                                                    <span class="item-name">{{ __('All') }}</span>
                                                </a>
                                            </li>
                                        @endif

                                        @if ($_role->isAllowed('users', 'staff-groups'))
                                            <li class="nav-item">
                                                <a class="" href="#">
                                                    <span class="item-name">{{ __('Staff Groups') }}</span>
                                                </a>
                                            </li>
                                        @endif

                                        @if ($_role->isAllowed('users', 'roles'))
                                            <li class="nav-item">
                                                <a class="" href="{{ route('roles') }}">
                                                    <span class="item-name">{{ __('Roles') }}</span>
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </li>
                    @endif

                    @if ($_role->isAllowed('reporting', 'heading-menu'))
                        <li>
                            <div>
                                <div>
                                    <!-- label for menu and sidebar menu for responsive -->
                                    <label class="toggle" for="dropdownMenuBooking">
                                        {{ __('Reporting') }}
                                    </label>
                                    <a href="#">
                                        <i class="nav-icon mr-2 i-Newspaper"></i>
                                        {{ __('Reporting') }}
                                    </a>

                                    <!-- dropdown menu -->
                                    <input type="checkbox" id="dropdownMenuBooking">
                                    <ul>
                                        <li class="nav-item">
                                            <a class="" href="#">
                                                <span class="item-name">{{ __('All') }}</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    @endif

                    @if ($_role->isAllowed('settings', 'heading-menu'))
                        <li>
                            <div>
                                <div>
                                    <!-- label for menu and sidebar menu for responsive -->
                                    <label class="toggle" for="dropdownMenuBooking">
                                        {{ __('Settings') }}
                                    </label>
                                    <a href="#">
                                        <i class="nav-icon mr-2 i-Gear-2"></i>
                                        {{ __('Settings') }}
                                    </a>

                                    <!-- dropdown menu -->
                                    <input type="checkbox" id="dropdownMenuBooking">
                                    <ul>
                                        @if ($_role->isAllowed('settings', 'cities'))
                                            <li class="nav-item">
                                                <a class="" href="#">
                                                    <span class="item-name">{{ __('Cities') }}</span>
                                                </a>
                                            </li>
                                        @endif

                                        @if ($_role->isAllowed('settings', 'zones'))
                                            <li class="nav-item">
                                                <a class="" href="{{ route('zones') }}">
                                                    <span class="item-name">{{ __('Zones') }}</span>
                                                </a>
                                            </li>
                                        @endif
                                        
                                        @if ($_role->isAllowed('settings', 'amenities'))
                                            <li class="nav-item">
                                                <a class="" href="{{ route('amenities') }}">
                                                    <span class="item-name">{{ __('Amenities') }}</span>
                                                </a>
                                            </li>
                                        @endif

                                        @if ($_role->isAllowed('settings', 'transaction-types'))
                                            <li class="nav-item">
                                                <a class="" href="{{ route('transaction-types') }}">
                                                    <span class="item-name">{{ __('Transaction Types') }}</span>
                                                </a>
                                            </li>
                                        @endif

                                        @if ($_role->isAllowed('settings', 'rental-cleaning-options'))
                                            <li class="nav-item">
                                                <a class="" href="#">
                                                    <span class="item-name">{{ __('Rental Cleaning Options') }}</span>
                                                </a>
                                            </li>
                                        @endif

                                        @if ($_role->isAllowed('settings', 'damage-deposits'))
                                            <li class="nav-item">
                                                <a class="" href="#">
                                                    <span class="item-name">{{ __('Damage Deposits') }}</span>
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </li>
                    @endif

                </ul>


            </div>
        </div>
    </div>

</div>
<!--=============== Horizontal bar End ================-->
