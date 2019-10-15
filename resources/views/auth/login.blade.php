@extends('template.master')

@section('content')
    <div class="kt-grid kt-grid--ver kt-grid--root">
        <div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v6 kt-login--signin" id="kt_login">
            <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--desktop kt-grid--ver-desktop kt-grid--hor-tablet-and-mobile">
                <div class="kt-grid__item  kt-grid__item--order-tablet-and-mobile-2  kt-grid kt-grid--hor kt-login__aside">
                    <div class="kt-login__wrapper">
                        <div class="kt-login__container">
                            <div class="kt-login__body">
                                @include('template.errors')
                                <div class="kt-login__logo">
                                    <a href="{{URL('/')}}">
                                        <img src="{{URL::asset('logos/dark.png')}}" style="width: 190px; height: 65px;">
                                    </a>
                                </div>

                                <div class="kt-login__signin">
                                    <div class="kt-login__head">
                                        <h3 class="kt-login__title">Sign In To Account</h3>
                                    </div>
                                    <div class="kt-login__form">
                                        <form class="kt-form" action="{{ URL('signIn') }}" method="POST">
                                            <input name="_token" type="hidden" value="{{csrf_token()}}">
                                            <div class="form-group">
                                                <input class="form-control" type="text" placeholder="Email" name="email" autocomplete="off" required>
                                            </div>
                                            <div class="form-group">
                                                <input class="form-control form-control-last" type="password" placeholder="Password" name="password" required>
                                            </div>
                                            <div class="kt-login__extra">
                                                <a href="javascript:;" id="kt_login_forgot">Forgot Password ?</a>
                                            </div>
                                            <div class="kt-login__actions">
                                                <button type="submit" class="btn btn-invest-red btn-pill btn-elevate">Sign In</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <div class="kt-login__signup">
                                    <div class="kt-login__head">
                                        <h3 class="kt-login__title">Sign Up</h3>
                                        <div class="kt-login__desc">Enter your details to create your account:</div>
                                    </div>
                                    <div class="kt-login__form">
                                        <form class="kt-form" action="{{ URL('signUp') }}" method="POST">
                                            <div class="form-group mt-3">
                                                <label for="" style="font-weight: bold; font-size: 16px;">Personal Information</label>
                                            </div>
                                            <input name="_token" type="hidden" value="{{csrf_token()}}">

                                            <div class="form-group">
                                                <input class="form-control" type="text" placeholder="Full name" name="name" autocomplete="off" required>
                                            </div>
                                            <div class="form-group" style="display: flex;">
                                                <input class="form-control" type="email" placeholder="Email" name="email" autocomplete="off" style="margin-right: 10px;" required>
                                                <input class="form-control" type="number" placeholder="Phone" pattern=".{0}|.{8,14}" name="phone" autocomplete="off" required>
                                            </div>
                                            <div class="form-group">
                                                <input class="form-control" type="date" placeholder="Date Of Birth" name="dob" autocomplete="off" required>
                                                <input class="form-control" type="text" placeholder="Address" name="address" autocomplete="off" required>
                                                <input type="hidden" class="form-control">
                                            </div>
                                            <div class="form-group" style="display: flex;">
                                                <input class="form-control" type="password" placeholder="Password" id="password" pattern=".{0}|.{8,}" title="Either 0 OR (8 chars minimum)" name="password" style="margin-right: 10px;" required>
                                                <input class="form-control" type="password" placeholder="Confirm Password" pattern=".{0}|.{8,}" title="Either 0 OR (8 chars minimum)" id="confirm_password" name="password_confirmation" required>
                                            </div>
                                            <span id='message'></span>

                                            <div class="form-group mt-3">
                                                <label for="" style="font-weight: bold; font-size: 16px;">Next Of Kin Information</label>
                                            </div>

                                            <div class="form-group">
                                                <input class="form-control" type="text" placeholder="Full name" name="nextOfKin" autocomplete="off" required>
                                            </div>
                                            <div class="form-group" style="display: flex;">
                                                <input class="form-control" type="email" placeholder="Email" name="nextOfKinEmail" autocomplete="off" style="margin-right: 10px;" required>
                                                <input class="form-control" type="number" placeholder="Phone" pattern=".{0}|.{8,14}" name="nextOfKinPhone" autocomplete="off" required>
                                            </div>
                                            <div class="kt-login__extra">
                                                <a href="{{URL("auth/get-access")}}" style="color: #003192" id="kt_login_forgot"> Sign Up as a company</a>
                                            </div>
                                            <div class="kt-login__actions">
                                                <button id="kt_login_signup_cancel" class="btn btn-outline-brand btn-pill px-4 float-left" style="border: none;"><i class="fa fa-arrow-left"></i>Back</button>
                                                <button id="Button" type="submit" class="btn btn-invest-red btn-pill btn-elevate mt-4" style="margin-left: -90px;">Sign Up</button>

                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <div class="kt-login__forgot">
                                    <div class="kt-login__head">
                                        <h3 class="kt-login__title">Forgotten Password ?</h3>
                                        <div class="kt-login__desc">Enter your email to reset your password:</div>
                                    </div>
                                    <div class="kt-login__form">
                                        <form class="kt-form" action="#">
                                            <div class="form-group">
                                                <input class="form-control" type="text" placeholder="Email" name="email" id="kt_email" autocomplete="off">
                                            </div>
                                            <div class="kt-login__actions">
                                                <button id="kt_login_forgot_submit" class="btn btn-brand btn-pill btn-elevate">Request</button>
                                                <button id="kt_login_forgot_cancel" class="btn btn-outline-brand btn-pill">Cancel</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="kt-login__account">
                        <span class="kt-login__account-msg">
                            Don't have an account yet ?
                        </span>&nbsp;&nbsp;
                            <a href="javascript:;" id="kt_login_signup" class="kt-login__account-link">Sign Up!</a>
                        </div>
                    </div>
                </div>

                <div class="kt-grid__item kt-grid__item--fluid kt-grid__item--center kt-grid kt-grid--ver kt-login__content fhsco-imig-bg" style="background-image: url({{URL::asset('login/overlay.png')}});">
                    <div class="kt-login__section">
                        <div class="kt-login__block">
                            <h3 class="kt-login__title">Start Your Investment Journey</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
