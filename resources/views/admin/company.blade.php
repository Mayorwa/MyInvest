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
                                <h3 class="kt-portlet__head-title" style="font-weight: bold">
                                    Companies
                                </h3>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>Users Name</th>
                                    <th>D.O.B</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @forelse($companies as $company)
                                        <tr>
                                            <td>{{$company->name}}</td>
                                            <td>{{$company->email}}</td>
                                            <td>{{$company->address}}</td>
                                            <td>{{$company->metaData["user"]->name}}</td>
                                            <td>{{$company->metaData["user"]->dob}}</td>
                                            <td>
                                                <a href="{{URL('admin/'.$usr->slug.'/dashboard/companies/'.$company->slug)}}" class="btn btn-primary">View</a>
{{--                                                <a href="#" class="btn btn-danger">Deactivate</a>--}}
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
                            {{$companies->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
