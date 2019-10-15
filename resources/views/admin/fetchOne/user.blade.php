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
                                    User Information <small>.</small>
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
                                            <td style="border: none">{{$user->name}}</td>
                                        </tr>

                                        <tr>
                                            <td><a style="font-weight: bold;font-size: 15px;">Email:</a></td>
                                            <td>{{$user->email}}</td>
                                        </tr>

                                        <tr>
                                            <td><a style="font-weight: bold;font-size: 15px;">Address:</a></td>
                                            <td>{{$user->address}}</td>
                                        </tr>

                                        <tr>
                                            <td><a style="font-weight: bold;font-size: 15px;">Contact:</a></td>
                                            <td>{{$user->phone}}</td>
                                        </tr>

                                        <tr>
                                            <td><a style="font-weight: bold;font-size: 15px;">D.O.B:</a></td>
                                            <td>{{$user->dob}}</td>
                                        </tr>
                                        <tr>
                                            <td><a style="font-weight: bold;font-size: 15px;">User Type:</a></td>
                                            <td>
                                                <span class="btn btn-bold btn-sm btn-font-sm  btn-label-primary">{{$user->type}}</span>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane" id="kt_tabs_7_2" role="tabpanel">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>Client name</th>
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
                                                <td>{{$user->name}}</td>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
