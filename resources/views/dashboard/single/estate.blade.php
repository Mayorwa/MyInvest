@extends('template.interface')
@section('content')
    <style>
        .nav-pills>li.active>a, .nav-pills>li.active>a:focus, .nav-pills>li.active>a:hover{
            background-color: #eee;
        }
    </style>
    <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
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
                                    <a class="nav-link" data-toggle="tab" href="#kt_tabs_7_3" role="tab">
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
                                        <td><a style="font-weight: bold;font-size: 15px;">Address:</a></td>
                                        <td>{{$estate->address}}</td>
                                    </tr>
                                    <tr>
                                        <td><a style="font-weight: bold;font-size: 15px;">Amount:</a></td>
                                        <td><a class="text-success"> NGN {{ App\Http\Helpers\Helper::MoneyConvert($estate->amount, "full") }}</a></td>
                                    </tr>
                                    <tr>
                                        <td><a style="font-weight: bold;font-size: 15px;">Images</a></td>
                                        <td class="d-flex">
                                            @foreach($estate->images as $image)
                                                <img src="{{$image->image}}" class="img-responsive mr-2" width="140" height="100">
                                            @endforeach
                                        </td>
                                    </tr>

                                    <tr>
                                        <td><a style="font-weight: bold;font-size: 15px;">Description</a></td>
                                        <td>
                                            <a>{{$estate->description}}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><a style="font-weight: bold;font-size: 15px;">Rules</a></td>
                                        <td>
                                            <a>{{$estate->rules}}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><a style="font-weight: bold;font-size: 15px;">Rules</a></td>
                                        <td>
                                            <a>{{$estate->bio}}</a>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane pt-5" id="kt_tabs_7_3" role="tabpanel">
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
                                            <td>{{$estate->name}}</td>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
