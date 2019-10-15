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
                                    Users
                                </h3>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Phone No</th>
                                    <th>Type</th>
                                    <th>D.O.B</th>
                                    <th>Address</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->phone}}</td>
                                        <td><span class="btn btn-bold btn-sm btn-font-sm  btn-label-primary">{{$user->type}}</span></td>
                                        <td>{{$user->dob}}</td>
                                        <td>{{$user->address}}</td>
                                        <td>
                                            <a href="{{URL('admin/'.$usr->slug.'/dashboard/users/'.$user->slug)}}" class="btn btn-primary">View</a>
{{--                                            <a href="#" class="btn btn-danger">Deactivate</a>--}}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{$users->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
