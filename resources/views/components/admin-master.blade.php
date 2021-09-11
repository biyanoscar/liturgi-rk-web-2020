<!DOCTYPE html>
<html lang="en">

@include('partials.admin.head')

<body class="animsition">
    <div class="page-wrapper">
        @include('partials.admin.header_mobile')
        
        @include('partials.admin.menu_sidebar')

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            @include('partials.admin.header_desktop')

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

    @include('partials.admin.scripts')

</body>

</html>
<!-- end document-->