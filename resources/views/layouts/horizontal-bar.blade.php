@php
$_current_role = RoleHelper::current();
@endphp

<div class="horizontal-bar-wrap">
    <div class="header-topnav">
        <div class="container-fluid">
            <div class=" topnav rtl-ps-none" id="" data-perfect-scrollbar data-suppress-scroll-x="true">
                <ul class="menu float-left" id="app-menu">

                    @if ($_current_role->isAllowed('properties', 'heading-menu'))
                        <li>
                            <div>
                                <div>
                                    <!-- label for menu and sidebar menu for responsive -->
                                    <label class="toggle" for="dropdownMenuProperties">
                                        {{ __('Properties') }}
                                    </label>
                                    <a href="{{ route('properties') }}">
                                        <i class="nav-icon mr-2 i-Home1"></i>
                                        {{ __('Properties') }}
                                    </a>

                                    <!-- Por que un dueño no podria ver sus propiedades? -->
                                    @if (!isRole('owner'))
                                        <!-- dropdown menu -->
                                        <input type="checkbox" id="dropdownMenuBooking">
                                        <ul>
                                            @if ($_current_role->isAllowed('properties', 'index'))
                                                <li class="nav-item">
                                                    <a class="" href="{{ route('properties.create') }}">
                                                        <span class="item-name">{{ __('New Listing') }}</span>
                                                    </a>
                                                </li>

                                                <li class="nav-item">
                                                    <a class="" href="{{ route('properties') }}">
                                                        <span class="item-name">{{ __('All') }}</span>
                                                    </a>
                                                </li>

                                                <li class="nav-item">
                                                    <a class="" href="{{ route('properties') }}?filterOffline=1">
                                                        <span class="item-name">{{ __('Properties Offline') }}</span>
                                                    </a>
                                                </li>

                                                <li class="nav-item">
                                                    <a class="" href="{{ route('properties') }}?filterDisabled=1">
                                                        <span class="item-name">{{ __('Properties Disabled') }}</span>
                                                    </a>
                                                </li>
                                            @endif
                                        </ul>
                                    @endif
                                </div>
                            </div>
                        </li>
                    @endif

                    @if ($_current_role->isAllowed('property-management', 'heading-menu'))
                        <li>
                            <div>
                                <div>
                                    <!-- label for menu and sidebar menu for responsive -->
                                    <label class="toggle" for="dropdownMenuProperties">
                                        {{ __('Property Management') }}
                                    </label>
                                    @if (isRole('owner'))
                                        <a href="#">
                                        @else
                                            <a href="{{ route('property-management.general') }}">
                                    @endif
                                    <i class="nav-icon mr-2 i-Home1"></i>
                                    {{ __('Property Management') }}
                                    </a>



                                    <!-- dropdown menu -->
                                    <input type="checkbox" id="dropdownMenuBooking">
                                    <ul class="menu-properties-dropdown">
                                        @if ($_current_role->isAllowed('property-management', 'new-transaction'))
                                            <li class="nav-item">
                                                <a class="" href="#" data-toggle="modal"
                                                    data-target="#app-pm-property-selection-modal">
                                                    <span class="item-name">{{ __('New Transaction') }}</span>
                                                </a>
                                            </li>
                                        @endif

                                        @if ($_current_role->isAllowed('property-management', 'transaction-bulk'))
                                            <li class="nav-item">
                                                <a class=""
                                                    href="{{ route('property-management-transactions.create-bulk') }}">
                                                    <span class="item-name">{{ __('Transaction Bulk') }}</span>
                                                </a>
                                            </li>
                                        @endif

                                        @if ($_current_role->isAllowed('property-management', 'index'))
                                            <li class="nav-item">
                                                <a class="" href="{{ route('property-management.general') }}">
                                                    <span class="item-name">{{ __('All') }}</span>
                                                </a>
                                            </li>
                                        @endif

                                        @if ($_current_role->isAllowed('property-management', 'balances'))
                                            <li class="nav-item">
                                                <a class="" href="{{ route('property-management-balances.general') }}">
                                                    <span class="item-name">{{ __('Balances') }}</span>
                                                </a>
                                            </li>
                                        @endif

                                        @if ($_current_role->isAllowed('property-management', 'pending-audits'))
                                            <li class="nav-item">
                                                @php
                                                $routeParams = [
                                                'filterByPendingAudits' => 1,
                                                'office' => 2,
                                                ];
                                                @endphp
                                                <a class=""
                                                    href="{{ route('property-management-transactions.general', $routeParams) }}">
                                                    <span class="item-name">{{ __('Pending Audits') }}: Mazatlan</span>
                                                </a>
                                            </li>

                                            <li class="nav-item">
                                                @php
                                                $routeParams = [
                                                'filterByPendingAudits' => 1,
                                                'office' => 1,
                                                ];
                                                @endphp
                                                <a class=""
                                                    href="{{ route('property-management-transactions.general', $routeParams) }}">
                                                    <span class="item-name">{{ __('Pending Audits') }}: Puerto
                                                        Vallarta</span>
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </li>
                    @endif

                    @if ($_current_role->isAllowed('property-bookings', 'heading-menu'))
                        <li>
                            <div>
                                <div>
                                    <!-- label for menu and sidebar menu for responsive -->
                                    <label class="toggle" for="dropdownMenuBooking">
                                        {{ __('Reservations') }}
                                    </label>
                                    <a href="{{ route('property-bookings') }}">
                                        <i class="nav-icon mr-2 i-Calendar-4"></i>
                                        {{ __('Reservations') }}
                                    </a>

                                    <!-- dropdown menu -->
                                    <input type="checkbox" id="dropdownMenuBooking">
                                    <ul>
                                        @if ($_current_role->isAllowed('property-bookings', 'index'))
                                            <li class="nav-item">
                                                <a class="" href="#" data-toggle="modal"
                                                    data-target="#app-property-bookings-selection-modal">
                                                    <span class="item-name">{{ __('New Reservation') }}</span>
                                                </a>
                                            </li>

                                            <li class="nav-item">
                                                <a class="" href="{{ route('property-bookings.arrivals-departures') }}">
                                                    <span class="item-name">{{ __('Arrivals & Departures') }}</span>
                                                </a>
                                            </li>

                                            <li class="nav-item">
                                                <a class="" href="{{ route('property-bookings') }}">
                                                    <span class="item-name">{{ __('All') }}</span>
                                                </a>
                                            </li>
                                        @endif

                                        @if ($_current_role->isAllowed('property-bookings', 'agents'))
                                            <li class="nav-item">
                                                <a class="" href="{{ route('agents') }}">
                                                    <span class="item-name">{{ __('Agents') }}</span>
                                                </a>
                                            </li>
                                        @endif

                                        @if ($_current_role->isAllowed('property-bookings', 'commisions'))
                                            <li class="nav-item">
                                                <a class="" href="#">
                                                    <span class="item-name">{{ __('Commisions') }}</span>
                                                </a>
                                            </li>
                                        @endif

                                        @if ($_current_role->isAllowed('property-bookings', 'general-availability'))
                                            <li class="nav-item">
                                                <a class=""
                                                    href="{{ route('property-bookings.general-availability') }}">
                                                    <span class="item-name">{{ __('General Availability') }}</span>
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </li>
                    @endif

                    @if ($_current_role->isAllowed('cleaning-services', 'heading-menu'))
                        <li>
                            <div>
                                <div>
                                    <!-- label for menu and sidebar menu for responsive -->
                                    <label class="toggle" for="dropdownMenuBooking">
                                        {{ __('Cleaning Services') }}
                                    </label>
                                    <a href="{{ route('cleaning-services') }}">
                                        <i class="nav-icon mr-2 i-Green-House"></i>
                                        {{ __('Cleaning Services') }}
                                    </a>

                                    <!-- dropdown menu -->
                                    <input type="checkbox" id="dropdownMenuBooking">
                                    <ul>
                                        @if ($_current_role->isAllowed('cleaning-services', 'index'))
                                            <li class="nav-item">
                                                <a class="" href="{{ route('cleaning-services') }}">
                                                    <span class="item-name">{{ __('All') }}</span>
                                                </a>
                                            </li>
                                        @endif

                                        @if (!isRole('owner'))
                                            @if ($_current_role->isAllowed('cleaning-services', 'monthly-batch'))
                                                <li class="nav-item">
                                                    <a class="" href="{{ route('cleaning-services.monthly-batch') }}">
                                                        <span class="item-name">{{ __('Monthly Batch') }}</span>
                                                    </a>
                                                </li>
                                            @endif
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </li>
                    @endif

                    @if ($_current_role->isAllowed('human-resources', 'heading-menu'))
                        <li>
                            <div>
                                <div>
                                    <!-- label for menu and sidebar menu for responsive -->
                                    <label class="toggle" for="dropdownMenuBooking">
                                        {{ __('H.R.') }}
                                    </label>
                                    <a href="#">
                                        <i class="nav-icon mr-2 i-Professor"></i>
                                        {{ __('H.R.') }}
                                    </a>

                                    <!-- dropdown menu -->
                                    <input type="checkbox" id="dropdownMenuBooking">
                                    <ul>
                                        @if ($_current_role->isAllowed('human-resources', 'index'))
                                            <li class="nav-item">
                                                <a class="" href="{{ route('human-resources') }}">
                                                    <span class="item-name">{{ __('All') }}</span>
                                                </a>
                                            </li>
                                        @endif

                                        @if ($_current_role->isAllowed('human-resources', 'directory'))
                                            <li class="nav-item">
                                                <a class="" href="{{ route('human-resources.directory') }}">
                                                    <span class="item-name">{{ __('Directory') }}</span>
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </li>
                    @endif

                    @if ($_current_role->isAllowed('reporting', 'heading-menu'))
                        <li>
                            <div>
                                <div>
                                    <!-- label for menu and sidebar menu for responsive -->
                                    <label class="toggle" for="dropdownMenuBooking">
                                        {{ __('Reporting') }}
                                    </label>
                                    <a href="{{ route('reporting') }}">
                                        <i class="nav-icon mr-2 i-Newspaper"></i>
                                        {{ __('Reporting') }}
                                    </a>
                                </div>
                            </div>
                        </li>
                    @endif

                    @if ($_current_role->isAllowed('pages', 'heading-menu'))
                        <li>
                            <div>
                                <div>
                                    <!-- label for menu and sidebar menu for responsive -->
                                    <label class="toggle" for="dropdownMenuBooking">
                                        {{ __('Public') }}
                                    </label>
                                    <a href="#">
                                        <i class="nav-icon mr-2 i-Internet"></i>
                                        {{ __('Public') }}
                                    </a>

                                    <!-- dropdown menu -->
                                    <input type="checkbox" id="dropdownMenuBooking">
                                    <ul>
                                        @if ($_current_role->isAllowed('pages', 'index'))
                                            <li class="nav-item">
                                                <a class="" href="{{ route('pages') }}">
                                                    <span class="item-name">{{ __('Pages') }}</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="" href="{{ route('payment-methods') }}">
                                                    <span class="item-name">{{ __('Payment Methods') }}</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="" href="{{ route('testimonials') }}">
                                                    <span class="item-name">{{ __('Testimonials') }}</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="" href="{{ route('agencies') }}">
                                                    <span class="item-name">{{ __('Agencies') }}</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="" href="{{ route('lgbts') }}">
                                                    <span class="item-name">{{ __('LGBT') }}</span>
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </li>
                    @endif

                    @if ($_current_role->isAllowed('settings', 'heading-menu'))
                        <li>
                            <div>
                                <div>
                                    <!-- label for menu and sidebar menu for responsive -->
                                    <label class="toggle" for="dropdownMenuBooking">
                                        {{ __('Settings') }}
                                    </label>
                                    @if (isRole('owner'))
                                        <a href="#">
                                        @else
                                            <a href="{{ route('settings') }}">
                                    @endif
                                    <i class="nav-icon mr-2 i-Gear-2"></i>
                                    {{ __('Settings') }}
                                    </a>

                                    <!-- dropdown menu -->
                                    <input type="checkbox" id="dropdownMenuBooking">
                                    <ul>
                                        @if ($_current_role->isAllowed('settings', 'users'))
                                            <li class="nav-item">
                                                <a class="" href="{{ route('users') }}">
                                                    <span class="item-name">{{ __('Users') }}</span>
                                                </a>
                                            </li>
                                        @endif

                                        @if ($_current_role->isAllowed('settings', 'workgroups'))
                                            <li class="nav-item">
                                                <a class="" href="{{ route('workgroups') }}">
                                                    <span class="item-name">{{ __('Workgroups') }}</span>
                                                </a>
                                            </li>
                                        @endif

                                        @if ($_current_role->isAllowed('settings', 'roles'))
                                            <li class="nav-item">
                                                <a class="" href="{{ route('roles') }}">
                                                    <span class="item-name">{{ __('Roles') }}</span>
                                                </a>
                                            </li>
                                        @endif

                                        @if ($_current_role->isAllowed('settings', 'cities'))
                                            <li class="nav-item">
                                                <a class="" href="{{ route('cities') }}">
                                                    <span class="item-name">{{ __('Cities') }}</span>
                                                </a>
                                            </li>
                                        @endif

                                        @if ($_current_role->isAllowed('settings', 'offices'))
                                            <li class="nav-item">
                                                <a class="" href="{{ route('offices') }}">
                                                    <span class="item-name">{{ __('Offices') }}</span>
                                                </a>
                                            </li>
                                        @endif

                                        @if ($_current_role->isAllowed('settings', 'zones'))
                                            <li class="nav-item">
                                                <a class="" href="{{ route('zones') }}">
                                                    <span class="item-name">{{ __('Zones') }}</span>
                                                </a>
                                            </li>
                                        @endif

                                        @if ($_current_role->isAllowed('settings', 'buildings'))
                                            <li class="nav-item">
                                                <a class="" href="{{ route('buildings') }}">
                                                    <span class="item-name">{{ __('Buildings') }}</span>
                                                </a>
                                            </li>
                                        @endif

                                        @if ($_current_role->isAllowed('settings', 'contacts'))
                                            <li class="nav-item">
                                                <a class="" href="{{ route('contacts') }}">
                                                    <span class="item-name">{{ __('Contacts') }}</span>
                                                </a>
                                            </li>
                                        @endif

                                        @if ($_current_role->isAllowed('settings', 'amenities'))
                                            <li class="nav-item">
                                                <a class="" href="{{ route('amenities') }}">
                                                    <span class="item-name">{{ __('Amenities') }}</span>
                                                </a>
                                            </li>
                                        @endif

                                        @if ($_current_role->isAllowed('settings', 'transaction-types'))
                                            <li class="nav-item">
                                                <!-- <a class="" href="{{ route('transaction-types') }}"> -->
                                                <a class="" href="{{ route('transaction-types') }}">
                                                    <span class="item-name">{{ __('Transaction Types') }}</span>
                                                </a>
                                            </li>
                                        @endif

                                        @if ($_current_role->isAllowed('settings', 'cleaning-options'))
                                            <li class="nav-item">
                                                <a class="" href="{{ route('cleaning-options') }}">
                                                    <span class="item-name">{{ __('Cleaning Options') }}</span>
                                                </a>
                                            </li>
                                        @endif

                                        @if ($_current_role->isAllowed('settings', 'damage-deposits'))
                                            <li class="nav-item">
                                                <a class="" href="{{ route('damage-deposits') }}">
                                                    <span class="item-name">{{ __('Damage Deposits') }}</span>
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </li>
                    @endif

                    @if (!isProduction() && $_current_role->isAllowed('contractors', 'heading-menu'))
                        @php
                        /* DISABLED TEMPORARILY
                        <li>
                            <div>
                                <div>
                                    <!-- label for menu and sidebar menu for responsive -->
                                    <label class="toggle" for="dropdownMenuBooking">
                                        {{ __('Contractors') }}
                                    </label>
                                    <a href="{{ route('contractors') }}">
                                        <i class="nav-icon mr-2 i-Engineering"></i>
                                        {{ __('Contractors') }}
                                    </a>

                                    <!-- dropdown menu -->
                                    <input type="checkbox" id="dropdownMenuBooking">
                                    <ul>
                                        @if ($_current_role->isAllowed('contractors', 'index'))
                                            <li class="nav-item">
                                                <a class="" href="{{ route('contractors') }}">
                                                    <span class="item-name">{{ __('All') }}</span>
                                                </a>
                                            </li>
                                        @endif

                                        @if ($_current_role->isAllowed('contractors', 'services'))
                                            <li class="nav-item">
                                                <a class="" href="{{ route('contractors-services') }}">
                                                    <span class="item-name">{{ __('Services') }}</span>
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </li>
                        */
                        @endphp
                    @endif

                    <!-- menu fit controller -->
                    <li id="app-menu-fit-li">
                        <div>
                            <div>
                                <!-- label for menu and sidebar menu for responsive -->
                                <label class="toggle" for="dropdownMenuBooking">
                                    ...
                                </label>
                                <a href="#">
                                    <i class="nav-icon mr-2 i-Align-Justify-All"></i>
                                    <div id="app-menu-fit-label">...</div>
                                </a>

                                <!-- dropdown menu -->
                                <input type="checkbox" id="dropdownMenuBooking">
                                <ul>
                                </ul>
                            </div>
                        </div>
                    </li>

                </ul>


            </div>
        </div>
    </div>

</div>

<!-- transaction bulk modal -->
<div class="modal fade" id="app-pm-property-selection-modal" tabindex="-1" role="dialog"
    aria-labelledby="app-pm-property-selection-modal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Select Property') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="app-pm-property-selection-container"
                    data-url="{{ route('property-management.get-property-selection') }}">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    {{ __('Close') }}
                </button>
            </div>
        </div>
    </div>
</div>

<!-- booking modal -->
<div class="modal fade" id="app-property-bookings-selection-modal" tabindex="-1" role="dialog"
    aria-labelledby="app-property-bookings-selection-modal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Check Availability') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="app-property-bookings-selection-container"
                    data-url="{{ route('property-bookings.get-property-selection') }}">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    {{ __('Close') }}
                </button>
            </div>
        </div>
    </div>
</div>

<!-- calendar modal -->
<div class="modal fade app-modal-calendar" id="modal-availability-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog app-table-file-modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">

                </h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="card">
                    <div class="card-header">
                        <div class="btns-container">
                            <a href="#" data-source="" data-year="" data-target="#modal-availability-modal"
                                class="modal-prev btn btn-dark">
                                {{ __('Prev Year') }}
                            </a>
                            <span class="modal-current"></span>
                            <a href="#" data-source="" data-year="" data-target="#modal-availability-modal"
                                class="modal-next btn btn-dark">
                                {{ __('Next Year') }}
                            </a>
                        </div>
                    </div>
                    <div class="legends">
                        <span class="available-square"></span>&nbsp;Available
                        &nbsp;&nbsp;&nbsp;
                        <span class="booked-square"></span>&nbsp;Booked
                    </div>
                    <div class="card-body">
                        <div class="calendar-container">
                            <div class="app-modal-calendar-container"
                                data-url="{{ route('public.availability-modal') }}">
                                ...
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--=============== Horizontal bar End ================-->
