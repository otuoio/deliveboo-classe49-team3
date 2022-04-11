<div class="app-header header-shadow">
    <div class="app-header__logo second-index">
        <div class="header__pane ml-auto">
            <div>
                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <div class="app-header__content text-white first-index">
        <div class="app-header-left">
        </div>
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
                <h1 class="upper-index  d-none d-md-block">Deliveboo</h1>
            </a>
            <div class="longfazers first-index">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>
            <div class="header-btn-lg pe-0 upper-index">
                <div class="widget-content p-0">
                    <div class="widget-content-wrapper d-flex">
                        <div class="widget-content-left header-user-info d-none d-md-block">
                            <div class="widget-heading">
                                {{ Auth::user()->name }}
                            </div>
                        </div>
                        <div class="widget-content-left ms-3">
                            <div class="btn-group">
                                <a data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                    class="p-0 btn d-flex align-items-center">
                                    <div class="user-img">
                                        @if (Auth::user()->image == null)
                                            <img class="rounded-circle"
                                                src="{{ asset('storage/uploads/default/default_user.jpg') }}" alt="">
                                        @else
                                            <img class="rounded-circle"
                                                src="{{ asset('storage/' . Auth::user()->image) }}" alt="">
                                        @endif
                                    </div>
                                    <i class="fa fa-angle-down ms-2"></i>
                                </a>
                                <div tabindex="-1" role="menu" aria-hidden="true"
                                    class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                        {{ __('Esci') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
