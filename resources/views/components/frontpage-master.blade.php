<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link href="{{asset('css/app.css')}}" rel="stylesheet" media="all">

    <link href="{{asset('css/front.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('vendor/aos/aos.css')}}" rel="stylesheet" media="all">
    <!-- <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet"> -->

    <title>Liturgi RK</title>

    <style>
        /* Show it is fixed to the top */
        body {
            padding-top: 4.5rem;
        }
        .blank_row
        {
            height: 10px !important; /* overwrites any other rules */
            background-color: #FFFFFF;
        }
    </style>
    
    @yield('styles')
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="/">Liturgi RK</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item {{ request()->is('/') ? 'active' : '' }}">
                    <a class="nav-link" href="{{route('front_page.index')}}">Home </a>
                  </li>
                  <li class="nav-item {{ request()->is('jadwal-petugas') ? 'active' : '' }}">
                    <a class="nav-link" href="{{route('front_page.schedule')}}">Jadwal Petugas</a>
                  </li>
                  <li class="nav-item {{ request()->is('teks-misa') ? 'active' : '' }}">
                    <a class="nav-link" href="{{route('front_page.show_mass_text')}}">Teks Misa</a>
                  </li>

            </ul>

            <ul class="navbar-nav ml-auto">
                @if (Route::has('login'))
                @auth
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('mass_schedules.index') }}">Admin <span class="sr-only">(current)</span></a>
                </li>
                @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                </li>
                @if (Route::has('register'))
                <!-- <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">Register</a>
                </li> -->
                @endif
                @endauth
                @endif
            </ul>


        </div>
    </nav>
    <main role="main" class="container">
        @yield('content')
    </main>

    <!-- ======= Footer ======= -->
    <footer id="footer">



        <div class="container d-md-flex py-4">

            <div class="mr-md-auto text-center text-md-left">
                <div class="copyright">
                    &copy; Copyright <strong><span>Biyan</span></strong>. All Rights Reserved
                </div>

            </div>

        </div>
    </footer><!-- End Footer -->

    <script src="{{asset('js/app.js')}}"></script>

    <!-- <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script> -->
    <script src="{{asset('vendor/aos/aos.js')}}"></script>

    <script>
        AOS.init();
    </script>
</body>

</html>
