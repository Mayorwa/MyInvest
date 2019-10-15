<!DOCTYPE html>
<html lang="en-US">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    @include('template.homeHead')
<style>
    .btn-invest-red{
        background-color: #ea2c28 !important;
        border-color: #ea2c28 !important;
        color: #fff !important;
    }
    .login-register{
        text-align: center;
    }
    .mobile .login-register li a{
        color: #000 !important;
        padding: 0px;
    }
    .irs--flat .irs-bar{
        background-color: #ea2c28 !important;
    }
    .irs--flat .irs-from, .irs--flat .irs-to, .irs--flat .irs-single{
        background-color: #ea2c28 !important;
    }
</style>
    <body class="home page-template page-template-template page-template-template-homepage page-template-templatetemplate-homepage-php page page-id-493 compare-property-active wpb-js-composer js-comp-ver-6.0.2 vc_responsive">

        @include('template.homeHeader')

        {{-- Begin Main  --}}
            @yield('content')
        {{--  End Main --}}
        @include('template.footer')

        {{--Begin Modal--}}
        @include('template.homeModals')
        {{--End Modal--}}

        @include('template.homeFoot')
    </body>
</html>
