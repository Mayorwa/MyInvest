@extends('template.interface')
@section('content')
    <div>
        @include('template.userMetrics')
        <div class="kt-portlet">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        Recent Transactions
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
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
                            <td>{{$transaction->estate->size." sqms"}}</td>
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
                            <img src="{{URL("/").'/public/images/notFound.png'}}" style="width: 180px;" class="img-responsive">
                            <p style="font-size: 20px; font-weight: bold">No Results Found</p>
                        </div>
                    @endforelse
                    </tbody>
                </table>
                {{$transactions->links()}}
            </div>
        </div>
        <div class="kt-portlet">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        Some Properties you Purchased
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div id="listings_module_section" class="listing-wrap item-card-view">
                    <div id="module_listings" class="row">
                        @forelse($estates as $property)
                            <div class="item-wrap infobox_trigger homey-matchHeight col-md-6">
                                <div class="media property-item">

                                    <div class="item-media item-media-thumb">
                                        <a class="hover-effect" href="">
                                            <img width="450" height="300" src="{{$property->image->image}}" class="wp-post-image" alt="" style="height: 250px; width: 370px;" />
                                        </a>

                                        <div class="title-head">

                                        <span class="item-price">
                                            <sup class="text-success">NGN </sup>{{ App\Http\Helpers\Helper::MoneyConvert($property->amount, "full") }}<sub></sub>
                                        </span>

                                            <h2 class="title">{{$property->name}}</h2>

                                            <ul class="item-amenities">
                                                <li>
                                                <span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <polygon id="Shape" points="0 0 24 0 24 24 0 24"/>
                                                            <rect id="Rectangle-89" fill="#000000" opacity="0.3" x="2" y="5" width="20" height="2" rx="1"/>
                                                            <rect id="Rectangle-89-Copy-5" fill="#000000" opacity="0.3" x="2" y="17" width="20" height="2" rx="1"/>
                                                            <rect id="Rectangle-89-Copy-2" fill="#000000" opacity="0.3" x="2" y="9" width="5" height="2" rx="1"/>
                                                            <rect id="Rectangle-89-Copy-4" fill="#000000" opacity="0.3" x="16" y="13" width="6" height="2" rx="1"/>
                                                            <rect id="Rectangle-89-Copy-3" fill="#000000" opacity="0.3" x="9" y="9" width="13" height="2" rx="1"/>
                                                            <rect id="Rectangle-89-Copy" fill="#000000" opacity="0.3" x="2" y="13" width="12" height="2" rx="1"/>
                                                        </g>
                                                    </svg>
                                                </span>
                                                    <span class="total-beds">{{$property->noOfPlots}}</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        @empty
                            <div style="margin: 0 auto; width: 200px;padding-top: 20px; padding-bottom: 20px;">
                                <img src="{{URL("/").'/public/images/notFound.png'}}" class="img-responsive">
                                <p style="font-size: 20px; font-weight: bold">No Results Found</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
