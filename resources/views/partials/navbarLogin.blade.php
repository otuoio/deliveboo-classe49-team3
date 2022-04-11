<div class="app-header header-shadow">
    <div class="app-header__logo">
        {{-- <div class="header__pane ml-auto">
            <div>
                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div> --}}
    </div>
    <div class="app-header__content text-white">
        <div class="app-header-right">
            <a href="{{ route('guest.index') }}">
                <div class="body">
                    <span>
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                    <div class="base">
                        <span></span>
                        <div class="face"></div>
                    </div>
                </div>
                <h1 class="upper-index d-none d-md-block">Deliveboo</h1>
            </a>
            <div class="longfazers">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>
            @guest
                <ul class="header-menu nav upper-index">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('login') }}">{{ __('Accedi') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('register') }}">{{ __('Registrati') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item">
                        <span class="nav-link text-white">{{ Auth::user()->name }}</span>
                    </li>
                    <li class="nav-item me-1">
                        <a class="nav-link text-white" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                                                                                    document.getElementById('logout-form').submit();">
                            {{ __('Esci') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                    <li class="nav-item">
                        <div class="user-image-container">
                            <img class="user-image" src="{{ asset('storage/' . Auth::user()->image) }}" alt="">
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</div>
