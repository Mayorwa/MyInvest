<head>
    <meta charset="utf-8"/>
    <title>MyCribb | Admin Dashboard</title>
    <meta name="description" content="Updates and statistics">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <script src="./webfont.js"></script>
    <script>
        WebFont.load({
            google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <link rel='stylesheet' id='homey-main-css'  href='{{secure_asset('public/css/main6f3e.css')}}' type='text/css' media='all' />
    <link href="{{secure_asset('public/assets2/vendors/custom/fullcalendar/fullcalendar.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{secure_asset('public/assets2/vendors/global/vendors.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{secure_asset('public/assets2/css/demo1/style.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{secure_asset('public/assets2/css/demo1/skins/header/base/light.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{secure_asset('public/assets2/css/demo1/skins/header/menu/light.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{secure_asset('public/assets2/css/demo1/skins/brand/dark.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{secure_asset('public/assets2/css/demo1/skins/aside/dark.css')}}" rel="stylesheet" type="text/css" />
    <script src="{{secure_asset('public/assets/js/jquery-3.1.1.min.js')}}" type="text/javascript"></script>
    <style>
        .dhsco-cards{
            border-radius: 6px;
            box-shadow: 0px 1px 3px 1px rgba(69, 65, 78, 0.19);
            padding: 1.5rem !important;
            margin: 1rem !important;
        }
        .dhsco-cards .kt-widget17__icon svg{
            width: 46px !important;
            height: 46px !important;
        }
        .dhsco-stats{
            width: 100% !important;
        }
        .dhsco-card-value{
            float: right;
            font-size: 24px;
            margin-top: 5px;
        }
        .table thead th, .table thead td{
            font-weight: bold;
            font-size: 14px;
        }
        .table td {
            color: #5f5f5f
        }
        .kt-aside-menu .kt-menu__nav > .kt-menu__item{
            margin-bottom: 15px;
        }
        .alert{
            display: block !important;
        }
        .single-table th, .single-table td{
            padding: 1.40rem;
        }
    </style>
</head>
