<div class="sticky">
    <div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
    <div class="app-sidebar">
        <div class="side-header">
            <a class="header-brand1" href="/">
                <img src="{{ URL::asset('assets/images/brand/logo.png')}}" class="header-brand-img desktop-logo" alt="logo">
                <img src="{{ URL::asset('assets/images/brand/logo-1.png')}}" class="header-brand-img toggle-logo"
                     alt="logo">
                <img src="{{ URL::asset('assets/images/brand/logo-2.png')}}" class="header-brand-img light-logo" alt="logo">
                <img src="{{ URL::asset('assets/images/brand/logo-3.png')}}" class="header-brand-img light-logo1"
                     alt="logo">
            </a>
            <!-- LOGO -->
        </div>
        <div class="main-sidemenu">
            <div class="slide-left disabled" id="slide-left"><svg xmlns="http://www.w3.org/2000/svg"
                                                                  fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                    <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z" />
                </svg></div>
            <ul class="side-menu">
                <li class="slide">
                    <a class="side-menu__item has-link" data-bs-toggle="slide" href="/"><i
                            class="side-menu__icon fe fe-home"></i><span
                            class="side-menu__label">Dashboard</span></a>
                </li>

                @if(Auth::check())
                    @if(Auth::user()->is_mover)
                        <li class="slide">
                            <a class="side-menu__item has-link" data-bs-toggle="slide" href="/order/my/orders"><i
                                    class="side-menu__icon fa fa-list"></i><span
                                    class="side-menu__label">My orders</span></a>
                        </li>
                    @endif
                    @if(Auth::user()->is_driver)
                        <li class="slide">
                            <a class="side-menu__item has-link" data-bs-toggle="slide" href="/application/my/applications"><i
                                    class="side-menu__icon fa fa-address-card-o"></i><span
                                    class="side-menu__label">My applications</span></a>
                        </li>
                    @endif
                    <li class="slide">
                        <a class="side-menu__item has-link" data-bs-toggle="slide" href="/deal/my/deals"><i
                                class="side-menu__icon fa fa-diamond"></i><span
                                class="side-menu__label">My Deals</span></a>
                    </li>
                    <li class="slide">
                        <a class="side-menu__item has-link" data-bs-toggle="slide" href="/profile/list"><i
                                class="side-menu__icon fa fa-truck"></i><span
                                class="side-menu__label">Company</span></a>
                    </li>

                @else
                    <li style="text-align: center; padding-top: 30px">
                        If you whant this order, ypu need:<br/><br/>
                        <a href="/auth/login">Login</a>
                        <br/>or<br/>
                        <a href="auth/register">Registration</a>
                    </li>
                @endif
            </ul>
            <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191"
                                                           width="24" height="24" viewBox="0 0 24 24">
                    <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z" />
                </svg></div>
        </div>
    </div>
    <!--/APP-SIDEBAR-->
</div>
