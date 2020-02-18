<div class="horizontal-bar-wrap">
    <div class="header-topnav">
        <div class="container-fluid">
            <div class=" topnav rtl-ps-none" id="" data-perfect-scrollbar data-suppress-scroll-x="true">
                <ul class="menu float-left">

                    <li>
                        <div>
                            <div>
                                <a href="#">
                                    <i class="nav-icon mr-2 i-Calendar-2"></i>
                                    {{ trans('messages.menu-option-calendar') }}
                                </a>
                            </div>
                        </div>
                    </li>

                    <li>
                        <div>
                            <div>
                                <!-- label for menu and sidebar menu for responsive -->
                                <label class="toggle" for="dropdownMenuBooking">
                                    {{ trans('messages.menu-option-booking') }}
                                </label>
                                <a href="">
                                    <i class="nav-icon mr-2 i-Calendar-4"></i>
                                    {{ trans('messages.menu-option-booking') }}
                                </a>

                                <!-- dropdown menu -->
                                <input type="checkbox" id="dropdownMenuBooking">
                                <ul>
                                    <li class="nav-item">
                                        <a class="" href="#">
                                            <span class="item-name">{{ trans('messages.menu-option-booking-all') }}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="" href="#">
                                            <span class="item-name">{{ trans('messages.menu-option-booking-request') }}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="" href="#">
                                            <span class="item-name">{{ trans('messages.menu-option-booking-agents') }}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="" href="#">
                                            <span class="item-name">{{ trans('messages.menu-option-booking-commisions') }}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="" href="#">
                                            <span class="item-name">{{ trans('messages.menu-option-booking-general') }}</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>

                    <li>
                        <div>
                                <div>
                                    <!-- label for menu and sidebar menu for responsive -->
                                    <label class="toggle" for="dropdownMenuProperties">
                                        Properties
                                    </label>
                                    <a href="">
                                        <i class="nav-icon mr-2 i-Home1"></i>
                                        Properties
                                    </a>

                                    <!-- dropdown menu -->
                                    <input type="checkbox" id="dropdownMenuBooking">
                                    <ul>
                                        <li class="nav-item">
                                            <a class="" href="{{ route('properties-all') }}">
                                                <span class="item-name">{{ trans('messages.menu-option-properties-all') }}</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="" href="{{ route('types-all') }} ">
                                                <span class="item-name">{{ trans('messages.menu-option-properties-types') }}</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                        </div>
                    </li>

                    <li>
                        <div>
                            <div>
                                <!-- label for menu and sidebar menu for responsive -->
                                <label class="toggle" for="dropdownMenuBooking">
                                    {{ trans('messages.menu-option-property-management') }}
                                </label>
                                <a href="">
                                    <i class="nav-icon mr-2 i-Home-2"></i>
                                    {{ trans('messages.menu-option-property-management') }}
                                </a>

                                <!-- dropdown menu -->
                                <input type="checkbox" id="dropdownMenuBooking">
                                <ul>
                                    <li class="nav-item">
                                        <a class="" href="#">
                                            <span class="item-name">{{ trans('messages.menu-option-property-management-all') }}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="" href="#">
                                            <span class="item-name">{{ trans('messages.menu-option-property-management-balances') }}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="" href="#">
                                            <span class="item-name">{{ trans('messages.menu-option-property-management-transactions') }}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="" href="#">
                                            <span class="item-name">{{ trans('messages.menu-option-property-management-pending') }}</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>

                    <li>
                        <div>
                            <div>
                                <!-- label for menu and sidebar menu for responsive -->
                                <label class="toggle" for="dropdownMenuBooking">
                                    {{ trans('messages.menu-option-cleaning-services') }}
                                </label>
                                <a href="">
                                    <i class="nav-icon mr-2 i-Green-House"></i>
                                    {{ trans('messages.menu-option-cleaning-services') }}
                                </a>

                                <!-- dropdown menu -->
                                <input type="checkbox" id="dropdownMenuBooking">
                                <ul>
                                    <li class="nav-item">
                                        <a class="" href="#">
                                            <span class="item-name">{{ trans('messages.menu-option-cleaning-services-all') }}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="" href="#">
                                            <span class="item-name">{{ trans('messages.menu-option-property-services-staff') }}</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>

                    <li>
                        <div>
                            <div>
                                <!-- label for menu and sidebar menu for responsive -->
                                <label class="toggle" for="dropdownMenuBooking">
                                    {{ trans('messages.menu-option-contractor') }}
                                </label>
                                <a href="">
                                    <i class="nav-icon mr-2 i-Engineering"></i>
                                    {{ trans('messages.menu-option-contractor') }}
                                </a>

                                <!-- dropdown menu -->
                                <input type="checkbox" id="dropdownMenuBooking">
                                <ul>
                                    <li class="nav-item">
                                        <a class="" href="#">
                                            <span class="item-name">{{ trans('messages.menu-option-contractor-all') }}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="" href="#">
                                            <span class="item-name">{{ trans('messages.menu-option-contractor-services') }}</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>

                    <li>
                        <div>
                            <div>
                                <!-- label for menu and sidebar menu for responsive -->
                                <label class="toggle" for="dropdownMenuBooking">
                                    Users
                                </label>
                                <a href="#">
                                    <i class="nav-icon mr-2 i-Mens"></i>
                                    Users
                                </a>

                                <!-- dropdown menu -->
                                <input type="checkbox" id="dropdownMenuBooking">
                                <ul>
                                    <li class="nav-item">
                                        <a class="" href="{{ route('users') }}">
                                            <span class="item-name">All</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="" href="#">
                                            <span class="item-name">Staff Groups</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="" href="{{ route('roles') }}">
                                            <span class="item-name">Roles</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>

                    <li>
                        <div>
                            <div>
                                <!-- label for menu and sidebar menu for responsive -->
                                <label class="toggle" for="dropdownMenuBooking">
                                    Reporting
                                </label>
                                <a href="#">
                                    <i class="nav-icon mr-2 i-Newspaper"></i>
                                    Reporting
                                </a>

                                <!-- dropdown menu -->
                                <input type="checkbox" id="dropdownMenuBooking">
                                <ul>
                                    <li class="nav-item">
                                        <a class="" href="#">
                                            <span class="item-name">All</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>

                    <li>
                        <div>
                            <div>
                                <!-- label for menu and sidebar menu for responsive -->
                                <label class="toggle" for="dropdownMenuBooking">
                                    Settings
                                </label>
                                <a href="#">
                                    <i class="nav-icon mr-2 i-Gear-2"></i>
                                    Settings
                                </a>

                                <!-- dropdown menu -->
                                <input type="checkbox" id="dropdownMenuBooking">
                                <ul>
                                    <li class="nav-item">
                                        <a class="" href="#">
                                            <span class="item-name">Cities</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="" href="{{ route('zones') }}">
                                            <span class="item-name">{{__('Zones')}}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="" href="{{ route('amenities') }}">
                                            <span class="item-name">{{ __('Amenities') }}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="" href="{{ route('transaction-types') }}">
                                            <span class="item-name">{{ __('Transaction Types') }}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="" href="#">
                                            <span class="item-name">Rental Cleaning Options</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="" href="#">
                                            <span class="item-name">Damage Deposits</span>
                                        </a>
                                    </li>
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
