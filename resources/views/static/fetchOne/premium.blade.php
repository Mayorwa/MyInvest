@extends('template.interface')
@section('content')
    <div id="section-body">


        <section class="container-fluid">
            <div class="row" style="height: 500px;">
                <div class="slick-track">
                    @foreach($premium->images as $image)
                        <div class="col-md-4 p-0" data-slick-index="-2" aria-hidden="true" tabindex="-1">
                            <a class="swipebox" tabindex="-1">
                                <img class="img-responsive" src="{{$image->image}}" style="height: 420px;">
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="main-content-area detail-property-page detail-property-page-v1" style="transform: none;">
            <div class="container" style="transform: none;">
                <div class="row" style="transform: none;">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="content-area">
                            <div class="title-section">
                                <div class="block block-top-title">
                                    <div class="block-body">
                                        <h1 class="listing-title">
                                            {{$premium->name}}
                                        </h1>
                                        <p>{{$premium->bio}}</p>
                                    </div><!-- block-body -->
                                </div><!-- block -->
                            </div><!-- title-section --><div id="about-section" class="about-section">

                                <div class="block-bordered">

                                    <div class="block-col block-col-33">
                                        <div class="block-icon">
                                            <i class="fa fa-home"></i>            </div>
                                        <div>Type</div>
                                        <div>
                                            <strong>
                                                Land
                                            </strong>
                                        </div>
                                    </div>

                                    <div class="block-col block-col-33">
                                        <div class="block-icon">
                                            <i class="fa fa-text-width"></i>            </div>
                                        <div>Size</div>
                                        <div><strong>{{$premium->size}} Sqms</strong></div>
                                    </div>

                                    <div class="block-col block-col-33">
                                        <div class="block-icon">
                                            <i class="fa fa-water"></i>            </div>
                                        <div>Plots</div>
                                        <div><strong>{{$premium->noOfPlots}} plots</strong></div>
                                    </div>

                                </div><!-- block-bordered -->


                                <div class="block">
                                    <div class="block-body">
                                        <h4 class="font-weight-bold">Description</h4>
                                        <p class="font-weight-light">{{$premium->description}}</p>
                                    </div>
                                </div>
                                <div class="block">
                                    <div class="block-body">
                                        <h4 class="font-weight-bold">Location</h4>
                                        <p class="font-weight-light">{{$premium->address.', '. $premium->state.', '. $premium->country}}</p>
                                    </div>
                                </div>
                                <div class="block">
                                    <div class="block-body">
                                        <h4 class="font-weight-bold">Rules</h4>
                                        <p class="font-weight-light">{{$premium->rules}}</p>
                                    </div>
                                </div>
                                <div class="block">
                                    <div class="block-section">
                                        <div class="block-body">
                                            <div class="block-left">
                                                <h3 class="title">Prices</h3>
                                            </div><!-- block-left -->
                                            <div class="block-right">
                                                <ul class="detail-list detail-list-2-cols">
                                                    <li>
                                                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                                                        Outright:
                                                        <strong class="text-success" style="font-size: 20px;font-weight: bold;">
                                                            NGN {{ App\Http\Helpers\Helper::MoneyConvert($premium->amount, "full") }}
                                                        </strong>
                                                    </li>

                                                </ul>
                                            </div><!-- block-right -->
                                        </div><!-- block-body -->
                                    </div><!-- block-section -->
                                </div><!-- block-body -->
                                <div class="block">
                                    <div class="block-body">
                                        <h4 class="font-weight-bold">Additional Fees</h4>
                                        <p class="font-weight-light">{{$premium->additionalFees}}</p>
                                    </div>
                                </div>
                            </div>

                            <div id="host-section" class="host-section">
                                <div class="block p-2">
                                    <div id="price-section" class="price-section">
                                    </div>
                                    <div style="width: 200px;" class="ml-auto mt-1">
                                        <a class="btn btn-success px-5 middlewareLink text-white" href="{{URL('/contact-us?q='.$premium->slug)}}">Contact Us</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
