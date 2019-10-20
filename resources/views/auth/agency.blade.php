@extends('template.master')

@section('content')
    <div class="kt-grid kt-grid--ver kt-grid--root">
        <div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v1" id="kt_login">
            <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--desktop kt-grid--ver-desktop kt-grid--hor-tablet-and-mobile">
                <!--begin::Aside-->
                <div class="kt-grid__item kt-grid__item--order-tablet-and-mobile-2 kt-grid kt-grid--hor kt-login__aside" style="background-image: url({{secure_asset('public/login/agency.png')}});">
                    <div class="kt-grid__item">
                        <a href="{{URL('/')}}" class="kt-login__logo">
                            <img src="{{secure_asset('public/logos/dark.png')}}" style="width: 190px; height: 65px;">
                        </a>
                    </div>
                    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver">
                        <div class="kt-grid__item kt-grid__item--middle">
                            <h3 class="kt-login__title">Join The Elite!</h3>
                        </div>
                    </div>
                </div>
                <!--begin::Aside-->

                <!--begin::Content-->
                <div class="kt-grid__item kt-grid__item--fluid  kt-grid__item--order-tablet-and-mobile-1  kt-login__wrapper">
                    <!--begin::Head-->

                    <!--end::Head-->

                    <!--begin::Body-->
                    <div class="kt-login__body">
                        <!--begin::Signin-->
                        <div class="kt-login__form" style="max-width: 633px;">
                            @include('template.errors')
                            <div class="kt-login__title">
                                <h3>Sign Up As an Agent</h3>
                            </div>

                            <!--begin::Form-->
                            <form class="kt-form" action="{{ URL('auth/asignUp') }}" method="POST">
                                <input name="_token" type="hidden" value="{{csrf_token()}}">

                                <div class="form-group mt-3">
                                    <label for="" style="font-weight: bold; font-size: 16px;">Personal Information</label>
                                </div>

                                <div class="form-group">
                                    <input class="form-control" type="text" placeholder="Full name" name="name" required>
                                </div>
                                <div class="form-group" style="display: flex;">
                                    <input class="form-control" type="email" placeholder="Email" name="email" style="margin-right: 10px;" required>
                                    <input class="form-control" type="number" placeholder="Phone" pattern=".{0}|.{8,14}" name="phone" required>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="date" placeholder="Date Of Birth" name="dob"  required>
                                    <input class="form-control" type="text" placeholder="Address" name="address" required>
                                    <input type="hidden" class="form-control">
                                </div>
                                <div class="form-group" style="display: flex;">
                                    <input class="form-control" type="password" placeholder="Password" id="password" pattern=".{0}|.{8,}" title="Either 0 OR (8 chars minimum)" name="password" style="margin-right: 10px;" required>
                                    <input class="form-control" type="password" placeholder="Confirm Password" pattern=".{0}|.{8,}" title="Either 0 OR (8 chars minimum)" id="confirm_password" name="password_confirmation" required>
                                </div>
                                <span id='message'></span>
                                <div class="form-group" style="display: flex;">
                                    <div class="kt-radio-inline mt-4">
                                        <label class="kt-radio">
                                            <input type="radio" name="radios" checked="checked" id="outright" value="1"> Sales Consultant
                                            <span></span>
                                        </label>
                                        <label class="kt-radio">
                                            <input type="radio" name="radios" id="installment" value="2"> Realtor
                                            <span></span>
                                        </label>
                                    </div>
                                    <select class="form-control" name="companyId" id="" required>
                                        @foreach($companies as $company)
                                            <option value="{{$company->id}}">{{$company->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <hr>
                                <div class="form-group mt-3">
                                    <label for="" style="font-weight: bold; font-size: 16px;">Next Of Kin Information</label>
                                </div>

                                <div class="form-group">
                                    <input class="form-control" type="text" placeholder="Full name" name="nextOfKin" required>
                                </div>
                                <div class="form-group" style="display: flex;">
                                    <input class="form-control" type="email" placeholder="Email" name="nextOfKinEmail" style="margin-right: 10px;" required>
                                    <input class="form-control" type="number" placeholder="Phone" pattern=".{0}|.{8,14}" name="nextOfKinPhone" required>
                                </div>
                                <hr>
                                <div class="form-group mt-3">
                                    <label for="" style="font-weight: bold; font-size: 16px;">Were you referred by an Agent?</label>
                                    <p>Add his unique Id</p>
                                </div>
                                <div class="form-group" id="uniqueDiv">
                                    <div class="kt-radio-inline">
                                        <label class="kt-radio">
                                            <input type="radio" name="uniqueOpt" checked="checked" id="unique" value="2"> No
                                            <span></span>
                                        </label>
                                        <label class="kt-radio">
                                            <input type="radio" name="uniqueOpt" id="unUnique" value="1"> Yes
                                            <span></span>
                                        </label>
                                    </div>
                                </div>

                                <div class="col-md-12 pt-1 mt-2" id="instllDiv" style="border-top: 1px dotted #dbdbdb;display: none;">
                                    <div class="row" id="duplicatediv">
                                        <div class="col-md-12 pt-2">
                                            <label>Unique Id</label>
                                            <input type="text" class="form-control  input-lg" name="refUniqueId">
                                        </div>
                                    </div>
                                </div>

                                <div class="kt-login__actions py-0 my-0 mt-5">
                                    <button id="Button" type="submit" class="btn btn-brand btn-pill btn-elevate btn-invest-red  py-3 px-4">Sign Up</button>
                                </div>
                                <div class="kt-login__extra my-4">
                                    Already Have an account?
                                    <a href="{{URL("auth/login")}}" style="color: #0063e4 !important;"> Login.</a>
                                </div>
                            </form>
                            <!--end::Form-->
                        </div>
                        <!--end::Signin-->
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Content-->
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript">
        var rad = $("#uniqueDiv  :input");
        console.log(rad.length);
        var prev = null;
        for (var i = 0; i < rad.length; i++) {
            rad[i].addEventListener('change', function() {
                // (prev) ? console.log(prev.value): null;
                if (this !== prev) {
                    prev = this;
                }
                if(this.value == 2){
                    $('#instllDiv').hide();
                } else {
                    $('#instllDiv').show();
                }
                console.log(this.value)
            });
        }
        </script>
@endsection
