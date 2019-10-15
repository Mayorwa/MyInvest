<style>
.dhsco-nav .main-menu li a{
    padding: 15px;
}
.dhsco-nav .main-menu li .active{
    background: #ccc;
    color: #f15e75;
    border-top: 4px solid;
}
.dhsco-nav .main-menu li .active:before{
    width: 0;
    height: 3px;
    content: '';
    margin: 0 auto;
}
#code{
    text-align: center;
    padding-left: 5em;
    letter-spacing: 1rem;
}
</style>
<div id="homey-main-search" class="main-search " data-sticky="0" style="padding: 0px;">
    @if($usr)
    <div class="container">

        <header id="homey_nav_sticky" class="header-nav" data-sticky="1" style="border: none;">
            <div class="container-fluid">
                <div class="header-inner table-block">

                    <div class="header-comp-nav">
                        <nav class="navi dhsco-nav">
                            @if($usr->type == "user")
                                <ul id="main-menu" class="main-menu p-0">

                                <li id="menu-item-692" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-692">
                                    @if(Request::is('user/dashboard'))
                                        <a href="{{URL('user/dashboard')}}" class="active" style="line-height: unset;">
                                    @else
                                        <a href="{{URL('user/dashboard')}}" style="line-height: unset;">
                                    @endif
                                            <i class="fa fa-clipboard"></i>
                                            Overview
                                        </a>
                                </li>
                                <li id="menu-item-692" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-692">
                                    @if(Request::is('user/dashboard/profile*'))
                                        <a href="{{URL('user/dashboard/profile')}}" class="active" style="line-height: unset;">
                                    @else
                                        <a href="{{URL('user/dashboard/profile')}}" style="line-height: unset;">
                                            @endif
                                            <i class="far fa-id-badge"></i>
                                            Profile
                                        </a>
                                </li>
                                <li id="menu-item-692" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-692">
                                    @if(Request::is('user/dashboard/transaction*'))
                                        <a href="{{URL('user/dashboard/transaction  ')}}" class="active" style="line-height: unset;">
                                            @else
                                                <a href="{{URL('user/dashboard/transaction')}}" style="line-height: unset;">
                                                    @endif
                                                    <i class="far fa-credit-card"></i>
                                                    Transaction
                                                </a>
                                </li>
                                <li id="menu-item-692" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-692">
                                    @if(Request::is('user/dashboard/settings*'))
                                        <a href="{{URL('user/dashboard/settings')}}" class="active" style="line-height: unset;">
                                    @else
                                        <a href="{{URL('user/dashboard/settings')}}" style="line-height: unset;">
                                            @endif
                                            <i class="fas fa-sliders-h"></i>
                                            Settings
                                        </a>
                                </li>
                                <li id="menu-item-692" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-692">
                                    <a href="#" style="line-height: unset;" class="text-muted">
                                        <i class="fa fa-book"></i>
                                        Documentation
                                    </a>
                                </li>
                            </ul>
                            @elseif($usr->type == "realtor" || $usr->type == "consultant")
                                <ul id="main-menu" class="main-menu">

                                    <li id="menu-item-692" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-692">
                                        @if(Request::is('agency/dashboard'))
                                            <a href="{{URL('agency/dashboard')}}" class="active" style="line-height: unset;">
                                                @else
                                                    <a href="{{URL('agency/dashboard')}}" style="line-height: unset;">
                                                        @endif
                                                        <i class="fa fa-clipboard"></i>
                                                        Overview
                                                    </a>
                                    </li>
                                    <li id="menu-item-692" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-692">
                                        @if(Request::is('agency/dashboard/profile*'))
                                            <a href="{{URL('agency/dashboard/profile')}}" class="active" style="line-height: unset;">
                                                @else
                                                    <a href="{{URL('agency/dashboard/profile')}}" style="line-height: unset;">
                                                        @endif
                                                        <i class="far fa-id-badge"></i>
                                                        Profile
                                                    </a>
                                    </li>
                                    <li id="menu-item-692" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-692">
                                        @if(Request::is('agency/dashboard/transaction*'))
                                            <a href="{{URL('agency/dashboard/transaction  ')}}" class="active" style="line-height: unset;">
                                                @else
                                                    <a href="{{URL('agency/dashboard/transaction')}}" style="line-height: unset;">
                                                        @endif
                                                        <i class="far fa-credit-card"></i>
                                                        Transaction
                                                    </a>
                                    </li>
                                    <li id="menu-item-692" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-692">
                                        @if(Request::is('agency/dashboard/settings*'))
                                            <a href="{{URL('agency/dashboard/settings')}}" class="active" style="line-height: unset;">
                                                @else
                                                    <a href="{{URL('agency/dashboard/settings')}}" style="line-height: unset;">
                                                        @endif
                                                        <i class="fas fa-sliders-h"></i>
                                                        Settings
                                                    </a>
                                    </li>
                                </ul>
                            @else
                                <ul id="main-menu" class="main-menu">

                                    <li id="menu-item-692" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-692">
                                        @if(Request::is('company/dashboard'))
                                            <a href="{{URL('company/dashboard')}}" class="active" style="line-height: unset;">
                                                @else
                                                    <a href="{{URL('company/dashboard')}}" style="line-height: unset;">
                                                        @endif
                                                        <i class="fa fa-clipboard"></i>
                                                        Overview
                                                    </a>
                                    </li>
                                    <li id="menu-item-692" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-692">
                                        @if(Request::is('company/dashboard/profile*'))
                                            <a href="{{URL('company/dashboard/profile')}}" class="active" style="line-height: unset;">
                                                @else
                                                    <a href="{{URL('company/dashboard/profile')}}" style="line-height: unset;">
                                                        @endif
                                                        <i class="far fa-id-badge"></i>
                                                        Profile
                                                    </a>
                                    </li>
                                    <li id="menu-item-692" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-692">
                                        @if(Request::is('company/dashboard/estates*'))
                                            <a href="{{URL('company/dashboard/estates')}}" class="active" style="line-height: unset;">
                                                @else
                                                    <a href="{{URL('company/dashboard/estates')}}" style="line-height: unset;">
                                                        @endif
                                                        <i class="fas fa-city"></i>
                                                        Estates/Properties
                                                    </a>
                                    </li>
                                    <li id="menu-item-692" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-692">
                                        @if(Request::is('company/dashboard/settings*'))
                                            <a href="{{URL('company/dashboard/settings')}}" class="active" style="line-height: unset;">
                                                @else
                                                    <a href="{{URL('company/dashboard/settings')}}" style="line-height: unset;">
                                                        @endif
                                                        <i class="fas fa-sliders-h"></i>
                                                        Settings
                                                    </a>
                                    </li>
{{--                                    <li id="menu-item-692" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-692">--}}
{{--                                        @if(Request::is('company/dashboard/transaction*'))--}}
{{--                                        <a href="{{URL('company/dashboard/transaction')}}" class="active" style="line-height: unset;">--}}
{{--                                        @else--}}
{{--                                        <a href="{{URL('company/dashboard/transaction')}}" style="line-height: unset;">--}}
{{--                                            @endif--}}
{{--                                            <i class="far fa-credit-card"></i>--}}
{{--                                            Transaction--}}
{{--                                        </a>--}}
{{--                                    </li>--}}

                                </ul>
                            @endif
                        </nav>
                    </div>
                </div>
            </div>
        </header>


    </div>
        @endif
</div>
