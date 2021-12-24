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

                <li class="{{ request()->is('choirs') ? 'active' : '' }}">
                    <a href="{{route('choirs.index')}}">
                        <i class="fa fa-music"></i>Paduan Suara</a>
                </li>

                <li class="{{ request()->is('songs') ? 'active' : '' }}">
                    <a href="{{route('songs.index')}}">
                        <i class="fa fa-book"></i>Lagu</a>
                </li>



                @if(auth()->user()->userHasRole('Liturgi'))
                    <li class="{{ request()->is('mass_schedules_all') ? 'active' : '' }}">
                        <a href="{{route('mass_schedules_all.index')}}">
                            <i class="far fa-calendar-alt"></i>Misa All</a>
                    </li>

                    <li class="has-sub {{ request()->is('summary') ? 'active' : '' }}">
                        <a class="js-arrow" href="#">
                            <i class="fa fa-table"></i>Summary</a>
                        <ul class="list-unstyled navbar__sub-list js-sub-list">
                            <li>
                                <a href="{{route('summary.choirSchedule')}}">Jadwal Padus</a>
                            </li>
                            
                        </ul>
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

                    <li class="{{ request()->is('settings') ? 'active' : '' }}">
                        <a href="{{route('settings.index')}}">
                            <i class="fa fa-cog"></i>Setting</a>
                    </li>

                @endif
                

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