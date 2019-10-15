<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <link rel="profile" href="http://gmpg.org/xfn/11">

    <title>{{ $title }}</title>
    <link rel="icon" type="image/png" href="{{ asset('logos/icon-dark.png') }}" sizes="60x60">
    <link rel='stylesheet' id='bootstrap-css'  href='{{URL::secure_asset('css/bootstrap.min7433.css')}}' type='text/css' media='all' />
    <script src="https://kit.fontawesome.com/1e3ac2580e.js"></script>
    <link rel='stylesheet' id='homey-main-css'  href='{{URL::secure_asset('css/main6f3e.css')}}' type='text/css' media='all' />
    <link rel='stylesheet' id='homey-styling-options-css'  href='{{URL::secure_asset('css/styling-options6f3e.css')}}' type='text/css' media='all' />
    <link rel='stylesheet' id='homey-style-css'  href='{{URL::secure_asset('css/style6f3e.css')}}' type='text/css' media='all' />
    <script type='text/javascript' src='{{URL::secure_asset('js/jquery/jquery4a5f.js')}}'></script>
    <script type="text/javascript" src="{{ asset('assets/js/jquery-3.1.1.min.js') }}"></script>
    <link rel='stylesheet' id='homey-style-css'  href='{{URL::secure_asset('css/styles.css')}}' type='text/css' media='all' />
{{--    <link rel="stylesheet" href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome-font-awesome.min.css">--}}
    <style type='text/css'>
        .alert{
            display: block !important;
        }
        .btn-invest-red{
            background-color: #ea2c28 !important;
            border-color: #ea2c28 !important;
            color: #fff;
        }
        body, address, li, dt, dd, .pac-container  {
            font-size: 14px;
            line-height: 24px;
            font-weight: 400;
            text-transform: none;
            letter-spacing: 0;
            font-family: Col-Light, sans-serif;
        }

        h1, h2, h3, h4, h5, h6, .banner-title {
            font-family: Col-Light, sans-serif;
            font-weight: 700;
            text-transform: inherit;
            text-align: inherit;
        }

        .navi > .main-menu > li > a,
        .account-loggedin,
        .login-register a {
            font-size: 14px;
            line-height: 80px;
            font-weight: 700;
            text-transform: none;
            font-family: Col-Light, sans-serif;
        }
        .menu-dropdown,
        .sub-menu li a,
        .navi .homey-megamenu-wrap > .sub-menu,
        .listing-navi .homey-megamenu-wrap > .sub-menu,
        .account-dropdown ul > li a {
            font-size: 14px;
            line-height: 1;
            font-weight: 700;
            text-transform: none;
            font-family: Col-Light, sans-serif;
        }


        a,
        .primary-color,
        .btn-primary-outlined,
        .btn-link,
        .super-host-flag {
            color: #f15e75;
        }
        .pagination > .active > a,
        .pagination > .active > a:focus,
        .pagination > .active > a:hover,
        .pagination > .active > span,
        .pagination > .active > span:focus,
        .pagination > .active > span:hover,
        .btn-primary-outlined,
        .searchform button {
            border-color: #f15e75;
        }

        .pagination > .active > a,
        .pagination > .active > a:focus,
        .pagination > .active > a:hover,
        .pagination > .active > span,
        .pagination > .active > span:focus,
        .pagination > .active > span:hover,
        .media-signal .signal-icon,
        .single-blog-article .meta-tags a,
        .title .circle-icon,
        .label-primary,
        .searchform button,
        .next-prev-block .prev-box,
        .next-prev-block .next-box,
        .dropdown-menu>.active>a, .dropdown-menu>.active>a:focus,
        .dropdown-menu>.active>a:hover,
        .tagcloud a,
        .title-section .avatar .super-host-icon {
            background-color: #f15e75;
        }

        .slick-prev,
        .slick-next {
            color: #f15e75;
            border: 1px solid #f15e75;
            background-color: transparent;
        }
        .slick-prev:before,
        .slick-next:before {
            color: #f15e75;
        }
        .slick-prev:hover:before,
        .slick-next:hover:before,
        .top-gallery-section .slick-prev:before,
        .top-gallery-section .slick-next:before {
            color: #fff;
        }

        .header-slider .slick-prev,
        .header-slider .slick-next,
        .top-gallery-section .slick-prev,
        .top-gallery-section .slick-next {
            border: 1px solid #f15e75;
            background-color: #f15e75;
        }
        .nav-tabs > li.active > a {
            box-shadow: 0px -2px 0px 0px inset #f15e75;
        }

        a:hover,
        a:focus,
        a:active,
        .btn-primary-outlined:focus,
        .crncy-lang-block > li:hover a,
        .crncy-lang-block .dropdown-menu li:hover {
            color: #f58d9d;
        }

        .pagination > li > a:hover,
        .pagination > li > span:hover,
        .table-hover > tbody > tr:hover,
        .search-auto-complete li:hover,
        .btn-primary-outlined:hover,
        .btn-primary-outlined:active,
        .item-tools .dropdown-menu > li > a:hover,
        .tagcloud a:hover,
        .pagination-main a:hover,
        .page-links a:hover {
            background-color: #f58d9d;
        }
        .pagination > li > a:hover,
        .pagination > li > span:hover,
        .pagination-main a:hover,
        .page-links a:hover  {
            border: 1px solid #f58d9d;
        }

        .slick-prev:focus, .slick-prev:active,
        .slick-next:focus,
        .slick-next:active {
            color: #f58d9d;
            border: 1px solid #f58d9d;
            background-color: transparent;
        }
        .slick-prev:hover,
        .slick-next:hover {
            background-color: #f58d9d;
            border: 1px solid #f58d9d;
            color: #fff;
        }

        .header-slider .slick-prev:focus,
        .header-slider .slick-next:active {
            border: 1px solid #f58d9d;
            background-color: #f58d9d;
        }
        .header-slider .slick-prev:hover,
        .header-slider .slick-next:hover {
            background-color: rgba(241, 94, 117, 0.65);
            border: 1px solid #f58d9d;
        }

        .secondary-color,
        .btn-secondary-outlined,
        .taber-nav li.active a,
        .saved-search-block .saved-search-icon,
        .block-title .help,
        .custom-actions .btn-action,
        .daterangepicker .input-mini.active + i,
        .daterangepicker td.in-range,
        .payment-list-detail-btn {
            color: #54c4d9;
        }

        .daterangepicker td.active,
        .daterangepicker td.active.end-date,
        .homy-progress-bar .progress-bar-inner,
        .fc-event,
        .property-calendar .current-day,
        .label-secondary,
        .wallet-label {
            background-color: #54c4d9;
        }

        .availability-section .search-calendar .days li.day-available.current-day {
            background-color: #54c4d9 !important;
        }

        .daterangepicker .input-mini.active,
        .daterangepicker td.in-range,
        .msg-unread {
            background-color: rgba(84, 196, 217, 0.2);
        }

        .msgs-reply-list .msg-me {
            background-color: rgba(84, 196, 217, 0.1) !important;
        }

        .control input:checked ~ .control-text {
            color: #54c4d9;
        }
        .control input:checked ~ .control__indicator {
            background-color: #7ed2e2;
            border-color: #54c4d9;
        }
        .control input:checked:focus ~ .control__indicator,
        .control input:checked:active ~ .control__indicator {
            background-color: #54c4d9;
            border-color:#54c4d9;
        }
        .control input:focus ~ .control__indicator {
            background-color: #7ed2e2;
            border-color:#54c4d9;
        }

        .open > .btn-default.dropdown-toggle,
        .custom-actions .btn-action,
        .daterangepicker .input-mini.active,
        .msg-unread {
            border-color: #54c4d9;
        }

        .bootstrap-select .btn:focus,
        .bootstrap-select .btn:active {
            border-color: #54c4d9 !important;
        }
        .main-search-calendar-wrap .days li.selected,
        .main-search-calendar-wrap .days li:hover:not(.day-disabled),
        .single-listing-booking-calendar-js .days li.selected,
        .single-listing-booking-calendar-js .days li:hover:not(.day-disabled) {
            background-color: #54c4d9 !important;
            color: #fff
        }
        .main-search-calendar-wrap .days li.in-between,
        .single-listing-booking-calendar-js .days li.in-between {
            background-color: rgba(84, 196, 217, 0.2)!important;
        }
        .single-listing-booking-calendar-js .days li.homey-not-available-for-booking:hover {
            background-color: transparent !important;
            color: #949ca5;
        }

        .taber-nav li:hover a,
        .payment-list-detail-btn:hover,
        .payment-list-detail-btn:focus {
            color: #7ed2e2;
        }

        .header-comp-search .form-control:focus {
            background-color: rgba(84, 196, 217, 0.2);
        }

        .bootstrap-select.btn-group .dropdown-menu a:hover,
        .daterangepicker td.active:hover,
        .daterangepicker td.available:hover,
        .daterangepicker th.available:hover,
        .custom-actions .btn-action:hover,
        .calendar-table .prev:hover,
        .calendar-table .next:hover,
        .btn-secondary-outlined:hover,
        .btn-secondary-outlined:active,
        .btn-preview-listing:hover,
        .btn-preview-listing:active,
        .btn-preview-listing:focus,
        .btn-action:hover,
        .btn-action:active,
        .btn-action:focus {
            background-color: #7ed2e2;
        }



        .form-control:focus,
        .open > .btn-default.dropdown-toggle:hover,
        .open > .btn-default.dropdown-toggle:focus,
        .open > .btn-default.dropdown-toggle:active,
        .header-comp-search .form-control:focus,
        .btn-secondary-outlined:hover,
        .btn-secondary-outlined:active,
        .btn-secondary-outlined:focus,
        .btn-preview-listing:hover,
        .btn-preview-listing:active,
        .btn-preview-listing:focus {
            border-color: #7ed2e2;
        }

        .bootstrap-select .btn:focus,
        .bootstrap-select .btn:active {
            border-color: #7ed2e2 !important;
        }

        body {
            background-color: #f7f8f9;
        }

        body,
        .fc button,
        .pagination > li > a,
        .pagination > li > span,
        .item-title-head .title a,
        .sidebar .widget .review-block .title a,
        .sidebar .widget .comment-block .title a,
        .adults-calculator .quantity-calculator input[disbaled],
        .children-calculator .quantity-calculator input[disbaled],
        .nav-tabs > li > a,
        .nav-tabs > li > a:hover,
        .nav-tabs > li > a:focus,
        .nav-tabs > li.active > a,
        .nav-tabs > li.active > a:hover,
        .nav-tabs > li.active > a:focus,
        .modal-login-form .forgot-password-text a,
        .modal-login-form .checkbox a,
        .bootstrap-select.btn-group .dropdown-menu a,
        .header-nav .social-icons a,
        .header-nav .crncy-lang-block > li span,
        .header-comp-logo h1,
        .item-list-view .item-user-image,
        .item-title-head .title a,
        .control,
        .blog-wrap h2 a,
        .banner-caption-side-search .banner-title,
        .banner-caption-side-search .banner-subtitle,
        .widget_categories select,
        .widget_archive  select {
            color: #3b4249;
        }

        .item-title-head .title a:hover,
        .sidebar .widget .review-block .title a:hover,
        .sidebar .widget .comment-block .title a:hover {
            color: rgba(79, 89, 98, 0.5);
        }

        .transparent-header .navi > .main-menu > li > a,
        .transparent-header .account-loggedin,
        .transparent-header .header-mobile .login-register a,
        .transparent-header .header-mobile .btn-mobile-nav {
            color: #ffffff;
        }
        .transparent-header .navi > .main-menu > li > a:hover, .transparent-header .navi > .main-menu > li > a:active,
        .transparent-header .account-loggedin:hover,
        .transparent-header .account-loggedin:active,
        .transparent-header .login-register a:hover,
        .transparent-header .login-register a:active {
            color: #ffffff;
        }
        .transparent-header .navi > .main-menu > li > a:before {
            background-color: #ffffff;
        }
        .transparent-header .navi > .main-menu > li > a:before,
        .transparent-header .listing-navi > .main-menu > li > a:before {
            background-color: #ffffff;
        }
        .transparent-header .navi > .main-menu > li.active > a,
        .transparent-header .listing-navi > .main-menu > li.active > a {
            color: #ffffff;
        }
        .transparent-header .account-loggedin:before {
            background-color: #ffffff;
        }
        .transparent-header .navi .homey-megamenu-wrap,
        .transparent-header .listing-navi .homey-megamenu-wrap {
            background-color: #ffffff;
        }

        .header-nav {
            background-color: #ffffff;
            border-bottom: 1px solid #d8dce1;
        }

        .navi > .main-menu > li > a,
        .header-mobile .btn-mobile-nav {
            color: #4f5962;
        }
        .navi > .main-menu > li > a:hover, .navi > .main-menu > li > a:active,
        .navi .homey-megamenu-wrap > .sub-menu a:hover,
        .navi .homey-megamenu-wrap > .sub-menu a:active {
            color: #f15e75;
        }

        .navi > .main-menu > li > a:before,
        .listing-navi > .main-menu > li > a:before {
            background-color: #f15e75;
        }
        .navi > .main-menu > li.active > a,
        .listing-navi > .main-menu > li.active > a {
            color: #f15e75;
        }
        .navi .homey-megamenu-wrap,
        .listing-navi .homey-megamenu-wrap {
            background-color: #fff;
        }
        .banner-inner:before,
        .video-background:before {
            opacity: 0.5;
        }
        .page-template-template-splash .banner-inner:before,
        .page-template-template-splash .video-background:before {
            opacity: 0.35;
        }
        .top-banner-wrap {
            height: 600px
        }
        @media (max-width: 767px) {
            .top-banner-wrap {
                height: 300px
            }
        }

        .header-type-2 .top-inner-header,
        .header-type-3 .top-inner-header {
            background-color: #ffffff;
            border-bottom: 1px solid #d8dce1;
        }

        .header-type-2 .bottom-inner-header {
            background-color: #ffffff;
            border-bottom: 1px solid #d8dce1;
        }

        .header-type-3 .bottom-inner-header {
            background-color: #ffffff;
            border-bottom: 1px solid #d8dce1;
        }
        .login-register a,
        .account-loggedin,
        .account-login .login-register .fa {
            color: #4f5962;
            background-color: transparent;
        }
        .login-register a:hover,
        .login-register a:active,
        .account-loggedin:hover,
        .account-loggedin:active {
            color: #f15e75;
            background-color: transparent;
        }
        .account-loggedin:before {
            background-color: #f15e75;
        }
        .account-loggedin.active .account-dropdown {
            background-color: #ffffff
        }
        .account-dropdown ul > li a {
            color: #4f5962;
        }
        .account-dropdown ul > li a:hover {
            background-color: rgba(84,196,217,.15);
            color: #4f5962;
        }
        span.side-nav-trigger {
            color: #4f5962;
        }
        .transparent-header span.side-nav-trigger {
            color: #ffffff;
        }
        .top-inner-header .social-icons a {
            color: #4f5962;
        }

        .navi .homey-megamenu-wrap > .sub-menu a,
        .listing-navi .homey-megamenu-wrap > .sub-menu a {
            color: #4f5962;
            background-color: #ffffff;
        }
        .navi .homey-megamenu-wrap > .sub-menu a:hover,
        .listing-navi .homey-megamenu-wrap > .sub-menu a:hover {
            color: #f15e75;
            background-color: #ffffff;
        }
        .header-nav .menu-dropdown a,
        .header-nav .sub-menu a {
            color: #4f5962;
            background-color: #ffffff;
            border-bottom: 1px solid #f7f7f7;
        }
        .header-nav .menu-dropdown a:hover,
        .header-nav .sub-menu a:hover {
            color: #f15e75;
            background-color: #ffffff;
        }
        .header-nav .menu-dropdown li.active > a,
        .header-nav .sub-menu li.active > a {
            color: #f15e75;
        }

        .btn-add-new-listing {
            color: #ffffff;
            background-color: #f15e75;
            border-color: #f15e75;
            font-size: 14px;
        }
        .btn-add-new-listing:focus {
            color: #ffffff;
            background-color: #f58d9d;
            border-color: #f58d9d;
        }
        .btn-add-new-listing:hover {
            color: #ffffff;
            background-color: #f58d9d;
            border-color: #f58d9d;
        }
        .btn-add-new-listing:active {
            color: #ffffff;
            background-color: #f58d9d;
            border-color: #f58d9d;
        }

        .btn-secondary {
            color: #ffffff;
            background-color: #54c4d9;
            border-color: #54c4d9;
        }
        .btn-secondary:focus,
        .btn-secondary:active:focus {
            color: #ffffff;
            background-color: #54c4d9;
            border-color: #54c4d9;
        }
        .btn-secondary:hover {
            color: #ffffff;
            background-color: #7ed2e2;
            border-color: #7ed2e2;
        }
        .btn-secondary:active {
            color: #ffffff;
            background-color: #7ed2e2;
            border-color: #7ed2e2;
        }
        .btn-secondary-outlined,
        .btn-secondary-outlined:focus {
            color: #54c4d9;
            border-color: #54c4d9;
            background-color: transparent;
        }
        .btn-secondary-outlined:hover {
            color: #ffffff;
            background-color: #7ed2e2;
            border-color: #7ed2e2;
        }
        .btn-secondary-outlined:hover:active {
            color: #ffffff;
            background-color: #7ed2e2;
            border-color: #7ed2e2;
        }

        .main-search {
            background-color: #ffffff;
        }

        .header-top-bar {
            background-color: #4f5962;
        }

        .social-icons a,
        .top-bar-inner,
        .top-bar-inner li {
            color: #ffffff;
        }

        .top-contact-address li {
            color: #ffffff;
        }
        .top-contact-address a {
            color: #ffffff;
        }
        .top-contact-address a:hover {
            color: rgba(255,255,255,0.8);
        }

        .header-comp-logo img {
            width: 128px;
            height: 41px;
        }
        .mobile-logo img {
            width: 128px;
            height: 30px;
        }

        .footer-top-wrap {
            background-color: #ffffff;
            color: #000000;
        }

        .footer-bottom-wrap,
        .footer-small {
            background-color: #ffffff;
            color: #000000;
        }

        .footer .social-icons a,
        .footer a,
        .footer .title a,
        .widget-latest-posts .post-author,
        .widget-latest-posts .post-author a {
            color: #000000;
        }

        .footer .social-icons a:hover,
        .footer a:hover,
        .footer .title a:hover {
            color: #54c4d9;
        }

        .footer-copyright {
            color: #000000;
        }

        .label-featured {
            background-color: #54c4d9;
            color: #ffffff;
        }
        .banner-inner.parallax {
            -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
        }
        .parallax-inner {
            -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
            transform: translate3d(0, 0, 0) !important;
        }
        .overlay-booking-btn {z-index: 999;}
        .overlay-booking-module {z-index: 1000;}
    </style>
    @if(!Request::is('/'))
        <style>
            .kt-widget17__icon span{
                display: block;
                margin-top: 0px;
                font-size: 1.5rem;
                font-weight: bold;
                color: #6c7293;
            }
            .dhsco-stats{
                width: 100% !important;
                margin: 0px !important;
            }
            .dhsco-card-value {
                float: right;
                font-size: 24px;
                margin-top: 5px;
            }
            .dhsco-cards{
                border-radius: 6px;
                box-shadow: 0px 1px 3px 1px rgba(69, 65, 78, 0.19);
                padding: 1.5rem !important;
                margin: 1rem !important;
            }
            h3,th{
                font-family: Col-Reg, sans-serif;
                font-weight: bold !important;
            }
            th{
                font-size: 15px;
            }
            p,a,span{
                font-weight: bold !important;
            }
            tr{
                font-weight: bold !important;
            }
            td{
                font-weight:bold !important;
                padding: 16px !important;
                border-top: 1px solid #f0f3ff !important;
            }
            .kt-portlet__head-title{
                font-size: 20px !important;
            }
            .dhsco-rounded {
                background-color: #f15e75;
                font-size: 0px;
                padding: 4px;
                border-radius: 50%;
            }
            @media (max-width: 765px) {
                .kt-widget17__items{
                    display: block !important;
                }
            }
            .label-option-2-col:before, .label-option-3-col:before, .label-option-4-col:before, .detail-list:before, .block-head:before, .block-title:before, .block-sub-title:before, .block-body:before, .block-section:before, .block-verify:before, .block-bordered:before, .dashboard-page-title:before, .msg-user-info:before, .msg-type-block .msg-attachment-row:before, .upload-gallery-thumb-buttons:before, .house-features-list:before, .steps-nav:before, .payment-list ul li:before, .what-nearby dd:before, .navi > .main-menu:before, .listing-navi > .main-menu:before, .print-main-wrap .block-section:before, .label-option-2-col:after, .label-option-3-col:after, .label-option-4-col:after, .detail-list:after, .block-head:after, .block-title:after, .block-sub-title:after, .block-body:after, .block-section:after, .block-verify:after, .block-bordered:after, .dashboard-page-title:after, .msg-user-info:after, .msg-type-block .msg-attachment-row:after, .upload-gallery-thumb-buttons:after, .house-features-list:after, .steps-nav:after, .payment-list ul li:after, .what-nearby dd:after, .navi > .main-menu:after, .listing-navi > .main-menu:after, .print-main-wrap .block-section:after{
                content: none !important;
            }
            .main-search{
                overflow-x: scroll;
            }
            #main-menu li{
                text-align: center;
            }
        </style>
    @endif
</head>
