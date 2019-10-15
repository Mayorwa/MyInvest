<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="assets/img/favicon.png">
    <title>Myycrib: {{$title}}</title>


    <!-- STYLESHEETS-->
    <link rel="stylesheet" type="text/css" href="{{URL::secure_asset('libraries/bootstrap/css/bootstrap.min.css')}}">

    <!-- CUSTOM STYLES -->
    <link rel="stylesheet" type="text/css" href="{{URL::secure_asset('assets/css/main.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::secure_asset('assets/css/index.css')}}">




    <!-- WEBFONT -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Signika+Negative" rel="stylesheet">



    <!-- ICON -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css">
</head>
<style>
    .__forminput{
        height: 50px;
    }
</style>
<body class="">


<header>
    <div class="contactbg">
        <nav class="navbar __navba" role="navigation">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{URL('/')}}"><img src="{{URL::secure_asset('logos/dark.png')}}" class="__logo"></a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="about.html" class="__navf">About Us</a></li>
                        <li><a href="index.html#feature" class="__navf">Features</a></li>
                        <li><a href="price.html" class="__navf">Pricing</a></li>
                        <li><a href="contact.html" class="__navf">Contact Us</a></li>
                        <li><a href="login.html" class="__navf">Login</a></li>
                        <li><a href="signup.html" class="__navfa">Sign up</a></li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div>
        </nav>
        <div class="container" style="padding-top: 70px; padding-bottom: 50px;">
            <div class="__boossi">
                <p class="__loginlabel">Company Registeration</p>
                <div class="row">
                    <div class="col-lg-5 col-md-5 col-sm-5">
                        <img src="{{URL::secure_asset('assets/img/2489915.jpg')}}" class="img-responsive" style="padding-top: 80px;">
                    </div>
                    <div class="col-lg-1 col-md-1 col-sm-1" style="width: 1%;">
                        <div class="__line hidden-xs"></div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <!-- <p class="__formt">Lorem Ipsum is simply<br> dummy text of the</p> -->
                        @include('template.errors')
                        <form action="{{URL('auth/csignUp')}}" method="POST" role="form">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input type="hidden" name="companyEmail" id="" value="{{\Session::get('email')}}">
                            <div class="form-group">
                                <label for="">Company Informations</label>
                            </div>

                            <div class="form-group">
                                <input type="text" class="form-control __forminput" name="companyName" id="" placeholder="Company Name" required>
                            </div>

                            <div class="form-group">
                                <textarea name="companyAddress" id="input" class="form-control __forminput" rows="4" placeholder="Company Address" required></textarea>
                            </div>

                            <div class="form-group">
                                <label for="">Personal Informations</label>
                            </div>
                            <div class="form-group">
                                <input type="text" name="name" class="form-control __forminput" id="" placeholder="Full Name" required>
                            </div>

                            <div class="form-group">
                                <input type="email" name="email" class="form-control __forminput" id="" placeholder="Email" required>
                            </div>

                            <div class="form-group d-flex" style="display:flex;">
                                <input type="password" name="password" class="form-control __forminput" id="" placeholder="Password" required>
                                <input type="password" name="password_confirmation" class="form-control __forminput" id="" placeholder="Confirm Password" required>
                            </div>

                            <div class="form-group">
                                <input type="date" name="dob" class="form-control __forminput" id="" placeholder="Date Of Birth" required>
                            </div>

                            <div class="form-group">
                                <input type="text" name="phone" class="form-control __forminput" id="" placeholder="Phone Number" required>
                            </div>

                            <div class="form-group">
                                <textarea name="address" id="input" class="form-control __forminput" rows="4" placeholder="Address" required></textarea>
                            </div>

                            <div class="form-group">
                                <label for="">Next Of Kin Informations</label>
                            </div>

                            <div class="form-group">
                                <input type="text" name="nextOfKin" class="form-control __forminput" id="" placeholder="Full Name" required>
                            </div>

                            <div class="form-group">
                                <input type="text" name="nextOfKinPhone" class="form-control __forminput" id="" placeholder="Phone Number" required>
                            </div>

                            <div class="form-group">
                                <input type="email" name="nextOfKinEmail" class="form-control __forminput" id="" placeholder="Email" required>
                            </div>


                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <button type="submit" class="btn btn-block __bootsub" style="padding: 12px 12px">Submit</button>
                                </div>
                            </div>
                        </form>
                        <div>
                            <p class="__haveac">Already have an account? <span><a href="{{URL('/auth/login')}}">Login</a></span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>



<section></section>

<script type="text/javascript" src="{{URL::secure_asset('libraries/bootstrap/js/jquery-3.1.1.min.js')}}"></script>

<script src="{{URL::secure_asset('libraries/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{URL::secure_asset('assets/js/main.js')}}"></script>




</body>
</html>
