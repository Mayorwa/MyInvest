<!DOCTYPE html>
<html lang="en" >
<!-- begin::Head -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
@include('template.head')
<style>
    .btn-invest-red{
        background-color: #ea2c28;
        border-color: #ea2c28;
        color: #fff;
    }
    @media (max-width: 1024px) {
        .fhsco-imig-bg{
            display: none !important;
        }
    }
</style>
<body  class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--fixed kt-subheader--enabled kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading"  >
    @yield("content")
</body>
<script src="{{URL::asset('js/vendors.bundle.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('js/scripts.bundle.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('js/login.js')}}" type="text/javascript"></script>
<script>
    $('#password, #confirm_password').on('keyup', function () {
        if ($('#password').val() === $('#confirm_password').val()) {
            $('#message').html('password matches correctly').css('color', 'green');
        } else
            $('#message').html('password does not match').css('color', 'red');
    });
</script>
</html>
