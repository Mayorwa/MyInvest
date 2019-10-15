<style>
    .dhsco-drop-a a{
        line-height: unset;
        padding-top:10px;
    }
</style>
    <header id="homey_nav_sticky" class="header-nav hidden-sm hidden-xs" data-sticky="1">
        <div class="container-fluid" style="padding-left: 120px; padding-right: 120px; ">
            <div class="header-inner table-block">
                <div class="header-comp-logo">
                    <h1>
                        <a class="homey_logo" href="{{URL('/')}}">
                            <img src="{{URL::secure_asset('logos/dark.png')}}" alt="Myycrib" title="MyyCrib">
                        </a>
                    </h1>
                </div>

                <div class="header-comp-nav text-right">
                    <nav class="navi">
                        <ul id="main-menu" class="main-menu">
                            <li id="menu-item-692" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-692">
                                <a href="{{URL('/listings')}}">Listings</a>
                            </li>
                            <li id="menu-item-692" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-692">
                                <a href="#">About Us</a>
                            </li>
                            <li id="menu-item-692" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-692">
                                <a href="{{URL('investment-flow')}}">Investment Flow</a>
                            </li>
                            {{--<li id="menu-item-692" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-692">
                                <a href="{{URL('faq')}}">FAQ</a>
                            </li>--}}
                        </ul>
                    </nav>
                </div>

                <div class="header-comp-right">
                    <div class="account-login">
                        @if($usr !== null)
                            @if($usr->type !== "company")
                                <ul class="login-register list-inline">
                                    <li class="dropdown show">
                                        <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <b style="font-family: Col-Med, sans-serif; font-size:16px;margin-right: 5px;">{{$usr->name}}</b><i class="fa fa-user" style="    font-size: 20px;"></i></a>
                                        <div class="dropdown-menu dhsco-drop-a" style="padding: 10px 15px;" aria-labelledby="dropdownMenuLink">
                                            <a class="dropdown-item" href="{{URL('user/dashboard')}}"><i class="far fa-id-badge" style="margin-right: 10px"></i> Dashboard</a>
                                            <a class="dropdown-item" href="{{URL('auth/logout')}}"><i class="fas fa-sign-out-alt" style="margin-right: 10px"></i> Logout</a>
                                        </div>
                                    </li>
                                </ul>
                            @else
                                <ul class="login-register list-inline">
                                    <li class="dropdown show">
                                        <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <b style="font-family: Col-Med, sans-serif; font-size:16px;margin-right: 5px;">{{$usr->company->name}}</b><i class="fa fa-user" style="    font-size: 20px;"></i></a>
                                        <div class="dropdown-menu dhsco-drop-a" style="padding: 10px 15px;" aria-labelledby="dropdownMenuLink">
                                            <a class="dropdown-item" href="{{URL('company/dashboard')}}"><i class="far fa-id-badge" style="margin-right: 10px"></i> Dashboard</a>
                                            <a class="dropdown-item" href="{{URL('auth/logout')}}"><i class="fas fa-sign-out-alt" style="margin-right: 10px"></i> Logout</a>
                                        </div>
                                    </li>
                                </ul>
                            @endif
                        @else
                            <ul class="login-register list-inline">
                                <li>
                                    <a href="{{URL('auth/agency')}}">Agent</a>
                                </li>
                            </ul>
                            <ul class="login-register list-inline">
                                <li><a href="{{URL('auth/get-access')}}">Company</a></li>
                            </ul>
                            <a href="{{URL('/auth/login')}}" class="btn btn-add-new-listing btn-invest-red">Invest Now</a>

                            <ul class="login-register list-inline">
                                <li><a href="{{URL('contact-us')}}">Contact Us</a></li>
                            </ul>
                        @endif


                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- mobile header -->
    <header class="header-nav header-mobile hidden-md hidden-lg">
        <div class="header-mobile-wrap">
            <div class="container">
                <div class="row">
                    <div class="col-xs-3">
                        <button type="button" id="navbtn" class="btn btn-mobile-nav mobile-main-nav" data-toggle="collapse" aria-expanded="false">
                            <i class="fa fa-bars" aria-hidden="true"></i>
                        </button><!-- btn-mobile-nav -->
                    </div>
                    <div class="col-xs-6">
                        <div class="mobile-logo text-center">
                            <h1>
                                <a href="{{URL('/')}}">
                                    <img src="{{URL::secure_asset('logos/icon-light.png')}}" alt="MYYINVEST" title="MYYINVEST">
                                </a>
                            </h1>
                        </div><!-- mobile-logo -->
                    </div>
                    <div class="col-xs-3">
                        <div class="user-menu text-right">
                            <button type="button" id="profBtn" class="btn btn-mobile-nav user-mobile-nav" data-toggle="collapse" aria-expanded="false">
                                <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                            </button>
                        </div><!-- user-menu -->
                    </div>
                </div><!-- row -->
            </div><!-- container -->
        </div><!-- header-mobile-wrap -->

        <div class="container-fluid">
            <div class="row">
                <div class="mobile-nav-wrap">
                    <nav id="mobile-nav" class="nav-dropdown main-nav-dropdown collapse navbar-collapse">
                        <ul id="mobile-menu" class="mobile-menu">
                            <li id="menu-item-692" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-692">
                                <a href="#">Listings</a>
                            </li>
                            <li id="menu-item-692" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-692">
                                <a href="#">About Us</a>
                            </li>
                            <li id="menu-item-692" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-692">
                                <a href="{{URL('contact')}}">Contact Us</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div><!-- container -->
        <div class="container-fluid">
            <div class="row">
                <div class="user-nav-wrap">
                    <nav id="user-nav" class="nav-dropdown main-nav-dropdown collapse navbar-collapse">
                        @if($usr !== null)
                            @if($usr->type !== "company")
                                <ul class="login-register list-inline">
                                    <li class="dropdown show" class="black">
                                        <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <b style="font-family: Col-Med, sans-serif; font-size:16px;margin-right: 5px;">{{$usr->name}}</b><i class="fa fa-user" style="    font-size: 20px;"></i></a>
                                        <div class="dropdown-menu dhsco-drop-a" style="padding: 10px 15px;" aria-labelledby="dropdownMenuLink">
                                            <a class="dropdown-item" href="{{URL('user/dashboard')}}"><i class="far fa-id-badge" style="margin-right: 10px"></i> Dashboard</a>
                                            <a class="dropdown-item" href="{{URL('auth/logout')}}"><i class="fas fa-sign-out-alt" style="margin-right: 10px"></i> Logout</a>
                                        </div>
                                    </li>
                                </ul>
                            @else
                                <ul class="login-register list-inline">
                                    <li class="dropdown show">
                                        <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <b style="font-family: Col-Med, sans-serif; font-size:16px;margin-right: 5px;">{{$usr->company->name}}</b><i class="fa fa-user" style="    font-size: 20px;"></i></a>
                                        <div class="dropdown-menu dhsco-drop-a" style="padding: 10px 15px;" aria-labelledby="dropdownMenuLink">
                                            <a class="dropdown-item" href="{{URL('company/dashboard')}}"><i class="far fa-id-badge" style="margin-right: 10px"></i> Dashboard</a>
                                            <a class="dropdown-item" href="{{URL('auth/logout')}}"><i class="fas fa-sign-out-alt" style="margin-right: 10px"></i> Logout</a>
                                        </div>
                                    </li>
                                </ul>
                            @endif
                        @else
                            <ul class="login-register list-inline">
                                <li class="black">
                                    <a href="{{URL('auth/agency')}}">Agent</a>
                                </li>
                            </ul>
                            <ul class="login-register list-inline">
                                <li class="black"><a href="{{URL('auth/get-access')}}">Company</a></li>
                            </ul>
                            <a href="{{URL('/auth/login')}}" class="btn btn-add-new-listing btn-invest-red">Invest Now</a>

                            <ul class="login-register list-inline">
                                <li class="black"><a href="{{URL('contact-us')}}">Contact Us</a></li>
                            </ul>
                        @endif
                    </nav><!-- nav-collapse -->

                </div><!-- mobile-nav-wrap -->
            </div>
        </div><!-- container -->
    </header>

