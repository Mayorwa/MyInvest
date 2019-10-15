@extends('template.adminMaster')
@section('content')
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" style="padding-bottom: 40px;">
        <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
            @include('template.metrics')
            <div class="row">
                <div class="col-md-12">
                    <div class="kt-portlet">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title" style="font-weight: bold;font-size: 19px;">
                                    Company Information <small>.</small>
                                </h3>
                            </div>
                            <div class="kt-portlet__head-toolbar">
                                <ul class="nav nav-pills nav-pills" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#kt_tabs_7_1" role="tab">
                                            Details
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#kt_tabs_7_3" role="tab">
                                            Estates
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="kt-portlet__body" style="padding-top: 0px;">
                            <div class="tab-content">
                                <div class="tab-pane active" id="kt_tabs_7_1" role="tabpanel">
                                    <table class="table single-table">
                                        <tbody>
                                        <tr>
                                            <td style="border: none"><a style="font-weight: bold;font-size: 15px;">Name:</a></td>
                                            <td style="border: none">{{$company->name}}</td>
                                        </tr>

                                        <tr>
                                            <td><a style="font-weight: bold;font-size: 15px;">Email:</a></td>
                                            <td>{{$company->email}}</td>
                                        </tr>

                                        <tr>
                                            <td><a style="font-weight: bold;font-size: 15px;">Address:</a></td>
                                            <td>{{$company->address}}</td>
                                        </tr>

                                        <tr>
                                            <td><a style="font-weight: bold;font-size: 15px;">Contact:</a></td>
                                            <td>{{$company->metaData["user"]->phone}}</td>
                                        </tr>

                                        <tr>
                                            <td><a style="font-weight: bold;font-size: 15px;">Company User Account</a></td>
                                            <td><a href="{{URL('admin/'.$usr->slug.'/dashboard/users/'.$company->metaData["user"]->slug)}}">{{$company->metaData["user"]->name}}</a></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane pt-5" id="kt_tabs_7_3" role="tabpanel">
                                    <div id="listings_module_section" class="listing-wrap item-grid-view">

                                    <div id="module_listings" class="row px-4 pt-3">
                                    @foreach($company->metaData["estates"] as $estate)
                                        <div class="item-wrap infobox_trigger homey-matchHeight">
                                            <div class="property-item" style="box-shadow: 0px 0px 13px 0px rgba(82, 63, 105, 0.05)">
                                                <div class="media-left">
                                                    <div class="item-media item-media-thumb">
                                                        <span class="label-wrap top-left">
                                                             @if($estate->isActive)
                                                                <span class="btn btn-label-success btn-sm">Active</span>
                                                            @else
                                                                <span class="btn btn-label-danger btn-sm">Not Active</span>
                                                            @endif
                                                        </span>
                                                        <a class="hover-effect" href="{{URL('admin/'.$usr->slug.'/dashboard/estates/'.$estate->slug)}}">
                                                            <img width="450" height="300" src="{{$estate->image->image}}" class="img-responsive wp-post-image"/>
                                                        </a>
                                                        <div class="item-media-price">
                                                <span class="item-price">
                                                    <sup>₦</sup>{{ App\Http\Helpers\Helper::MoneyConvert($estate->amount, "full") }}<sub> per plot</sub>
                                                </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="media-body item-body clearfix">
                                                    <div class="item-title-head table-block">
                                                        <div class="title-head-left">
                                                            <h2 class="title"><a>{{$estate->name}}</a></h2>
                                                            <address class="item-address"><i class="fa fa-map-marker-alt"></i> {{$estate->address .', '. $estate->state .', '. $estate->country }}</address>
                                                        </div>
                                                    </div>

                                                    <ul class="item-amenities">

                                                        <li>
                                                            <i class="fa fa-layer-group"></i> <span class="total-beds">{{$estate->noOfPlots}}</span> <span
                                                                class="item-label">Plots</span>
                                                        </li>

                                                    </ul>

                                                    <div class="item-footer">
                                                        <div class="kt-widget19__action m-auto" style="width: 130px;">
                                                            <a href="{{URL('admin/'.$usr->slug.'/dashboard/estates/'.$estate->slug)}}" class="btn btn-primary">View</a>
                                                            <a href="{{URL('admin/'.$usr->slug.'/dashboard/estates/delete?slug='.$estate->slug)}}" class="btn btn-danger">Delete</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    {{$company->metaData["estates"]->links()}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
