<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Scripts -->
    @yield('script')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>@yield('documentTitle')</title>
</head>

<body>
    <div class="app-container body-tabs-shadow fixed-sidebar fixed-header">
        @include('partials.navbarAdmin')

        <div class="app-main">
            <div class="app-sidebar sidebar-shadow">
                <div class="app-header__logo">
                    <div class="logo-src"></div>
                    <div class="header__pane ml-auto">
                        <div>
                            <button type="button" class="hamburger close-sidebar-btn hamburger--elastic"
                                data-class="closed-sidebar" control-id="ControlID-17">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="app-header__mobile-menu">
                    <div>
                        <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
                <div class="app-header__menu">
                    <span>
                        <button type="button"
                            class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                            <span class="btn-icon-wrapper">
                                <i class="fa fa-ellipsis-v fa-w-6"></i>
                            </span>
                        </button>
                    </span>
                </div>
                <div class="scrollbar-sidebar ps">
                    <div class="app-sidebar__inner">
                        <ul class="vertical-nav-menu metismenu">
                            <li class="app-sidebar__heading">Amministrazione</li>
                            <li>
                                <a href="{{ route('admin.home') }}"
                                    class="{{ 'admin.home' === Route::currentRouteName() ? 'mm-active' : '' }}">
                                    <i class=" metismenu-icon fa-solid fa-chart-line"></i>
                                    Statistiche
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.dishes.index') }}"
                                    class="{{ 'admin.dishes.index' === Route::currentRouteName() ? 'mm-active' : '' }}">
                                    <i class="metismenu-icon fa-solid fa-burger"></i>
                                    Piatti
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.orders.index') }}"
                                    class="{{ 'admin.orders.index' === Route::currentRouteName() ? 'mm-active' : '' }}">
                                    <i class="metismenu-icon fa-solid fa-cart-shopping"></i>
                                    Ordini
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                        <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                    </div>
                    <div class="ps__rail-y" style="top: 0px; right: 0px;">
                        <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
                    </div>
                </div>
            </div>
            @yield('content')
        </div>
        <script src="https://maps.google.com/maps/api/js?sensor=true"></script>
    </div>
    @if ('admin.orders.index' === Route::currentRouteName())
        @yield('ordersPopup')
    @elseif ('admin.dishes.index' === Route::currentRouteName())
        @yield('dishesPopup')
    @endif



    <script>
        let collapseBtn = document.querySelector('.hamburger--elastic');
        let appContainer = document.querySelector('.app-container');
        let appHeader = document.querySelector('.app-header');
        let dropdownMenu = document.querySelector('.dropdown-menu');
        let sideBar = document.querySelector('.app-sidebar');

        /*TOGGLE HEADER STATE*/
        collapseBtn.addEventListener("click", function() {
            if (appContainer.classList.contains('closed-sidebar')) {
                appContainer.classList.remove('closed-sidebar');
            } else {
                appContainer.classList.add('closed-sidebar');
            };
            if (document.body.clientWidth < 992 && appContainer.classList.contains(
                    'sidebar-mobile-open')) {
                appContainer.classList.remove('sidebar-mobile-open');
            } else if (document.body.clientWidth < 992) {
                appContainer.classList.add('sidebar-mobile-open');
            }

        });

        window.addEventListener('resize', function(event) {
            let win = document.body.clientWidth;
            if (win < 1250) {
                appContainer.classList.add('closed-sidebar-mobile');
                appContainer.classList.add('closed-sidebar');
            } else {
                appContainer.classList.remove('closed-sidebar-mobile');
                appContainer.classList.remove('closed-sidebar');
            }
        }, true);

        document.addEventListener('DOMContentLoaded', function(event) {
            let win = document.body.clientWidth;
            if (win < 1250) {
                appContainer.classList.add('closed-sidebar-mobile');
                appContainer.classList.add('closed-sidebar');
            } else {
                appContainer.classList.remove('closed-sidebar-mobile');
                appContainer.classList.remove('closed-sidebar');
            }
        });
    </script>
</body>

</html>
