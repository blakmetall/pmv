@php
    $_current_role = \App\Helpers\Role::current();
    $_roles = \App\Helpers\Role::available();
   
@endphp

<div class="main-header">
    <div class="logo">
        <img src="{{asset('assets/images/logo.png')}}" alt="">
    </div>

    <div class="menu-toggle">
        <div></div>
        <div></div>
        <div></div>
    </div>

    <div style="margin: auto"></div>

    <div class="header-part-right">

        <!-- Language switch -->
        <div class="dropdown">
            <i class="i-Globe text-muted header-icon" role="button" id="languageSwitcherBtn" data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false"></i>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="languageSwitcherBtn">
                <div class="dropdown-header">
                    <i class="i-Globe mr-1"></i> LANGUAGE
                </div>

                <a class="dropdown-item" href="{{ route('language.update', ['es']) }}">Español</a>
                <a class="dropdown-item" href="{{ route('language.update', ['en']) }}">English</a>
            </div>
        </div>

        <!-- Full screen toggle -->
        <i class="i-Full-Screen header-icon d-none d-sm-inline-block" data-fullscreen></i>


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


        <!-- Role switch -->
        <div class="dropdown">
            <i class="i-Two-Windows text-muted header-icon" role="button" id="roleSwitcherButton" data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false"></i>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="roleSwitcherButton">
                <div class="dropdown-header">
                    <i class="i-Eye-Visible mr-1"></i> VIEW AS
                </div>
                
                @foreach ($_roles as $role)
                    <a class="dropdown-item" href="{{ route('roles.update-active', [$role->role_id])}}">

                        @if ($_current_role->id == $role->role_id)
                            <b>{{ $role->name }}</b>
                        @else
                            {{ $role->name }}
                        @endif
                        
                    </a>
                @endforeach
            </div>
        </div>


        <!-- User avatar dropdown -->
        <div class="dropdown">
            <div class="user col align-self-end">
                <img src="{{asset('assets/images/faces/1.jpg')}}" id="userDropdown" alt="" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <div class="dropdown-header">
                        <i class="i-Lock-User mr-1"></i> JOHN DOE
                    </div>

                    <a class="dropdown-item" href="{{ route('users.edit', auth()->user()) }}">Account</a>

                    @php
                        if(! auth()->user()->profile ){
                            $urlProfile = route('profiles.create');
                        }else{
                            $urlProfile = route('profiles.edit', auth()->user()->profile->id);
                        }
                    @endphp

                    <a class="dropdown-item" href="{{ $urlProfile }}">Profile</a>

                    <!-- logout -->
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        {{ __('Sign out') }}
                    </a> <!-- test -->
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>

                </div>
            </div>
        </div>
    </div>

</div>
<!-- header top menu end -->
