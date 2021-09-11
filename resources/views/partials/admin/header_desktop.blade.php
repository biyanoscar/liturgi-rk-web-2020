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