@vite(['resources/css/nav.css'])
@vite(['resources/js/nav.ts'])

<header>
    <!-- Header Start -->
    <div class="header-area">
        <div class="main-header ">
            <div class="header-bottom  header-sticky">
                <div class="container">
                    <div class="row align-items-center">
                        <!-- Logo -->
                        <div class="col-xl-2 col-lg-2">
                            <a href="{{ route('home') }}">
                                <div class="logo-container">
                                    <div class="logo">
                                        <img src="{{ asset('images/nav/lery-logo-web.png') }}" alt="">
                                    </div>
                                    <div class="logo-text">
                                        <span class="lery">{{__('nav.lery') }}</span>
                                        <br/>
                                        <span class="technologies">{{__('nav.technologies') }}</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div id="burger-menu">
                            <span></span>
                        </div>

                        <div class="col-xl-10 col-lg-10">
                            <div class="menu-wrapper  d-flex align-items-center justify-content-end">
                                <!-- Main-menu -->
                                <div class="main-menu d-none d-lg-block">
                                    <nav>

                                        <ul id="navigation">
                                            <li><a href="{{ route('home') }}">{{ __('nav.home') }}</a></li>
                                            <li><a href="{{ route('offers') }}">{{ __('nav.offers') }}</a></li>

                                            @if (Auth::check())
                                                <li><a href="{{ route('dashboard') }}"
                                                       class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">{{ __('nav.dashboard') }}</a>
                                                </li>
                                            @endif
                                            <li><a href="{{ route('contact') }}">{{ __('nav.contact') }}</a></li>
                                            <li><a href="#">
                                                    <div class="user-icon">
                                                        <div class="user-icon-orange"></div>
                                                    </div>
                                                </a>
                                                <ul class="submenu">
                                                    @if (Auth::check())
                                                        <li><a href="{{ route('profile.edit') }}">{{ __('nav.profile') }}</a>
                                                        </li>

                                                        <li><a href="{{ route('logout') }}"
                                                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('nav.disconnect') }}</a>
                                                        </li>
                                                        <form id="logout-form" method="POST"
                                                              action="{{ route('logout') }}" style="display: none;">
                                                            @csrf
                                                        </form>
                                                    @else
                                                        <li><a href="{{ route('login') }}">{{ __('nav.login') }}</a>
                                                        </li>
                                                        <li><a href="{{ route('register') }}">{{ __('nav.register') }}</a>
                                                        </li>
                                                    @endif

                                                </ul>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                                <!-- Header-btn -->
                                <div class="header-right-btn d-none d-lg-block">
                                    @if (Auth::check())
                                        <a href="{{ route('dashboard') }}" class="btn header-btn">{{__('nav.create_session') }}</a>
                                    @else
                                        <a href="{{ route('register') }}"
                                           class="btn header-btn">{{ __('nav.register') }}</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- mobile version -->
                        <div id="menu">
                            <ul>
                                <li><a href="{{ route('home') }}">{{ __('nav.home') }}</a></li>
                                <li><a href="{{ route('offers') }}">{{ __('nav.offers') }}</a></li>

                                @if (Auth::check())
                                    <li><a href="{{ route('dashboard') }}"
                                           class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">{{ __('nav.dashboard') }}</a>
                                    </li>
                                @endif
                                <li><a href="{{ route('contact') }}">{{ __('nav.contact') }}</a></li>
                                <li>
                                    <ul class="submenu">
                                        @if (Auth::check())
                                            <li><a href="{{ route('profile.edit') }}">{{ __('nav.profile') }}</a>
                                            </li>

                                            <li><a href="{{ route('logout') }}"
                                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('nav.disconnect') }}</a>
                                            </li>
                                            <form id="logout-form" method="POST"
                                                  action="{{ route('logout') }}" style="display: none;">
                                                @csrf
                                            </form>
                                        @else
                                            <li><a href="{{ route('login') }}">{{ __('nav.login') }}</a>
                                            </li>
                                            <li><a href="{{ route('register') }}">{{ __('nav.register') }}</a>
                                            </li>
                                        @endif
                                    </ul>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->
</header>
