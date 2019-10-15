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
                                    Estate Information <small>.</small>
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
                                        <a class="nav-link" data-toggle="tab" href="#kt_tabs_7_2" role="tab">
                                            Transactions
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
                                            <td style="border: none">{{$estate->name}}</td>
                                        </tr>

                                        <tr>
                                            <td><a style="font-weight: bold;font-size: 15px;">Number Of Plots:</a></td>
                                            <td>{{$estate->noOfPlots}}</td>
                                        </tr>

                                        <tr>
                                            <td><a style="font-weight: bold;font-size: 15px;">Number Of Sold Plots:</a></td>
                                            <td>{{$estate->noOfSoldPlots}}</td>
                                        </tr>
                                        <tr>
                                            <td><a style="font-weight: bold;font-size: 15px;">Amount:</a></td>
                                            <td><a class="text-success" style="font-size: 18px;">₦ {{ App\Http\Helpers\Helper::MoneyConvert($estate->amount, "full") }}</a> per plot</td>
                                        </tr>

                                        <tr>
                                            <td><a style="font-weight: bold;font-size: 15px;">Address:</a></td>
                                            <td>{{$estate->address. ', '. $estate->state.', '. $estate->country}}</td>
                                        </tr>

                                        <tr>
                                            <td><a style="font-weight: bold;font-size: 15px;">Bio:</a></td>
                                            <td>{{$estate->bio}}</td>
                                        </tr>

                                        <tr>
                                            <td><a style="font-weight: bold;font-size: 15px;">Additional Fees:</a></td>
                                            <td>{{$estate->additionalFees}}</td>
                                        </tr>

                                        <tr>
                                            <td><a style="font-weight: bold;font-size: 15px;">Rules:</a></td>
                                            <td>{{$estate->rules}}</td>
                                        </tr>

                                        <tr>
                                            <td><a style="font-weight: bold;font-size: 15px;">Images</a></td>
                                            <td>
                                                @foreach($estate->images as $image)
                                                    <img src="{{$image->image}}" class="img-responsive mr-2" width="140" height="100">
                                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><a style="font-weight: bold;font-size: 15px;">Company:</a></td>
                                            <td> <a style="text-transform: uppercase" href="{{URL("admin/".$usr->slug."/dashboard/companies/".$estate->metaData["company"]->slug)}}">{{$estate->metaData["company"]->name}} </a></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane" id="kt_tabs_7_2" role="tabpanel">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>Client name</th>
                                            <th>Property Size</th>
                                            <th>Property Name</th>
                                            <th>Payment Type</th>
                                            <th>Payment Cycle</th>
                                            <th>Amount In Total</th>
                                            <th>Amount Paid</th>
                                            <th>Amount Outstanding</th>
                                            <th>Direct Agent</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($transactions as $transaction)
                                            <tr>
                                                <td>{{$transaction->user->name}}</td>
                                                <td>{{$estate->size." sqms"}}</td>
                                                <td>{{$transaction->estate->name}}</td>
                                                <td>
                                                    @if($transaction->cycle !== 1)
                                                        <a class="btn btn-label-success btn-sm">installment</a>
                                                    @else
                                                        <a class="btn btn-label-danger btn-sm">outright</a>
                                                    @endif
                                                </td>
                                                <td>{{$transaction->cycle}}</td>
                                                <td><sup>₦</sup>{{ App\Http\Helpers\Helper::MoneyConvert($transaction->amountinTotal, "full") }}</td>
                                                <td><sup>₦</sup>{{ App\Http\Helpers\Helper::MoneyConvert($transaction->amountPaid, "full") }}</td>
                                                <td><sup>₦</sup>{{ App\Http\Helpers\Helper::MoneyConvert($transaction->amountOutstand, "full")}}</td>
                                                <td>
                                                    @if($agent !== null)
                                                        {{$agent->user->name}}
                                                    @else
                                                        None
                                                    @endif

                                                </td>
                                                <td>
                                                    <a href="{{URL('admin/'.$usr->slug.'/dashboard/transactions/'.$transaction->slug)}}" class="btn btn-primary">View</a>
                                                </td>
                                            </tr>
                                        @empty
                                            <div style="margin: 0 auto; width: 200px;padding-top: 20px; padding-bottom: 20px;">
                                                <img src="{{URL("/").'/images/notFound.png'}}" style="width: 180px;" class="img-responsive">
                                                <p style="font-size: 20px; font-weight: bold">No Results Found</p>
                                            </div>
                                        @endforelse
                                        </tbody>
                                    </table>
                                    {{$transactions->links()}}
                                </div>
{{--                                <div class="tab-pane pt-5" id="kt_tabs_7_3" role="tabpanel">--}}
{{--                                    @foreach($estate->metaData["properties"] as $property)--}}
{{--                                        <div class="col-md-3">--}}
{{--                                            <div class="kt-portlet kt-portlet--height-fluid kt-widget19">--}}
{{--                                                <div class="kt-portlet__body kt-portlet__body--fit kt-portlet__body--unfill">--}}
{{--                                                    <div class="kt-widget19__pic kt-portlet-fit--top kt-portlet-fit--sides" style="min-height: 300px; background-image: url({{$property->image->image}})">--}}
{{--                                                        <div class="kt-widget19__shadow"></div>--}}
{{--                                                        <div class="kt-widget19__labels">--}}
{{--                                                            @if($property->isDeleted)--}}
{{--                                                                <a href="#" class="btn btn-label-danger-o2 btn-bold btn-sm ">Sold</a>--}}
{{--                                                            @else--}}
{{--                                                                <a href="#" class="btn btn-label-success-o2 btn-bold btn-sm ">Active</a>--}}
{{--                                                            @endif--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="kt-portlet__body pl-0">--}}
{{--                                                    <div class="kt-widget19__wrapper">--}}
{{--                                                        <div class="kt-widget19__content">--}}
{{--                                                            <div class="kt-widget19__userpic">--}}
{{--                                                                <img src="assets/media/users/user1.jpg" alt="">--}}
{{--                                                            </div>--}}
{{--                                                            <div class="kt-widget19__info" style="color:#000;">--}}
{{--                                                                <a href="#" class="kt-widget19__username pb-1">--}}
{{--                                                                    <a style="font-size: 13px;"><b style="font-size: 15px;">Number of Plots:</b> {{$property->noOfPlots}}</a>--}}
{{--                                                                </a>--}}
{{--                                                                <a href="#" class="kt-widget19__username pb-1">--}}
{{--                                                                    <a class="text-success" style="font-size: 13px;"><b style="font-size: 15px;color: #000">Amount:</b> NGN {{ App\Http\Helpers\Helper::MoneyConvert($property->amount, "full") }}</a>--}}
{{--                                                                </a>--}}

{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="kt-widget19__action m-auto">--}}
{{--                                                        <a href="{{URL('admin/'.$usr->slug.'/dashboard/properties/'.$property->slug)}}" class="btn btn-primary">View</a>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    @endforeach--}}
{{--                                    {{$estate->metaData["properties"]->links()}}--}}
{{--                                </div>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
