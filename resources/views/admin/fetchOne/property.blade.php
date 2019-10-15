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
                                    Property Information <small>.</small>
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
                                            <td style="border: none"><a style="font-weight: bold;font-size: 15px;">Number Of plots:</a></td>
                                            <td style="border: none">{{$property->noOfPlots}}</td>
                                        </tr>

                                        <tr>
                                            <td><a style="font-weight: bold;font-size: 15px;">Amount:</a></td>
                                            <td><a class="text-success"> NGN {{ App\Http\Helpers\Helper::MoneyConvert($property->amount, "full") }}</a></td>
                                        </tr>

                                        <tr>
                                            <td><a style="font-weight: bold;font-size: 15px;">Estate:</a></td>
                                            <td><a>{{$property->metaData["estate"]->name}}</a></td>
                                        </tr>

                                        <tr>
                                            <td><a style="font-weight: bold;font-size: 15px;">Company</a></td>
                                            <td><a href="{{URL('admin/'.$usr->slug.'/dashboard/companies/'.$property->metaData["company"]->slug)}}">{{$property->metaData["company"]->name}}</a></td>
                                        </tr>

                                        <tr>
                                            <td><a style="font-weight: bold;font-size: 15px;">Images</a></td>
                                            <td>
                                                @foreach($property->images as $image)
                                                    <img src="{{$image->image}}" class="img-responsive mr-2" width="140" height="100">
                                                @endforeach
                                            </td>
                                        </tr>

                                        <tr>
                                            <td><a style="font-weight: bold;font-size: 15px;">Description</a></td>
                                            <td>
                                                <a>{{$property->description}}</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><a style="font-weight: bold;font-size: 15px;">Rules</a></td>
                                            <td>
                                                <a>{{$property->rules}}</a>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane" id="kt_tabs_7_2" role="tabpanel">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>User</th>
                                            <th>Name</th>
                                            <th>Location</th>
                                            <th>Last Payment</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($transactions as $transaction)
                                            <tr>
                                                <td>{{$transaction->user->name}}</td>
                                                <td>{{$property->noOfPlots." plots"}}</td>
                                                <td>{{$transaction->estate->name.", ".$transaction->estate->address}}</td>
                                                <td>{{$transaction->updated_at}}<td>
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
                                <div class="tab-pane pt-5" id="kt_tabs_7_3" role="tabpanel">
                                    Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
