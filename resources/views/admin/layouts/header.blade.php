<header class="top-header">
    <nav class="navbar navbar-expand">
        <div class="mobile-toggle-icon d-xl-none" style="visibility: hidden!important;">
            <i class="bi bi-list"></i>
        </div>
        <div class="search-toggle-icon d-xl-none ms-auto" style="visibility: hidden!important;">
            <i class="bi bi-search"></i>
        </div>
        <form class="searchbar d-none d-xl-flex ms-auto" style="visibility: hidden!important;">
            <div class="position-absolute top-50 translate-middle-y search-icon ms-3"><i class="bi bi-search"></i></div>
            <input class="form-control" type="text" placeholder="Type here to search">
            <div class="position-absolute top-50 translate-middle-y d-block d-xl-none search-close-icon"><i class="bi bi-x-lg"></i></div>
        </form>
        <div class="top-navbar-right ms-3">
            <ul class="navbar-nav align-items-center">
                <li class="nav-item dropdown dropdown-large">
                    <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">
                        <div class="user-setting d-flex align-items-center gap-1">
                            <div class="user-name d-none d-sm-block">{{ auth()->user()->name }}</div>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        {{--<li>
                            <a class="dropdown-item" href="#">
                                <div class="d-flex align-items-center">
                                    <div class="setting-icon"><i class="bi bi-gear-fill"></i></div>
                                    <div class="setting-text ms-3"><span>Setting</span></div>
                                </div>
                            </a>
                        </li>--}}
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item"  href="{{ route('logout') }}"
                               onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                <div class="d-flex align-items-center">
                                    <div class="setting-icon"><i class="bi bi-lock-fill"></i></div>
                                    <div class="setting-text ms-3"><span>Çıkış yap</span></div>
                                </div>
                            </a>
                        </li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
