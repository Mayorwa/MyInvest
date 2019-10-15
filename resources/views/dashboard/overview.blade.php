@extends('template.interface')
@section('content')
    <div>
        @include('template.userMetrics')
        <div class="kt-portlet">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        Estates
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div id="listings_module_section" class="listing-wrap item-grid-view">
                    <div id="module_listings" class="row px-4 pt-3">

                        @forelse($estates as $estate)
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
                                            <a class="hover-effect" href="{{URL('company/dashboard/estates/'.$estate->slug)}}">
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
                                            <div class="kt-widget19__action m-auto" style="width: 100px;">
                                                <a href="{{URL('company/dashboard/estates/'.$estate->slug)}}" class="btn btn-primary px-4">View</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div style="margin: 0 auto; width: 200px;padding-top: 20px; padding-bottom: 20px;">
                                <img src="{{URL("/").'/images/notFound.png'}}" style="width: 180px;" class="img-responsive">
                                <p style="font-size: 20px; font-weight: bold">No Results Found</p>
                            </div>
                        @endforelse
                    </div>
                    {{$estates->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection
