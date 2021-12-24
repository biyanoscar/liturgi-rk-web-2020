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

                <li>
                    <a href="{{route('choirs.index')}}">
                        <i class="fa fa-music"></i>Paduan Suara</a>
                </li>

                <li>
                    <a href="{{route('songs.index')}}">
                        <i class="fa fa-book"></i>Lagu</a>
                </li>

                @if(auth()->user()->userHasRole('Liturgi'))
                    <li>
                        <a href="{{route('mass_schedules_all.index')}}">
                            <i class="far fa-calendar-alt"></i>Misa All</a>
                    </li>

                    <li class="has-sub {{ request()->is('summary') ? 'active' : '' }}">
                        <a class="js-arrow" href="#">
                            <i class="fa fa-table"></i>Summary</a>
                        <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                            <li>
                                <a href="{{route('summary.choirSchedule')}}">Jadwal Padus</a>
                            </li>
                            
                        </ul>
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

                    <li>
                        <a href="{{route('settings.index')}}">
                            <i class="fa fa-cog"></i>Setting</a>
                    </li>
                @endif

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