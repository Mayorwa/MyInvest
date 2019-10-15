<!-- Header -->
<div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed " >
    <button class="kt-header-menu-wrapper-close" id="kt_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
    <div class="kt-header-menu-wrapper" id="kt_header_menu_wrapper">
    </div>

    <div class="kt-header__topbar">

        <div class="kt-header__topbar-item kt-header__topbar-item--user">
            <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="0px,0px">
                <div class="kt-header__topbar-user">
                    <span class="kt-header__topbar-welcome kt-hidden-mobile">Hi,</span>
                    <span class="kt-header__topbar-username kt-hidden-mobile">{{$usr->name}}</span>
                    <img class="kt-hidden" alt="Pic" src="{{URL::asset('assets2/media/users/300_25.jpg')}}" />
                    <!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
                    <span class="kt-badge kt-badge--username kt-badge--unified-success kt-badge--lg kt-badge--rounded kt-badge--bold">{{$usr->name[0]}}</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End inner Haeader -->
