@extends('template.HomeMaster')
@section('content')
    <style>
        .box-shadow-0 {
            box-shadow: none !important; }

        .box-shadow-1 {
            box-shadow: 0 7px 12px 0 rgba(62, 57, 107, 0.16); }

        .box-shadow-2 {
            box-shadow: 0 10px 18px 0 rgba(62, 57, 107, 0.2); }

        .box-shadow-3 {
            box-shadow: 0 14px 24px 0 rgba(62, 57, 107, 0.26); }

        .box-shadow-4 {
            box-shadow: 0 16px 28px 0 rgba(62, 57, 107, 0.3); }

        .box-shadow-5 {
            box-shadow: 0 27px 24px 0 rgba(62, 57, 107, 0.36); }

    </style>
    <div id="section-body">
        <section class="top-banner-wrap ">

            <div class="banner-inner parallax" data-parallax-bg-image="https://images.unsplash.com/photo-1505521586751-90af6a8d5efa?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1268&q=80"></div><!-- banner-inner parallax -->

            <div class="banner-caption" style="margin-top: 60px;text-align: unset">
                <div class="text-center">
                    <h2 class="banner-title text-center">Search | Invest | Acquire</h2><p class="banner-subtitle">Invest to start your asset acquisition journey</p>
                </div>
                <div class="search-wrap search-banner search-banner-desktop hidden-xs">
                    <form class="clearfix" style="margin-top: 60px;" action="https://demo01.gethomey.io/search-results/" method="GET">

                        <div style="min-width: 330px;width: auto;vertical-align: middle;padding-right: 10px;display: table-cell">
                            <label style="color: #fff;">LOCATION:</label>
                            <select name="" id="" class="form-control input-search" style="height: 56px; padding: 10px 40px">
                                <option value="">-- Location --</option>
                                @foreach($estates as $estate)
                                    <option value="{{$estate->address}}">{{$estate->address}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div style="min-width: 330px;width: auto;vertical-align: middle;padding-right: 10px;">
                            <label style="color: #fff; text-align: left">PRICE:</label>
                            <input type="text" class="js-range-slider" name="my_range" value="" />



                        </div>

                        <div class="search-button">
                            <button type="submit" class="btn btn-primary btn-invest-red">Search</button>
                        </div>
                    </form>
                </div><!-- search-wrap -->

                <div class="search-wrap search-banner search-banner-mobile">
                    <form class="clearfix" style="margin-top: 60px;" action="https://demo01.gethomey.io/search-results/" method="GET">

                        <div style="min-width: 330px;width: auto;vertical-align: middle;padding-right: 10px;">
                            <label style="color: #fff;">LOCATION:</label>
                            <select name="" id="" class="form-control input-search" style="height: 56px; padding: 10px 40px">
                                <option value="">-- Location --</option>
                                @foreach($estates as $estate)
                                    <option value="{{$estate->address}}">{{$estate->address}}</option>
                                @endforeach
                            </select>
                        </div>
                        </br>
                        <div style="min-width: 330px;width: auto;vertical-align: middle;padding-right: 10px;">
                            <label style="color: #fff; text-align: left">PRICE:</label>
                            <input type="text" class="js-range-slider" name="my_range" value="" />



                        </div>

                        <div class="search-button" style="margin-top: 30px;">
                            <button type="submit" class="btn btn-primary btn-invest-red">Search</button>
                        </div>
                    </form>
                </div><!-- search-wrap -->



            </div><!-- banner-caption -->

        </section>
        <section class="main-content-area listing-page listing-page-full-width">

            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                        <div class="vc_row wpb_row vc_row-fluid">
                            <div class="wpb_column vc_column_container vc_col-sm-12">
                                <div class="vc_column-inner">
                                    <div class="wpb_wrapper">
                                        <div style="clear:both; width:100%; height:50px"></div>
                                        <div class="homey-module module-title section-title-module text-left ">
                                            <h2 >Open for Investment</h2>

                                            <p  class="sub-heading">Hand-picked selection of quality places</p>
                                        </div>
                                        <div style="clear:both; width:100%; height:30px"></div>
                                        <div class="module-wrap property-module-grid listing-carousel-next-prev-m3B6u property-module-grid-slider property-module-grid-slider-3cols">
                                            <div class="listing-wrap item-card-view">
                                                <div class="row">
                                                    <div id="homey-listing-carousel-m3B6u" data-token="m3B6u" class="homey-carousel homey-carouse-elementor item-card-slider-view item-card-slider-view-3cols">
                                                        @forelse($properties as $property)
                                                            <div class="item-wrap infobox_trigger homey-matchHeight">
                                                                <div class="media property-item">
                                                                    <div class="item-media item-media-thumb">
                                                                        <a class="hover-effect" href="{{URL('/listing/'.$property->slug)}}">
                                                                            <img width="450" height="300" src="{{$property->image->image}}" class="wp-post-image" alt="" style="height: 240px; width: 100%;" />
                                                                        </a>

                                                                        <div class="title-head">

                                                                            <span class="item-price">
                                                                                <sup class="text-success">NGN </sup>{{ App\Http\Helpers\Helper::MoneyConvert($property->amount, "full") }}<sub></sub>
                                                                            </span>

                                                                            <h2 class="title">{{$property->noOfPlots.' plots, '.$property->name}}</h2>

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
                                                                <img src="{{URL("/").'/images/notFound.png'}}" class="img-responsive">
                                                                <p style="font-size: 20px; font-weight: bold">No Results Found</p>
                                                            </div>
                                                        @endforelse
                                                    </div>
                                                </div>
                                            </div><!-- grid-listing-page -->
                                        </div>
                                        <div style="clear:both; width:100%; height:30px">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div data-vc-full-width="true" data-vc-full-width-init="false" class="vc_row wpb_row vc_row-fluid vc_custom_1539966302417 vc_row-has-fill">
                            <div class="wpb_column vc_column_container vc_col-sm-12">
                                <div class="vc_column-inner">
                                    <div class="wpb_wrapper">
                                        <div style="clear:both; width:100%; height:50px">

                                        </div>
                                        <div class="homey-module module-title section-title-module text-left ">
                                            <h2>Destinations</h2>
                                            <p  class="sub-heading">Explore our selection of the best places around the world</p>
                                        </div>
                                        <div style="clear:both; width:100%; height:30px"></div>
                                        <div class="module-wrap taxonomy-grid taxonomy-grid-1">
                                            <div class="row">

                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <div class="taxonomy-item taxonomy-card">
                                                        <a class="taxonomy-link hover-effect">
                                                            <div class="taxonomy-title">Owerri</div>
                                                            <img class="img-responsive" src="{{URL::secure_asset('destinations/owerri.jpg')}}" width="555" height="360" alt="listing_city">
                                                        </a>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <div class="taxonomy-item taxonomy-card">
                                                        <a class="taxonomy-link hover-effect">
                                                            <div class="taxonomy-title">Ibadan</div>
                                                            <img class="img-responsive" src="{{URL::secure_asset('destinations/Ibadan.jpg')}}" width="555" height="360" alt="listing_city">
                                                        </a>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <div class="taxonomy-item taxonomy-card">
                                                        <a class="taxonomy-link hover-effect">
                                                            <div class="taxonomy-title">Ogun</div>
                                                            <img class="img-responsive" src="{{URL::secure_asset('destinations/ogun.jpg')}}" width="555" height="360" alt="listing_city">
                                                        </a>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <div class="taxonomy-item taxonomy-card">
                                                        <a class="taxonomy-link hover-effect">
                                                            <div class="taxonomy-title">Lagos</div>
                                                            <img class="img-responsive" src="{{URL::secure_asset('destinations/lagos.jpg')}}" width="555" height="360" alt="listing_city">
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <div class="taxonomy-item taxonomy-card">
                                                        <a class="taxonomy-link hover-effect">
                                                            <div class="taxonomy-title">Abuja</div>
                                                            <img class="img-responsive" src="{{URL::secure_asset('destinations/abujae.jpg')}}" width="555" height="360" alt="listing_city">
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <div class="taxonomy-item taxonomy-card">
                                                        <a class="taxonomy-link hover-effect">
                                                            <div class="taxonomy-title">Imo</div>
                                                            <img class="img-responsive" src="{{URL::secure_asset('destinations/enugu.jpg')}}" width="555" height="360" alt="listing_city">
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <div class="taxonomy-item taxonomy-card">
                                                        <a class="taxonomy-link hover-effect">
                                                            <div class="taxonomy-title">Enugu</div>
                                                            <img class="img-responsive" src="{{URL::secure_asset('destinations/abuja.jpg')}}" width="555" height="360" alt="listing_city">
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div style="clear:both; width:100%; height:30px"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="vc_row-full-width vc_clearfix"></div>
                        <div class="vc_row wpb_row vc_row-fluid">
                            <div class="wpb_column vc_column_container vc_col-sm-12">
                                <div class="vc_column-inner">
                                    <div class="wpb_wrapper">
                                        <div style="clear:both; width:100%; height:50px"></div>
                                        <div class="homey-module module-title section-title-module text-left ">
                                            <h2 >Premium Investment</h2>

                                            <p  class="sub-heading">Hand-picked selection of quality places</p>
                                        </div>
                                        <div style="clear:both; width:100%; height:30px"></div>
                                        <div class="module-wrap property-module-grid listing-carousel-next-prev-m3B6u property-module-grid-slider property-module-grid-slider-3cols">
                                            <div class="listing-wrap item-card-view">
                                                <div class="row">
                                                    <div data-token="m3B6u" class="item-card-slider-view item-card-slider-view-3cols">
                                                        @forelse($highProps as $property)
                                                            <div class="item-wrap infobox_trigger homey-matchHeight">
                                                                <div class="media property-item box-shadow-4">

                                                                    <div class="item-media item-media-thumb">
                                                                        <a class="hover-effect" href="{{URL('/premium/'.$property->slug)}}">
                                                                            <img width="450" height="300" src="{{$property->image->image}}" class="wp-post-image" alt="" style="height: 240px; width: 100%;" />
                                                                        </a>

                                                                        <div class="title-head">

                                                                            <span class="item-price">
                                                                                <sup class="text-success">NGN </sup>{{ App\Http\Helpers\Helper::MoneyConvert($property->amount, "full") }}<sub></sub>
                                                                            </span>

                                                                            <h2 class="title">{{$property->noOfPlots.' plots, '.$property->name}}</h2>

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
                                                                <img src="{{URL("/").'/images/notFound.png'}}" class="img-responsive">
                                                                <p style="font-size: 20px; font-weight: bold">No Results Found</p>
                                                            </div>
                                                        @endforelse
                                                    </div>
                                                </div>
                                            </div><!-- grid-listing-page -->
                                        </div>
                                        <div style="clear:both; width:100%; height:30px">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="vc_row-full-width vc_clearfix">

                        </div>

                        <div class="vc_row-full-width vc_clearfix"></div>
                        <div class="vc_row wpb_row vc_row-fluid">
                            <div class="wpb_column vc_column_container vc_col-sm-12">
                                <div class="vc_column-inner">
                                    <div class="wpb_wrapper">
                                        <div style="clear:both; width:100%; height:50px"></div>		<div class="homey-module module-title section-title-module text-left ">
                                            <h2 >In Association with</h2>

                                            <p  class="sub-heading">We only work with the best companies around the globe</p>
                                        </div>
                                        <div style="clear:both; width:100%; height:30px"></div>        <script>
                                            jQuery(document).ready(function ($) {

                                                var sliderdiv = $('.partners-slider');

                                                sliderdiv.slick({
                                                    rtl: false,
                                                    lazyLoad: 'ondemand',
                                                    infinite: true,
                                                    speed: 300,
                                                    slidesToShow: 4,
                                                    arrows: true,
                                                    adaptiveHeight: true,
                                                    dots: true,
                                                    appendArrows: '.partners-module-slider',
                                                    prevArrow: '<button type="button" class="slick-prev">Prev</button>',
                                                    nextArrow: '<button type="button" class="slick-next">Next</button>',
                                                    responsive: [
                                                        {
                                                            breakpoint: 992,
                                                            settings: {
                                                                slidesToShow: 3,
                                                                slidesToScroll: 3
                                                            }
                                                        },
                                                        {
                                                            breakpoint: 769,
                                                            settings: {
                                                                slidesToShow: 2,
                                                                slidesToScroll: 2
                                                            }
                                                        }]
                                                });
                                            });
                                        </script>

                                        <div class="module-wrap partners-module partners-module-slider">
                                            <div class="partners-slider-wrap">
                                                <div class="row">
                                                    <div class="partners-slider">

                                                        <div class="partner-item text-center">
                                                            <div class="partner-thumb">
                                                                <!-- <a href="https://homeywp.com"> -->
                                                                <img width="285" height="160" src="{{URL::secure_asset('partners/paystack.png')}}" class="img-responsive wp-post-image" alt="" />                                    <!-- </a> -->
                                                            </div>
                                                        </div>
                                                        <div class="partner-item text-center">
                                                            <div class="partner-thumb">
                                                                <!-- <a href="https://homeywp.com"> -->
                                                                <img width="285" height="160" src="{{URL::secure_asset('partners/realtypro.png')}}" class="img-responsive wp-post-image" alt="" />                                    <!-- </a> -->
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div><!-- col-xs-12 col-sm-12 col-md-8 col-lg-8 -->
                </div><!-- .row -->
            </div>   <!-- .container -->


        </section>
    </div>
    <script>
        $(".js-range-slider").ionRangeSlider({
            type: "double",
            grid: true,
            @if($ranges["min"] !== null || $ranges["max"] !== null)
                min: {{$ranges["min"]}},
                max: {{$ranges["max"]}},
            @else
                min: 0,
                max: 1000000,
            @endif
            prefix: "NGN"
        });
    </script>
@stop
