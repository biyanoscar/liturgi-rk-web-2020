<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>@yield('title')</title>

    <!-- Fontfaces CSS-->
    <link href="{{asset('css/font-face.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('vendor/font-awesome-4.7/css/font-awesome.min.css')}}" rel="stylesheet" media="all">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="{{asset('vendor/mdi-font/css/material-design-iconic-font.min.css')}}" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="{{asset('vendor/bootstrap-4.1/bootstrap.min.css')}}" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="{{asset('vendor/animsition/animsition.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('vendor/wow/animate.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('vendor/css-hamburgers/hamburgers.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('vendor/slick/slick.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('vendor/select2/select2.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('vendor/perfect-scrollbar/perfect-scrollbar.css')}}" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="{{asset('css/theme.css')}}" rel="stylesheet" media="all">

    <style>
        .account-dropdown .info .content {
            margin-left: 0px;
            padding: 11px 0;
            padding-left: 12px;
        }

        .table-data {
            height: auto;
        }

        #btn-logout {
            display: block;
            color: #333;
            padding: 15px 25px;
            font-size: 14px;
        }

        #icon-logout {
            line-height: 1;
            margin-right: 20px;
            font-size: 18px;
            vertical-align: middle;
        }

        @media (max-width: 991px) {
            .header-desktop {
                height: 70px;
            }

            .header-button {
                margin-top: 0px;
            }
        }
    </style>
    @yield('styles')

</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="{{route('mass_schedules.index')}}">
                            <h1>Liturgi RK</h1>
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
                        <li>
                            <a href="{{route('mass_schedules.index')}}">
                                <i class="far fa-calendar-alt"></i>Misa Harian</a>
                        </li>

                        <li>
                            <a href="{{route('mass_schedules.sunday_masses')}}">
                                <i class="far fa-calendar"></i>Misa Hari Minggu</a>
                        </li>

                        @if(auth()->user()->userHasRole('Liturgi'))
                            <li>
                                <a href="{{route('mass_schedules_all.index')}}">
                                    <i class="far fa-calendar-alt"></i>Misa All</a>
                            </li>

                            <li class="has-sub">
                                <a class="js-arrow" href="#">
                                    <i class="fas fa-user-friends"></i>Petugas</a>
                                <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                    <li>
                                        <a href="{{route('organists.index')}}">Organis</a>
                                    </li>
                                </ul>
                            </li>
                        @endif

                        <li>
                            <a href="{{route('choirs.index')}}">
                                <i class="fa fa-music"></i>Paduan Suara</a>
                        </li>

                        @if(auth()->user()->userHasRole('Admin'))
                        <li>
                            <a href="{{route('roles.index')}}">
                                <i class="fa fa-globe"></i>Roles</a>
                        </li>

                        <li>
                            <a href="{{route('users.index')}}">
                                <i class="fa fa-users"></i>Users</a>
                        </li>
                        @endif

                    </ul>
                </div>
            </nav>
        </header>
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="{{route('mass_schedules.index') }}">
                    <h1>Liturgi RK</h1>
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li class="{{ request()->is('mass_schedules') ? 'active' : '' }}">
                            <a href="{{route('mass_schedules.index')}}">
                                <i class="far fa-calendar-alt"></i>Misa Harian</a>
                        </li>

                        <li class="{{ request()->is('sunday_masses') ? 'active' : '' }}">
                            <a href="{{route('mass_schedules.sunday_masses')}}">
                                <i class="far fa-calendar"></i>Misa Hari Minggu</a>
                        </li>



                        @if(auth()->user()->userHasRole('Liturgi'))
                            <li class="{{ request()->is('mass_schedules_all') ? 'active' : '' }}">
                                <a href="{{route('mass_schedules_all.index')}}">
                                    <i class="far fa-calendar-alt"></i>Misa All</a>
                            </li>

                            <li class="has-sub {{ request()->is('organists') ? 'active' : '' }}">
                                <a class="js-arrow" href="#">
                                    <i class="fas fa-user-friends"></i>Petugas</a>
                                <ul class="list-unstyled navbar__sub-list js-sub-list">
                                    <li>
                                        <a href="{{route('organists.index')}}">Organis</a>
                                    </li>
                                    
                                </ul>
                            </li>

                        @endif

                        <li class="{{ request()->is('choirs') ? 'active' : '' }}">
                            <a href="{{route('choirs.index')}}">
                                <i class="fa fa-music"></i>Paduan Suara</a>
                        </li>

                        @if(auth()->user()->userHasRole('Admin'))
                        <li class="{{ request()->is('roles') ? 'active' : '' }}">
                            <a href="{{route('roles.index')}}">
                                <i class="fa fa-globe"></i>Roles</a>
                        </li>

                        <li class="{{ request()->is('users') ? 'active' : '' }}">
                            <a href="{{route('users.index')}}">
                                <i class="fa fa-users"></i>Users</a>
                        </li>
                        @endif

                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <form action=""></form>

                            <div class="header-button">
                                <div class="noti-wrap">



                                </div>
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">

                                        <div class="content">
                                            <a class="js-acc-btn" href="#">
                                                @if(Auth::check())
                                                {{auth()->user()->name}}
                                                @endif

                                            </a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">

                                                @if(Auth::check())
                                                <div class="content">
                                                    <h5 class="name">
                                                        <a href="#">{{auth()->user()->name}}</a>
                                                    </h5>
                                                    <span class="email">{{auth()->user()->email}}</span>
                                                </div>
                                                @endif
                                            </div>

                                            <div class="account-dropdown__footer">
                                                <!-- <a href="/logout">
                                                    <i class="zmdi zmdi-power"></i>Logout</a> -->
                                                <form action="/logout" method="POST">
                                                    @csrf
                                                    <button id="btn-logout"><i class="zmdi zmdi-power" id="icon-logout"></i>Logout</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
        <!-- END PAGE CONTAINER-->

    </div>

    <!-- Jquery JS-->
    <script src="{{asset('vendor/jquery-3.2.1.min.js')}}"></script>
    <!-- Bootstrap JS-->
    <script src="{{asset('vendor/bootstrap-4.1/popper.min.js')}}"></script>
    <script src="{{asset('vendor/bootstrap-4.1/bootstrap.min.js')}}"></script>
    <!-- Vendor JS       -->
    <script src="{{asset('vendor/slick/slick.min.js')}}">
    </script>
    <script src="{{asset('vendor/wow/wow.min.js')}}"></script>
    <script src="{{asset('vendor/animsition/animsition.min.js')}}"></script>
    <script src="{{asset('vendor/bootstrap-progressbar/bootstrap-progressbar.min.js')}}">
    </script>
    <script src="{{asset('vendor/counter-up/jquery.waypoints.min.js')}}"></script>
    <script src="{{asset('vendor/counter-up/jquery.counterup.min.js')}}">
    </script>
    <script src="{{asset('vendor/circle-progress/circle-progress.min.js')}}"></script>
    <script src="{{asset('vendor/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
    <script src="{{asset('vendor/chartjs/Chart.bundle.min.js')}}"></script>
    <script src="{{asset('vendor/select2/select2.min.js')}}">
    </script>

    <!-- Main JS-->
    <script src="{{asset('js/main.js')}}"></script>

    @yield('scripts')

</body>

</html>
<!-- end document-->