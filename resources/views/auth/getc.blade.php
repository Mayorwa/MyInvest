<!DOCTYPE html>
<html><meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="Mayorwa">
    <meta name="csrf-token" content="nBqmjWI6hEjMKk4fDlEkAU0XloVCl8w4MD4sHurH">
    <title>{{$title}}</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700" rel="stylesheet">
    <link href="../../maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{secure_asset('public/assets/css/app.css')}}">
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{secure_asset('public/assets/css/vendors.css')}}">
    <link rel="stylesheet" type="text/css" href="{{secure_asset('public/assets/vendors/css/forms/icheck/icheck.css')}}">
    <link rel="stylesheet" type="text/css" href="{{secure_asset('public/assets/vendors/css/forms/icheck/custom.css')}}">
    <link rel="stylesheet" type="text/css" href="{{secure_asset('public/assets/css/pages/login-register.css')}}">
    <!-- BEGIN Custom CSS-->
    <link href="{{secure_asset('public/assets/css/custom.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{secure_asset('public/assets/css/custom-may.css')}}" rel="stylesheet" type="text/css" />
    <!-- END Custom CSS-->
</head>
<style>
    .btn-dhsco-col{
        background-color: #ea0000ed !important;
        border-color: #ea0000ed !important;
    }
    .btn-dhsco-col:hover{
        background-color: #ea0000ed !important;
        border-color: #ea0000ed !important;
    }
</style>
<body class="vertical-layout vertical-content-menu 2-columns fixed-navbar"  data-open="click" data-menu="vertical-content-menu" data-col="2-columns">
<div class="app-content content" style="padding-top: 100px;">
    <div class="content-wrapper">
        <div class="content-header row"></div>
        <div class="content-body">
            <section class="flexbox-container">
                <div class="col-12 d-flex align-items-center justify-content-center">
                    <div class="col-md-4 col-10 box-shadow-2 p-0">
                        <div id="messages"></div>
                        <div class="card border-grey border-lighten-3 m-0" id="getAccess">
                            <div class="card-header border-0">
                                <div class="card-title text-center">
                                    <a href="{{URL('/')}}" class="p-1">
                                        <img src="{{secure_asset('public/logos/dark.png')}}" alt="MyyInvest Logo" width="200px" class="img-responsive">
                                    </a>
                                </div>
                                <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2">
                                    <span>Get Started</span>
                                </h6>
                            </div>

                            <div class="card-content">
                                <div class="card-body">
                                    <form class="form-horizontal form-simple" action="{{URL('auth/get-access')}}" method="POST" id="getAccessForm" novalidate>
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                        <fieldset class="form-group position-relative has-icon-left mb-0">
                                            <input type="email" name="email" class="form-control form-control-lg input-lg" id="email" placeholder="Company's email address" required>
                                            <div class="form-control-position">
                                                <i class="ft-user"></i>
                                            </div>
                                        </fieldset>
                                        <br>
                                        <center><img id="loaderImg" src="{{secure_asset('public/assets/images/loader.gif')}}" width="35px" class="img-responsive"/></center>
                                        <button type="submit" id="submitBtn" class="btn btn-info btn-md btn-block btn-dhsco-col">Get Code</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="card border-grey border-lighten-3 m-0" id="confirmAccess">
                            <div class="card-header border-0">
                                <div class="card-title text-center">
                                    <a href="{{URL('/')}}" class="p-1">
                                        <img src="{{secure_asset('public/logos/dark.png')}}" alt="MyyCrib logo" width="200px" class="img-responsive">
                                    </a>
                                </div>
                                <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2">
                                    <span>Confirm Code</span>
                                </h6>
                            </div>

                            <div class="card-content">
                                <div class="card-body">
                                    <form class="form-horizontal form-simple" action="{{URL('auth/confirm-access')}}" method="POST" id="confirmAccessForm" novalidate>
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                        <fieldset class="form-group position-relative mb-0">
                                            <input type="text" maxlength="6" name="code" class="form-control form-control-lg input-lg" pattern="[0-9]" id="code" placeholder="- - - - - -" required>
                                        </fieldset>
                                        <br>
                                        <center><img id="loaderImg" src="{{secure_asset('public/assets/images/loader.gif')}}" width="35px" class="img-responsive"/></center>

                                        <button type="submit" id="submitBtn" class="btn btn-info btn-md btn-block btn-dhsco-col"><i class="ft-unlock"></i> Confirm Code</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <span id="callbackUrl" data-url="{{URL('/auth/register')}}"></span>
    </div>
</div>

<script>
    var resizefunc = [];
</script>

<script src="{{secure_asset('public/assets/vendors/js/vendors.min.js')}}" type="text/javascript"></script>
<script src="{{secure_asset('public/assets/vendors/js/ui/headroom.min.js')}}" type="text/javascript"></script>
<script src="{{secure_asset('public/assets/js/scripts/custom.js')}}" type="text/javascript"></script>

<script src="{{secure_asset('public/assets/js/modules/auth.js')}}"></script>
<script>
    $('#confirmAccessForm').on('submit', function (e) {
        e.preventDefault();

        var that = $(this), url = that.attr('action'), type = that.attr('method');

        $("#messages").empty();

        var submitBtn = $("#confirmAccessForm").find(":submit");
        var loaderImg = $("#confirmAccessForm").find("#loaderImg");

        //hide the submit button to prevent multiple submissions
        submitBtn.hide();
        //display the working spinner
        loaderImg.show();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });

        $.ajax({
            url: url,
            type: type,
            data: new FormData(this),
            contentType: false,
            processData: false,
            500: function (response) {
                loaderImg.hide();
                //hide the button divs
                submitBtn.show();

                $("#messages").append("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert'>&times;</button>" + response.message + "</div>");
            },
            403: function (response) {
                loaderImg.hide();
                //hide the button divs
                submitBtn.show();
                //loop through the message array to output friendly ones.
                $.each(response.responseJSON.data, function (index, message) {
                    //display response message
                    $("#messages").append("<div class='alert alert-warning alert-dismissable'><button type='button' class='close' data-dismiss='alert'>&times;</button>" + message + "</div>");
                });
            },
            success: function (response) {
                if (response.error == true) {
                    $.each(response.message, function (index, message) {
                        //display response message
                        $("#messages").append("<div class='alert alert-warning alert-dismissable'><button type='button' class='close' data-dismiss='alert'>&times;</button>" + message + "</div>");
                    });

                    loaderImg.hide();
                    //hide the button divs
                    submitBtn.show();
                } else {
                    $("#confirmAccessForm").hide();

                    $("#messages").append("<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert'>&times;</button>" + response.message + ", you will be redirect  in 5 seconds</div>");
                    setTimeout(function () {
                        window.location.href = $("#callbackUrl").attr("data-url");
                    }, 5000);
                }

            },
        });

        return false;
    });
</script>
<script src="{{secure_asset('public/assets/js/scripts/forms/form-login-register.js')}}"></script>
<script src="{{secure_asset('public/assets/vendors/js/ui/headroom.min.js')}}"></script>
<script src="{{secure_asset('public/assets/vendors/js/forms/icheck/icheck.min.js')}}"></script>


</body>

<!-- Mirrored from bosstable.com.ng/auth/get-access by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 12 Jul 2019 05:45:29 GMT -->
</html>
