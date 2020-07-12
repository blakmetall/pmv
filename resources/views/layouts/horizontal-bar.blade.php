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
                                            {{  __('Properties') }}
                                        </label>
                                        <a href="{{ route('properties') }}">
                                            <i class="nav-icon mr-2 i-Home1"></i>
                                            {{  __('Properties') }}
                                        </a>

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

                                                @if ($_current_role->isAllowed('properties', 'property-management'))
                                                    <li class="nav-item">
                                                        <a class="" href="{{ route('property-management.general') }}">
                                                            <span class="item-name">{{ __('Property Management') }}</span>
                                                        </a>
                                                    </li>
                                                @endif

                                                @if ($_current_role->isAllowed('properties', 'balances'))
                                                    <li class="nav-item">
                                                        <a class="" href="{{ route('property-management-balances.general') }}">
                                                            <span class="item-name">{{ __('Balances') }}</span>
                                                        </a>
                                                    </li>
                                                @endif

                                                {{-- @if ($_current_role->isAllowed('properties', 'transactions'))
                                                    <li class="nav-item">
                                                        <a class="" href="{{ route('property-management-transactions.general') }}">
                                                            <span class="item-name">{{ __('Transactions') }}</span>
                                                        </a>
                                                    </li>
                                                @endif --}}

                                                @if ($_current_role->isAllowed('properties', 'pending-audits'))
                                                    <li class="nav-item">
                                                        @php 
                                                            $routeParams = ['filterByPendingAudits' => 1]; 
                                                        @endphp
                                                        <a class="" href="{{ route('property-management-transactions.general', $routeParams) }}">
                                                            <span class="item-name">{{ __('Pending Audits') }}</span>
                                                        </a>
                                                    </li>
                                                @endif
                                            </ul>
                                        @endif
                                    </div>
                            </div>
                        </li>
                    @endif

                    @if (!isProduction() && $_current_role->isAllowed('bookings', 'heading-menu'))
                        <li>
                            <div>
                                <div>
                                    <!-- label for menu and sidebar menu for responsive -->
                                    <label class="toggle" for="dropdownMenuBooking">
                                        {{ __('Reservations') }}
                                    </label>
                                    <a href="{{ route('bookings') }}">
                                        <i class="nav-icon mr-2 i-Calendar-4"></i>
                                        {{ __('Reservations') }}
                                    </a>

                                    <!-- dropdown menu -->
                                    <input type="checkbox" id="dropdownMenuBooking">
                                    <ul>
                                        @if ($_current_role->isAllowed('bookings', 'index'))
                                            <li class="nav-item">
                                                <a class="" href="{{ route('bookings') }}">
                                                    <span class="item-name">{{ __('All') }}</span>
                                                </a>
                                            </li>
                                        @endif

                                        @if ($_current_role->isAllowed('bookings', 'requests'))
                                            <li class="nav-item">
                                                <a class="" href="#">
                                                    <span class="item-name">{{ __('Requests') }}</span>
                                                </a>
                                            </li>
                                        @endif

                                        @if ($_current_role->isAllowed('bookings', 'agents'))
                                            <li class="nav-item">
                                                <a class="" href="{{ route('agents') }}">
                                                    <span class="item-name">{{ __('Agents') }}</span>
                                                </a>
                                            </li>
                                        @endif

                                        @if ($_current_role->isAllowed('booking', 'commisions'))
                                            <li class="nav-item">
                                                <a class="" href="#">
                                                    <span class="item-name">{{ __('Commisions') }}</span>
                                                </a>
                                            </li>
                                        @endif

                                        @if ($_current_role->isAllowed('bookings', 'general-availability'))
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

                    @if ($_current_role->isAllowed('settings', 'heading-menu'))
                        <li>
                            <div>
                                <div>
                                    <!-- label for menu and sidebar menu for responsive -->
                                    <label class="toggle" for="dropdownMenuBooking">
                                        {{ __('Settings') }}
                                    </label>
                                    <a href="{{ route('settings') }}">
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

                                        @if ($_current_role->isAllowed('settings', 'zones'))
                                            <li class="nav-item">
                                                <a class="" href="{{ route('zones') }}">
                                                    <span class="item-name">{{ __('Zones') }}</span>
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
<!--=============== Horizontal bar End ================-->
