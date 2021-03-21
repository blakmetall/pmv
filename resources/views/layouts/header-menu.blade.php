@php

    $_current_lang = LanguageHelper::current();
    $_current_role = RoleHelper::current();
    $_available_roles = RoleHelper::available();
    $_profile = auth()->user()->profile;
@endphp

<div class="main-header">
    <div class="logo">
        <a href="{{ route('dashboard') }}">
            <img src="{{ asset('assets/app/logo-full.png') }}" alt="">
        </a>
    </div>

    <div class="menu-toggle">
        <div></div>
        <div></div>
        <div></div>
    </div>

    <div style="margin: auto"></div>

    <div class="header-part-right">

        @if (!isRole('owner') && $_current_role->isAllowed('dashboard', 'general-search'))
            <div class="dropdown d-none d-md-block pr-3">
                <div class="form-group">
                    <form action="{{ route('dashboard.general-search') }}" method="GET">
                        <div class="d-flex align-items-center app-top-search">
                            @php

                                $topSearchValue = isset($_GET['topSearch']) ? $_GET['topSearch'] : '';
                            @endphp
                            <input name="topSearch" value="{{ old('topSearch', $topSearchValue) }}" type="text"
                                class="form-control form-control-sm mr-3">
                            <select name="topFilter" class="form-control form-control-sm mr-3">
                                <option value="">{{ __('Select') }}</option>

                                @php

                                    $selected = isset($_GET['topFilter']) && $_GET['topFilter'] == 'properties' ? 'selected'
                                    : '';
                                @endphp
                                <option value="properties" {{ $selected }}>{{ __('Properties') }}</option>

                                @php

                                    $selected = isset($_GET['topFilter']) && $_GET['topFilter'] == 'bookings' ? 'selected' :
                                    '';
                                @endphp
                                <option value="bookings" {{ $selected }}>{{ __('Bookings') }}</option>

                                @php

                                    $selected = isset($_GET['topFilter']) && $_GET['topFilter'] == 'transactions' ?
                                    'selected' : '';
                                @endphp
                                <option value="transactions" {{ $selected }}>{{ __('Transactions') }}</option>
                            </select>
                            <button type="submit" class="btn btn-sm btn-dark">
                                <i class="i-Magnifi-Glass-"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @endif

        @if (!isProduction())
            <!-- Notification -->
            <div class="dropdown">
                <div class="badge-top-container" role="button" id="dropdownNotification" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <span class="badge badge-primary">
                        {{ '3' }}
                    </span>
                    <i class="i-Bell text-muted header-icon"></i>
                </div>

                <!-- Notification dropdown -->
                <div class="dropdown-menu dropdown-menu-right notification-dropdown rtl-ps-none"
                    aria-labelledby="dropdownNotification" data-perfect-scrollbar data-suppress-scroll-x="true">

                    <!-- single notification -->
                    <div class="dropdown-item d-flex">
                        <div class="notification-icon"></div>

                        <div class="notification-details flex-grow-1">
                            <p class="m-0 d-flex align-items-center">
                                <span>Title of notification</span>

                                <span class="flex-grow-1"></span>

                                <span class="text-small text-muted ml-auto">10 sec ago</span>
                            </p>
                            <p class="text-small text-muted m-0">
                                Lorem ipsum dolor sit amet, consectetur adipisicing...
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @endif


        <!-- Language switch -->
        <div class="dropdown">
            <i class="i-Globe header-icon" role="button" id="languageSwitcherBtn" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false"></i>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="languageSwitcherBtn">
                <div class="dropdown-header">
                    <i class="i-Globe mr-1"></i>
                    {{ __('LANGUAGE') }}
                </div>

                <a class="dropdown-item" href="{{ route('language.update', ['es']) }}">
                    @if ($_current_lang->id === 2)
                        <b>{{ __('Spanish') }}</b>
                    @else
                        {{ __('Spanish') }}
                    @endif
                </a>
                <a class="dropdown-item" href="{{ route('language.update', ['en']) }}">
                    @if ($_current_lang->id === 1)
                        <b>{{ __('English') }}</b>
                    @else
                        {{ __('English') }}
                    @endif
                </a>
            </div>
        </div>


        <!-- Role switch -->
        <div class="dropdown">
            <i class="i-Two-Windows header-icon" role="button" id="roleSwitcherButton" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false"></i>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="roleSwitcherButton">
                <div class="dropdown-header">
                    <i class="i-Eye-Visible mr-1"></i>
                    {{ __('VIEW AS') }}
                </div>

                @foreach ($_available_roles as $role)
                    <a class="dropdown-item" href="{{ route('roles.set-active', [$role->role_id]) }}">
                        @if ($_current_role->id == $role->role_id)
                            <b>{{ $role->name }}</b>
                        @else
                            {{ $role->name }}
                        @endif
                    </a>
                @endforeach
            </div>
        </div>


        <!-- Full screen toggle -->
        <i class="i-Full-Screen header-icon d-none d-sm-inline-block" data-fullscreen></i>


        <!-- User avatar dropdown -->
        <div class="dropdown">
            <div class="user col align-self-end">

                <i class="i-Administrator header-icon" role="button" id="userDropdown" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false"></i>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <div class="dropdown-header text-uppercase">
                        <i class="i-Lock-User mr-1"></i>
                        {{ $_profile->firstname }}
                        {{ $_profile->lastname }}
                    </div>

                    @if (isRole('super') || isRole('admin'))
                        <a class="dropdown-item" href="{{ route('login') }}">
                            {{ __('Login as') }}
                        </a>
                    @endif

                    <a class="dropdown-item" href="{{ route('account') }}">
                        {{ __('Account') }}
                    </a>

                    <a class="dropdown-item" href="{{ route('profile') }}">
                        {{ __('Profile') }}
                    </a>

                    <!-- logout -->
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        {{ __('Sign Out') }}
                    </a> <!-- test -->
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>

                    <hr class="mt-1 mb-1">

                    <a class="dropdown-item app-header-return-to-site-dropdown" href="{{ route('public.home') }}">
                        {{ __('Return to public site') }}
                    </a>

                </div>
            </div>
        </div>
    </div>

</div>
<!-- header top menu end -->
