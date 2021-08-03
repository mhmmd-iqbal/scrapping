<!-- HEADER MOBILE-->
<header class="header-mobile d-block d-lg-none">
    <div class="header-mobile__bar">
        <div class="container-fluid">
            <div class="header-mobile-inner">
                <a class="logo" href="index.html">
                    <img src="images/icon/logo.png" alt="CoolAdmin" />
                </a>
                <button class="hamburger hamburger--slider" type="button">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <nav class="navbar-mobile">
        <div class="container-fluid">
            <ul class="navbar-mobile__list list-unstyled">
                <li class="{{ (request()->is('/')) ? 'active' : '' }}">
                    <a href="{{route('dashboard')}} ">
                        <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                </li>
                <li class="has-sub {{ (request()->is('master*')) ? 'active' : '' }}">
                    <a class="js-arrow" href="#">
                        <i class="fas  fa-th-large"></i>Master Data</a>
                    <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                        {{-- <li>
                            <a href="{{route('roles.index')}} ">Data Role User</a>
                        </li> --}}
                        <li>
                            <a href="{{route('users.index')}}">Data User</a>
                        </li>
                        <li>
                            <a href="{{route('brands.index')}}">Data Brand</a>
                        </li>
                    </ul>
                </li>
                <li class="{{ (request()->is('crawling')) ? 'active' : '' }}">
                    <a href="{{route('crawling.index')}}">
                        <i class="fas fa-tasks"></i>Crawling Data</a>
                </li>
                <li class="{{ (request()->is('algorithm')) ? 'active' : '' }}">
                    <a href="{{route('algorithm.index')}}">
                        <i class="fas fa-code"></i>Algoritma</a>
                </li>
            </ul>
        </div>
    </nav>
</header>
<!-- END HEADER MOBILE-->

<!-- MENU SIDEBAR-->
<aside class="menu-sidebar d-none d-lg-block">
    <div class="logo">
        <a href="#">
            <img src="images/icon/logo.png" alt="Cool Admin" />
        </a>
    </div>
    <div class="menu-sidebar__content js-scrollbar1">
        <nav class="navbar-sidebar">
            <ul class="list-unstyled navbar__list">
                <li class="{{ (request()->is('/')) ? 'active' : '' }}">
                    <a href="{{route('dashboard')}} ">
                        <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                </li>
                @can('isAdmin')
                <li class="has-sub {{ (request()->is('master*')) ? 'active' : '' }}">
                    <a class="js-arrow" href="#">
                        <i class="fas  fa-th-large"></i>Master Data</a>
                    <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                        {{-- <li>
                            <a href="{{route('roles.index')}} ">Data Role User</a>
                        </li> --}}
                        <li>
                            <a href="{{route('users.index')}}">Data User</a>
                        </li>
                        <li>
                            <a href="{{route('brands.index')}}">Data Brand</a>
                        </li>
                    </ul>
                </li>
                @endcan
                <li class="{{ (request()->is('crawling')) ? 'active' : '' }}">
                    <a href="{{route('crawling.index')}}">
                        <i class="fas fa-tasks"></i>Crawling Data</a>
                </li>
                <li class="{{ (request()->is('algorithm')) ? 'active' : '' }}">
                    <a href="{{route('algorithm.index')}}">
                        <i class="fas fa-code"></i>Algoritma</a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
<!-- END MENU SIDEBAR-->