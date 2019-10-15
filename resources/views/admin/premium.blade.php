@extends('template.adminMaster')
@section('content')
    <style>
        .pt-2 label{
            font-weight: bold;
        }
    </style>
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" style="padding-bottom: 40px;">
        <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
            @include('template.metrics')
            <div class="row">
                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title" style="font-weight: bold">
                                Premium Investments
                            </h3>
                        </div>
                    </div>
                    <div id="listings_module_section" class="listing-wrap item-grid-view">
                        <div id="module_listings" class="row px-4 pt-3">
                            @forelse($premiums as $premium)
                                <div class="item-wrap infobox_trigger homey-matchHeight">
                                    <div class="property-item" style="box-shadow: 0px 0px 13px 0px rgba(82, 63, 105, 0.05)">
                                        <div class="media-left">
                                            <div class="item-media item-media-thumb">
                                            <span class="label-wrap top-left">
                                                 @if($premium->isActive)
                                                    <span class="btn btn-label-success btn-sm">Active</span>
                                                @else
                                                    <span class="btn btn-label-danger btn-sm">Not Active</span>
                                                @endif
                                            </span>
                                                <a class="hover-effect" href="{{URL('admin/'.$usr->slug.'/dashboard/estates/'.$premium->slug)}}">
                                                    <img width="450" height="300" src="{{$premium->image->image}}" class="img-responsive wp-post-image"/>
                                                </a>
                                                <div class="item-media-price">
                                                <span class="item-price">
                                                    <sup>₦</sup>{{ App\Http\Helpers\Helper::MoneyConvert($premium->amount, "full") }}<sub> per plot</sub>
                                                </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="media-body item-body clearfix">
                                            <div class="item-title-head table-block">
                                                <div class="title-head-left">
                                                    <h2 class="title"><a>{{$premium->name}}</a></h2>
                                                    <address class="item-address"><i class="fa fa-map-marker-alt"></i> {{$premium->address .', '. $premium->state .', '. $premium->country }}</address>
                                                </div>
                                            </div>

                                            <ul class="item-amenities">

                                                <li>
                                                    <i class="fa fa-layer-group"></i> <span class="total-beds">{{$premium->noOfPlots}}</span> <span
                                                        class="item-label">Plots</span>
                                                </li>

                                            </ul>

                                            <div class="item-footer">
                                                <div class="kt-widget19__action m-auto" style="width: 130px;">
                                                    <a href="{{URL('admin/'.$usr->slug.'/dashboard/premiums/'.$premium->slug)}}" class="btn btn-primary">View</a>
                                                    <a href="{{URL('admin/'.$usr->slug.'/dashboard/premiums/delete?slug='.$premium->slug)}}" class="btn btn-danger">Delete</a>
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
                        {{$premiums->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade pb-5" style="margin-top: 60px;" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <form action="{{URL('admin/premium/create')}}" enctype="multipart/form-data" method="POST" name="myForm">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel" style="font-weight: bold">Create Premium Property</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-md-4 pt-2">
                                <label style="color: #000" for="">Name:</label>
                                <input type="text" class="form-control input-lg" name="name" required>
                            </div>
                            <div class="col-md-4 pt-2">
                                <label style="color: #000" for="">Number Of Plots:</label>
                                <input type="number" pattern="\d*" class="form-control input-lg" name="noOfPlots" required>
                            </div>
                            <div class="col-md-4 pt-2">
                                <label style="color: #000" for="">Size in Sqms:</label>
                                <input type="number" pattern="\d*" class="form-control input-lg" name="size" required>
                            </div>
                            <div class="col-md-4 pt-2">
                                <label style="color: #000" for="">Amount Per Plot:</label>
                                <input type="number" pattern="\d*" class="form-control input-lg" name="amount" required>
                            </div>
                            <div class="col-md-4 pt-2">
                                <label style="color: #000" for="">Company:</label>
                                <select name="companyId" class="form-control" id="" required>
                                    <option value="">Select Company</option>
                                    @foreach($companies as $company)
                                        <option value="{{$company->id}}">{{$company->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 pt-2">
                                <label style="color: #000" for="">Image 1:</label>
                                <input type="file" class="form-control  input-lg" name="images[]" required>
                            </div>
                            <div class="col-md-4 pt-2">
                                <label style="color: #000" for="">Image 2:</label>
                                <input type="file" class="form-control  input-lg" name="images[]" required>
                            </div>
                            <div class="col-md-4 pt-2">
                                <label style="color: #000" for="">Image 3:</label>
                                <input type="file" class="form-control  input-lg" name="images[]" required>
                            </div>
                            <div class="col-md-4 pt-2">
                                <label style="color: #000" for="">Country:</label>
                                <select class="form-control input-lg" name="country" id="country4">
                                    <option value="Nigeria">Nigeria</option>
                                </select>
                            </div>
                            <div class="col-md-4 pt-2">
                                <label style="color: #000" for="">State:</label>
                                <select class="form-control input-lg" name="state" required id="state4">
                                    <option value="Lagos">Lagos</option>
                                </select>
                            </div>
                            <div class="col-md-12 pt-2">
                                <label style="color: #000" for="">Address:</label>
                                <textarea class="form-control" name="address" required>

                                </textarea>
                            </div>
                            <div class="col-md-12 pt-2">
                                <label style="color: #000" for="">Bio:</label>
                                <textarea class="form-control" name="bio" required>

                                </textarea>
                            </div>
                            <div class="col-md-12 pt-2">
                                <label style="color: #000" for="">Description:</label>
                                <textarea class="form-control" name="description" required>

                                </textarea>
                            </div>
                            <div class="col-md-12 pt-2">
                                <label style="color: #000" for="">Additional Fees:</label>
                                <textarea class="form-control" name="additionalFees" required>

                                </textarea>
                            </div>
                            <div class="col-md-12 pt-2">
                                <label style="color: #000" for="">Rules:</label>
                                <textarea class="form-control" name="rules" required>

                                </textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div data-toggle="modal" data-target="#exampleModal" id="kt_scrolltop" class="kt-scrolltop" style="opacity: 1; display: flex; border-radius: 50%;height: 60px; width: 60px;">
        <a style="font-size: 18px; color: #fff">
            <i class="fa fa-plus"></i>
        </a>
    </div>
@stop
