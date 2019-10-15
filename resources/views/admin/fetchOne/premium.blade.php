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
                                    Premium Property Information <small>.</small>
                                </h3>
                            </div>
                            <div class="kt-portlet__head-toolbar">
                                <ul class="nav nav-pills nav-pills" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#kt_tabs_7_1" role="tab">
                                            Details
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
                                            <td style="border: none">{{$premium->name}}</td>
                                        </tr>

                                        <tr>
                                            <td><a style="font-weight: bold;font-size: 15px;">Number Of Plots:</a></td>
                                            <td>{{$premium->noOfPlots}}</td>
                                        </tr>
                                        <tr>
                                            <td><a style="font-weight: bold;font-size: 15px;">Amount:</a></td>
                                            <td><a class="text-success" style="font-size: 18px;">₦ {{ App\Http\Helpers\Helper::MoneyConvert($premium->amount, "full") }}</a> per plot</td>
                                        </tr>

                                        <tr>
                                            <td><a style="font-weight: bold;font-size: 15px;">Address:</a></td>
                                            <td>{{$premium->address. ', '. $premium->state.', '. $premium->country}}</td>
                                        </tr>

                                        <tr>
                                            <td><a style="font-weight: bold;font-size: 15px;">Bio:</a></td>
                                            <td>{{$premium->bio}}</td>
                                        </tr>

                                        <tr>
                                            <td><a style="font-weight: bold;font-size: 15px;">Additional Fees:</a></td>
                                            <td>{{$premium->additionalFees}}</td>
                                        </tr>

                                        <tr>
                                            <td><a style="font-weight: bold;font-size: 15px;">Rules:</a></td>
                                            <td>{{$premium->rules}}</td>
                                        </tr>

                                        <tr>
                                            <td><a style="font-weight: bold;font-size: 15px;">Images</a></td>
                                            <td>
                                                @foreach($premium->images as $image)
                                                    <img src="{{$image->image}}" class="img-responsive mr-2" width="140" height="100">
                                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><a style="font-weight: bold;font-size: 15px;">Company:</a></td>
                                            <td> <a style="text-transform: uppercase" href="{{URL("admin/".$usr->slug."/dashboard/companies/".$premium->metaData["company"]->slug)}}">{{$premium->metaData["company"]->name}} </a></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
