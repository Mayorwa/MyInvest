<!DOCTYPE html>
<html lang="en" >
<!-- begin::Head -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
@include('template.interhead')
<body  class="page-template page-template-template page-template-template-listing-grid page-template-templatetemplate-listing-grid-php page page-id-548 compare-property-active wpb-js-composer js-comp-ver-6.0.2 vc_responsive"  >
<div class="nav-area header-type-1 ">
    @include('template.header')
    @if(!(Request::is('listing*') || Request::is('investment-flow*') || Request::is('contact-us*')))
        @include('template.menu')
    @endif
    @if(Request::is("listings*"))
        <div id="homey-main-search" class="main-search " data-sticky="0">
            <div class="container-fluid">
                <form class="clearfix" action="https://demo01.gethomey.io/search-results/" method="GET">
                    <div id="search-desktop" class="search-wrap hidden-sm hidden-xs">
                        <div class="search-date-range main-search-date-range-js">
                            <div class="search-date-range-arrive">
                                <label class="animated-label">Arrive</label>
                                <input name="arrive" autocomplete="off" value="" type="text" class="form-control" placeholder="Arrive">
                            </div>
                            <div class="search-date-range-depart">
                                <label class="animated-label">Depart</label>
                                <input name="depart" autocomplete="off" value="" type="text" class="form-control" placeholder="Depart">
                            </div>
                            <!-- On mobile: display this button below when  the user selected arrival and depart dates -->
                            <button style="display: none;" class="btn btn-primary search-calendar-btn">Done</button>
                        </div>

                        <div class="search-filters">
                            <button type="button" class="btn btn-grey-outlined search-filter-btn"><i class="fa fa-sliders fa-rotate-90" aria-hidden="true"></i></button>
                        </div>

                        <div class="search-button">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>

                    </div><!-- search-wrap -->

                    <div class="search-wrap search-banner-mobile">

                        <div class="search-destination">
                            <input value="" type="text" class="form-control" placeholder="Where to go?" onfocus="blur();">
                        </div>

                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
@include('template.errors')

    <div id="section-body">
    <section class="main-content-area listing-page listing-page-full-width homey-matchHeight-needed">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="page-title">
                        <div class="block-top-title">
                            <ol class="breadcrumb">
                                <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a itemprop="url" href="../index.html"></a></li><li class="active">{{$page}}</li></ol>                        <h1 class="listing-title" style="text-transform: uppercase;">{{$page}}</h1>
                        </div><!-- block-top-title -->
                    </div><!-- page-title -->
                </div>
            </div><!-- .row -->
        </div>
    @if(Request::is('listing*') && !Request::is('listings'))
        <div class="container-fluid">
    @else
        <div class="container">
    @endif
            @yield("content")
        </div>   <!-- .container -->


    </section><!-- main-content-area listing-page grid-listing-page -->

</div>
@include('template.footer')
@include('template.foot')
</body>
</html>
