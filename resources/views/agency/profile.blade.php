@extends('template.interface')
@section('content')
    <div class="col-md-12">
        <!--Begin::Portlet-->
        <div class="kt-portlet kt-portlet--height-fluid">
            <div class="kt-portlet__head kt-portlet__head--noborder">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">

                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                <!--begin::Widget -->
                <div class="kt-widget kt-widget--user-profile-2">
                    <div class="kt-widget__head">
                        <div class="kt-widget__media">
                            <img class="kt-widget__img kt-hidden-" src="{{URL::asset('assets/img/company.png')}}" alt="image">
                        </div>

                        <div class="kt-widget__info">
                            <a href="#" class="kt-widget__username">
                                {{$usr->name}}
                            </a>
                        </div>
                    </div>

                    <div class="kt-widget__body">
                        <div class="kt-widget__item">
                            <div class="kt-widget__contact">
                                <span class="kt-widget__label">Email:</span>
                                <a href="#" class="kt-widget__data">{{$usr->email}}</a>
                            </div>
                            <div class="kt-widget__contact">
                                <span class="kt-widget__label">Phone:</span>
                                <a href="#" class="kt-widget__data">{{$usr->phone}}</a>
                            </div>
                            <div class="kt-widget__contact">
                                <span class="kt-widget__label">Date Of Birth:</span>
                                <a href="#" class="kt-widget__data">{{$usr->dob}}</a>
                            </div>
                            <div class="kt-widget__contact">
                                <span class="kt-widget__label">Address:</span>
                                <a href="#" class="kt-widget__data">{{$usr->address}}</a>
                            </div>
                            @if($usr->agency->accountNumber !== null)
                                <div class="kt-widget__contact">
                                    <span class="kt-widget__label">Account Number:</span>
                                    <a href="#" class="kt-widget__data">{{$usr->agency->accountNumber}}</a>
                                </div>
                            @else
                                <div class="kt-widget__contact">
                                    <span class="kt-widget__label">Account Number:</span>
                                    <a href="#" class="kt-widget__data">None</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!--end::Widget -->
            </div>
        </div>
        <!--End::Portlet-->
    </div>
@endsection
