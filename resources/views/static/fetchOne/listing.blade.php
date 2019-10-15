@extends('template.interface')
@section('content')
<div id="section-body">


    <section class="container-fluid">
        <div class="row" style="height: 500px;">
            <div class="slick-track">
                @foreach($estate->images as $image)
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
                                        {{$estate->name}}
                                    </h1>
                                    <p>{{$estate->bio}}</p>
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
                                    <div><strong>{{$estate->size}} Sqms</strong></div>
                                </div>

                                <div class="block-col block-col-33">
                                    <div class="block-icon">
                                        <i class="fa fa-water"></i>            </div>
                                    <div>Plots</div>
                                    <div><strong>{{$estate->noOfPlots}} plots</strong></div>
                                </div>

                            </div><!-- block-bordered -->


                            <div class="block">
                                <div class="block-body">
                                    <h4 class="font-weight-bold">Description</h4>
                                    <p class="font-weight-light">{{$estate->description}}</p>
                                </div>
                            </div>
                            <div class="block">
                                <div class="block-body">
                                    <h4 class="font-weight-bold">Location</h4>
                                    <p class="font-weight-light">{{$estate->address.', '. $estate->state.', '. $estate->country}}</p>
                                </div>
                            </div><!-- block-body -->



                        </div>
                        <div id="rules-section" class="rules-section">
                            <div class="block">
                                <div class="block-section">
                                    <div class="block-body">
                                        <div class="block-left">
                                            <h3 class="title">Rules</h3>
                                        </div><!-- block-left -->
                                        <div class="block-right">
                                            <ul class="detail-list">


{{--                                                <li><strong>Additional rules information</strong></li>--}}
                                                <li>{{$estate->rules}}</li>
                                            </ul>

                                        </div><!-- block-right -->
                                    </div><!-- block-body -->
                                </div><!-- block-section -->
                            </div><!-- block -->
                        </div>
                        <div id="host-section" class="host-section">
                            <div class="block p-2">
                                @if($usr !== null)
                                <div class="modal fade" id="exampleModal">
                                    <div class="modal-dialog __modal-dialog modal-sm" style="width: 300px; margin-top: 100px;">
                                        <div class="modal-content __modal-content" style="padding: 0px;">
                                            <div class="modal-header">
                                                <h4 class="modal-title __modal-title" style="text-align: center;">Make Payment</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="confirmAmount">
                                                    <center>
                                                        <small>pay</small>
                                                        <br><br>
                                                        <small style="position: relative;top: -10px;padding-right: 5px;color: #31a731;">&#x20A6;</small>
                                                        <span class="priceToBuy" style="color: #31a731;font-size: 27px;" id="amt"> </span>
                                                        <br><br>
                                                        <small>to</small>
                                                        <br><br>
                                                        <small>Purchase</small>
                                                        <br>
                                                        <h4>This Property</h4>
                                                    </center>
                                                </div>
                                                <br><br>
                                                <form action="{{ URL('transaction/makePayment') }}" method="POST" id="finalPayment">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="hidden" name="amount" id="planAmount" value="100000">
                                                    <input type="hidden" name="email" id="emailId" value="{{$usr->email}}">
                                                    <input type="hidden" name="reference" id="referenceID" value="">
                                                    <input type="hidden" name="key" id="secretKey" value="">
                                                    <input type="hidden" name="transactionId" id="transactionId">
                                                    <div class="row" style="margin-bottom: -15px;">
                                                        <center class="m-auto">
                                                            <a href="#" class="btn btn-link c-black pull-left" data-dismiss="modal">Cancel</a>
                                                            &nbsp;
                                                            <button href="#" class="btn btn-wide-blue pull-right btn-success" style="color:#fff;">Continue</button>
                                                        </center>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                <div id="price-section" class="price-section">
                                    <div class="block">
                                        <div class="block-section">
                                            <div class="block-body pb-5">
                                                <div class="block-left">
                                                    <h3 class="title">Prices</h3>
                                                </div><!-- block-left -->
                                                <div class="block-right">
                                                    <ul class="detail-list detail-list-2-cols">
                                                        @foreach($estate->metaData["inst"] as $inst)
                                                            <li>
                                                                <i class="fa fa-angle-right" aria-hidden="true"></i>
                                                                {{$inst->noOfMonths}} Months:
                                                                <strong class="text-success" style="font-size: 20px;font-weight: bold;">
                                                                    NGN {{ App\Http\Helpers\Helper::MoneyConvert($inst->price, "full") }}
                                                                </strong>
                                                            </li>
                                                        @endforeach
                                                        <li>
                                                            <i class="fa fa-angle-right" aria-hidden="true"></i>
                                                            Outright:
                                                            <strong class="text-success" style="font-size: 20px;font-weight: bold;">
                                                                NGN {{ App\Http\Helpers\Helper::MoneyConvert($estate->amount, "full") }}
                                                            </strong>
                                                        </li>

                                                    </ul>
                                                </div><!-- block-right -->
                                            </div><!-- block-body -->
                                        </div><!-- block-section -->
                                    </div><!-- block -->
                                </div>
                                <div id="rules-section" class="rules-section">
                                    <div class="block">
                                        <div class="block-section">
                                            <div class="block-body">
                                                <div class="block-left">
                                                    <h3 class="title">Additional Fees</h3>
                                                </div><!-- block-left -->
                                                <div class="block-right">
                                                    <ul class="detail-list">
                                                        <li>{{$estate->additionalFees}}</li>
                                                    </ul>

                                                </div><!-- block-right -->
                                            </div><!-- block-body -->
                                        </div><!-- block-section -->
                                    </div><!-- block -->
                                </div>
                                @if($usr != null)
                                <div class="pt-3 px-3">
                                    <form id="startPay" class="row" name="myForm" method="POST" action="{{URL('transaction/startTrnx')}}">
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                        <input type="hidden" name="userId" value="{{$usr->id}}">
                                        <input type="hidden" name="itemId" value="{{$estate->id}}">
{{--                                        <input type="hidden" name="amount" value="{{$estate->amount}}">--}}
                                        <div class="row col-md-6" style="border-right: 1px dashed #c4c4c4;">
                                            <div class="form-group col-md-6">
                                                <label for="" class="font-weight-bold">Quantity: </label>
                                                <select name="quantity" id="" class="form-control">
                                                    @for($i = 1; $i<= $estate->noOfPlots; $i++)
                                                        <option value="{{$i}}">{{$i.' plot'}}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="" class="font-weight-bold">Where you referred by an Agent: </label>
                                                <div>
                                                    <div class="d-flex mr-3">
                                                        <input type="radio" name="refered" value="1">
                                                        <p class="mr-2">Yes</p>
                                                        <input type="radio" name="refered" value="2" checked>
                                                        <p>No</p>
                                                    </div>
                                                    <div style="display: none !important;" id="referer">
                                                        <label for="" class="font-weight-bold"> Referer Id: </label>
                                                        <input type="text" class="form-control" name="referrerId">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row col-md-6 ml-1">
                                            <div class="form-group col-md-7">
                                                @foreach($estate->metaData["inst"] as $inst)
                                                <div class="d-flex">
                                                <input type="radio"  class="mr-1" name="amount" value="{{$inst->price}}">
                                                    <label>{{$inst->noOfMonths}} Months :
                                                        <strong class="text-success" style="font-size: 14px;font-weight: bold;">
                                                            NGN {{ App\Http\Helpers\Helper::MoneyConvert($inst->price, "full") }} / Month
                                                        </strong>
                                                        (NGN {{ App\Http\Helpers\Helper::MoneyConvert($inst->price * $inst->noOfMonths, "full") }})
                                                    </label>
                                                    <br>
                                                </div>
                                                @endforeach
                                                <div class="d-flex">
                                                    <input type="radio" name="amount" class="mr-1" value="{{$estate->amount}}" checked="checked">
                                                    <label>Outright :
                                                        <strong class="text-success" style="font-size: 14px;font-weight: bold;">
                                                            NGN {{ App\Http\Helpers\Helper::MoneyConvert($estate->amount, "full") }}
                                                        </strong>
                                                    </label>
                                                </div>
                                            </div>
                                            <div style="width: 200px;" class="mr-auto mt-1 col-md-5">
                                                <div style="width: 222px;" class="mr-auto">
                                                    <input type="checkbox" id="terms">
                                                    <a style="font-size:14px !important;">Accept our <a href="{{URL('terms-and-conditions')}}">Terms and Condition</a> </a>
                                                </div>
                                                <button class="btn btn-success px-5 middlewareLink" disabled="disabled" id="subBtn" type="submit">Proceed To Payment</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                @else
                                    <div style="width: 200px;" class="ml-auto mt-1">
                                        <div style="width: 222px;" class="ml-auto">
                                            <input type="checkbox" id="terms">
                                            <a style="font-size:14px !important;">Accept our <a href="{{URL('terms-and-conditions')}}">Terms and Condition</a> </a>
                                        </div>
                                        <button class="btn btn-success px-5 middlewareLink" disabled="disabled" id="middlewareLink">Proceed To Payment</button>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
    var rad = document.myForm.refered;
    var prev = null;
    for (var i = 0; i < rad.length; i++) {
        rad[i].addEventListener('change', function() {
            // (prev) ? console.log(prev.value): null;
            if (this !== prev) {
                prev = this;
            }
            if(this.value == 1){
                $('#referer').show();
            } else {
                $('#referer').hide();
            }
            console.log(this.value)
        });
    }

    $('#startPay').on('submit', function (e) {
        e.preventDefault();

        $('#subBtn').prop("disabled",true);

        $('#subBtn').text("Loading...");
        var that = $(this), url = that.attr('action'), type = that.attr('method');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });

        $.ajax({
            url: url,
            type: type,
            data: new FormData(this),
            contentType: false,
            processData: false,

            success: function (response) {
                $('#subBtn').prop("disabled",false);

                $('#subBtn').text("Proceed To Payment");
                if (response.error == false) {
                    var data = response.data;
                    $("#finalPayment").find("#referenceID").val(data.reference);
                    $("#finalPayment").find("#secretKey").val(data.token);
                    $("#finalPayment").find("#planAmount").val(data.amount);
                    $("#finalPayment").find("#transactionId").val(data.id);
                    $(".confirmAmount").find("#amt").text(data.amount);
                    $('#exampleModal').modal("show");
                    console.log(response);
                } else {
                    console.log(response);
                }
            },
        });
        return false;
    });

    $('#middlewareLink').click(function (e) {
        window.location = "{{URL('auth/login')}}";
    });
    $("#terms").on('change', function() {
        // (prev) ? console.log(prev.value): null;
        console.log($(this).prop("checked"));
        if($(this).prop("checked") === true){
            $('.middlewareLink').prop("disabled", false);

        } else{
            $('.middlewareLink').prop("disabled", true);
        }
    });
</script>
@endsection
