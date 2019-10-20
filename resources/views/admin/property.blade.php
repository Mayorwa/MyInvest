@extends('template.adminMaster')
@section('content')
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" style="padding-bottom: 40px;">
        <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
            @include('template.metrics')
            <div class="row">
                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title" style="font-weight: bold">
                                Properties
                            </h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <div class="row">
                            @forelse($properties as $property)
                                <div class="col-md-3">
                                    <div class="kt-portlet kt-portlet--height-fluid kt-widget19">
                                        <div class="kt-portlet__body kt-portlet__body--fit kt-portlet__body--unfill">
                                            <div class="kt-widget19__pic kt-portlet-fit--top kt-portlet-fit--sides" style="min-height: 300px; background-image: url({{$property->image->image}})">
                                                <div class="kt-widget19__shadow"></div>
                                                <div class="kt-widget19__labels">
                                                    @if($property->isDeleted)
                                                        <a href="#" class="btn btn-label-danger-o2 btn-bold btn-sm ">Sold</a>
                                                    @else
                                                        <a href="#" class="btn btn-label-success-o2 btn-bold btn-sm ">Active</a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="kt-portlet__body pl-0">
                                            <div class="kt-widget19__wrapper">
                                                <div class="kt-widget19__content">
                                                    <div class="kt-widget19__info" style="color:#000;">
                                                        <a href="#" class="kt-widget19__username pb-1">
                                                            <a style="font-size: 13px;"><b style="font-size: 15px;">Number of Plots:</b> {{$property->noOfPlots}}</a>
                                                        </a>
                                                        <a href="#" class="kt-widget19__username pb-1">
                                                            <a style="font-size: 13px;"><b style="font-size: 15px;">Estate:</b>{{$property->metaData['estate']->name}}</a>
                                                        </a>
                                                        <a href="#" class="kt-widget19__username pb-1">
                                                            <a class="text-success" style="font-size: 13px;"><b style="font-size: 15px;color: #000">Amount:</b> NGN {{ App\Http\Helpers\Helper::MoneyConvert($property->amount, "full") }}</a>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="kt-widget19__action m-auto">
                                                <a href="{{URL('admin/'.$usr->slug.'/dashboard/properties/'.$property->slug)}}" class="btn btn-primary">View</a>
                                                <a href="{{URL('admin/'.$usr->slug.'/dashboard/properties/delete?slug='.$property->slug)}}" class="btn btn-danger">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div style="margin: 0 auto; width: 200px;padding-top: 20px; padding-bottom: 20px;">
                                    <img src="{{URL("/").'/public/images/notFound.png'}}" style="width: 180px;" class="img-responsive">
                                    <p style="font-size: 20px; font-weight: bold">No Results Found</p>
                                </div>
                            @endforelse
                            {{$properties->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" style="margin-top: 60px;" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form action="{{URL('admin/property/create')}}" enctype="multipart/form-data" method="POST" name="myForm">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel" style="font-weight: bold">Create Property</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-md-6 pt-2">
                                <label style="color: #000" for="">No. Of Plots:</label>
                                <input type="number" class="form-control input-lg" name="noOfPlots" required>
                            </div>
                            <div class="col-md-6 pt-2">
                                <label style="color: #000" for="">Amount:</label>
                                <input type="number" class="form-control input-lg" name="amount" required>
                            </div>
                            <div class="col-md-6 pt-2">
                                <label style="color: #000" for="">Estates:</label>
                                <select name="estateId" class="form-control input-lg" id="" required>
                                    <option value="">- - Select Estate - -</option>
                                    @foreach($estates as $estate)
                                        <option value="{{$estate->id}}">{{$estate->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 pt-2">
                                <label style="color: #000" for="">Image 1:</label>
                                <input type="file" class="form-control  input-lg" name="images[]" required>
                            </div>
                            <div class="col-md-6 pt-2">
                                <label style="color: #000" for="">Image 2:</label>
                                <input type="file" class="form-control  input-lg" name="images[]" required>
                            </div>
                            <div class="col-md-6 pt-2">
                                <label style="color: #000" for="">Image 3:</label>
                                <input type="file" class="form-control  input-lg" name="images[]" required>
                            </div>
                            <div class="col-md-6 pt-2">
                                <label style="color: #000" for="">Description:</label>
                                <textarea class="form-control input-lg" name="description" required>

                                </textarea>
                            </div>
                            <div class="col-md-6 pt-2 form-group">
                                <label style="color: #000">Payment Types</label>
                                <div class="kt-radio-inline">
                                    <label class="kt-radio">
                                        <input type="radio" name="radios" checked="checked" id="outright" value="1"> Outright
                                        <span></span>
                                    </label>
                                    <label class="kt-radio">
                                        <input type="radio" name="radios" id="installment" value="2"> Installment
                                        <span></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12 pt-2">
                                <label style="color: #000" for="">Rules:</label>
                                <textarea class="form-control input-lg" name="rules">

                                </textarea>
                            </div>
                            <div class="col-md-12 pt-1 mt-2" id="instllDiv" style="border-top: 1px dotted #dbdbdb;display: none;">
                                <label for="" style="color: #000">Payment Cycles</label>
                                <div class="row" id="duplicatediv">
                                    <div class="col-md-6 pt-2">
                                        <label>No. of Months</label>
                                        <input type="number" class="form-control  input-lg" name="noOfMonths[]">
                                    </div>
                                    <div class="col-md-6 pt-2">
                                        <label>Amount</label>
                                        <input type="number" class="form-control  input-lg" name="insAmounts[]">
                                    </div>
                                </div>
                                <a class="btn btn-primary mt-2" id="btn-copy" style="cursor: pointer; color: #fff;">Add another</a>
                                <a class="btn btn-danger mt-2" id="btn-remove" style="cursor: pointer; color: #fff;">Remove</a>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div data-toggle="modal" data-target="#exampleModal" id="kt_scrolltop" class="kt-scrolltop" style="opacity: 1; display: flex; border-radius: 50%;height: 60px; width: 60px;">
        <a style="font-size: 18px; color: #fff">
            <i class="fa fa-plus"></i>
        </a>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript">
        var rad = document.myForm.radios;
        var prev = null;
        for (var i = 0; i < rad.length; i++) {
            rad[i].addEventListener('change', function() {
                // (prev) ? console.log(prev.value): null;
                if (this !== prev) {
                    prev = this;
                }
                if(this.value == 2){
                    $('#instllDiv').show();
                } else {
                    $('#instllDiv').hide();
                }
                console.log(this.value)
            });
        }

        $('#btn-copy').on('click', function(){
            var ele = $("#duplicatediv").last().clone(true);
            $("#duplicatediv").last().after(ele);
        });

        $('#btn-remove').on('click', function (e) {
            console.log("How Far");
            $("#duplicatediv").last().remove();
        });
    </script>
@stop
