@extends('template.adminMaster')
@section('content')
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" style="padding-bottom: 40px;">
        <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
            @include('template.metrics')
            <div class="row">
                <div class="col-md-6">
                    <div class="kt-portlet">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title" style="font-weight: bold">
                                    Users
                                </h3>
                            </div>
                            <div class="kt-portlet__head-toolbar">
                                <a href="{{URL('admin/'.$usr->slug.'/dashboard/users')}}" class="btn btn-label-primary-o2" style="cursor: pointer !important;">View More</a>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Phone No</th>
                                    <th>Type</th>
                                    <th>D.O.B</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->phone}}</td>
                                            <td><span class="btn btn-bold btn-sm btn-font-sm  btn-label-primary">{{$user->type}}</span></td>
                                            <td>{{$user->dob}}</td>
                                            <td>
                                                <a href="{{URL('admin/'.$usr->slug.'/dashboard/users/'.$user->slug)}}" class="btn btn-primary">View</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="kt-portlet">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title" style="font-weight: bold">
                                    Companies
                                </h3>
                            </div>
                            <div class="kt-portlet__head-toolbar">
                                <a href="{{URL('admin/'.$usr->slug.'/dashboard/companies')}}" class="btn btn-label-primary-o2" style="cursor: pointer !important;">View More</a>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>Users Name</th>
                                    <th>D.O.B</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($companies as $company)
                                    <tr>
                                        <td>{{$company->name}}</td>
                                        <td>{{$company->email}}</td>
                                        <td>{{$company->address}}</td>
                                        <td>{{$company->metaData["user"]->name}}</td>
                                        <td>{{$company->metaData["user"]->dob}}</td>
                                        <td>
                                            <a href="{{URL('admin/'.$usr->slug.'/dashboard/companies/'.$company->slug)}}" class="btn btn-primary">View</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="kt-portlet">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title" style="font-weight: bold">
                                    Properties
                                </h3>
                            </div>
                            <div class="kt-portlet__head-toolbar">
                                <a href="{{URL('admin/'.$usr->slug.'/dashboard/properties')}}" class="btn btn-label-primary-o2" style="cursor: pointer !important;">View More</a>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <div class="row">
                                @foreach($properties as $property)
                                    <div class="col-md-6">
                                        <div class="kt-portlet kt-portlet--height-fluid kt-widget19">
                                            <div class="kt-portlet__body kt-portlet__body--fit kt-portlet__body--unfill">
                                                <div class="kt-widget19__pic kt-portlet-fit--top kt-portlet-fit--sides" style="min-height: 300px; background-image: url({{$property->image->image}})">
                                                    <div class="kt-widget19__shadow"></div>
                                                    <div class="kt-widget19__labels">
                                                        @if($property->isDeleted)
                                                            <a href="#" class="btn btn-label-danger-o2 btn-bold btn-sm ">Sold</a>
                                                        @else
                                                            <a href="#" class="btn btn-label-success-o2 btn-bold btn-sm ">Active</a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="kt-portlet__body pl-0">
                                                <div class="kt-widget19__wrapper">
                                                    <div class="kt-widget19__content">
                                                        <div class="kt-widget19__info" style="color:#000;">
                                                            <a href="#" class="kt-widget19__username pb-1">
                                                                <a style="font-size: 13px;"><b style="font-size: 15px;">Number of Plots:</b> {{$property->noOfPlots}}</a>
                                                            </a>
                                                            <a href="#" class="kt-widget19__username pb-1">
                                                                <a style="font-size: 13px;"><b style="font-size: 15px;">Estate:</b>{{$property->metaData['estate']->name}}</a>
                                                            </a>
                                                            <a href="#" class="kt-widget19__username pb-1">
                                                                <a class="text-success" style="font-size: 13px;"><b style="font-size: 15px;color: #000">Amount:</b> NGN {{ App\Http\Helpers\Helper::MoneyConvert($property->amount, "full") }}</a>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="kt-widget19__action m-auto">
                                                    <a href="#" class="btn btn-primary">View</a>
                                                    <a href="#" class="btn btn-danger">Deactivate</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="kt-portlet">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title" style="font-weight: bold">
                                    Estates
                                </h3>
                            </div>
                            <div class="kt-portlet__head-toolbar">
                                <a href="{{URL('admin/'.$usr->slug.'/dashboard/estates')}}" class="btn btn-label-primary-o2" style="cursor: pointer !important;">View More</a>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <div class="row">
                                @foreach($estates as $estate)
                                    <div class="col-md-6">
                                        <div class="kt-portlet kt-portlet--height-fluid">
                                            <div class="kt-portlet__head kt-portlet__head--noborder">

                                            </div>
                                            <div class="kt-portlet__body kt-portlet__body--fit-y kt-margin-b-40">
                                                <!--begin::Widget -->
                                                <div class="kt-widget kt-widget--user-profile-4">
                                                    <div class="kt-widget__head">
                                                        <div class="kt-widget__media">
                                                            <img class="kt-widget__img kt-hidden" src="assets/media/users/300_21.jpg" alt="image">
                                                            <div class="kt-widget__pic kt-widget__pic--success kt-font-success kt-font-boldest kt-hidden-">
                                                                {{$estate->name[0]}}
                                                            </div>
                                                        </div>
                                                        <div class="kt-widget__content">
                                                            <div class="kt-widget__section">
                                                                <a href="#" class="kt-widget__username">
                                                                    {{$estate->name}}
                                                                </a>

                                                                <div class="kt-widget__button">
                                                                    @if($estate->isActive)
                                                                        <span class="btn btn-label-success btn-sm">Active</span>
                                                                    @else
                                                                        <span class="btn btn-label-danger btn-sm">Not Active</span>
                                                                    @endif
                                                                </div>

                                                                <div class="kt-widget__action">
                                                                    {{$estate->noOfPlots}}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--end::Widget -->
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
