@extends('template.interface')
@section('content')
    <div>
        @include('template.userMetrics')
        <div class="kt-portlet">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        Recent Transactions
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                {{--<table class="table">
                    <thead>
                    <tr>
                        <th></th>
                        <th>Name</th>
                        <th>Location</th>
                        <th>Total Lands</th>
                        <th>Sales Coompleted</th>
                        <th>Sales In-Progress</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><a class="dhsco-rounded"></a></td>
                        <td>Bien</td>
                        <td>Ikoyi, Lagos State</td>
                        <td>25 plots</td>
                        <td>10 plots</td>
                        <td>10 plots</td>
                    </tr>
                    <tr>
                        <td><a class="dhsco-rounded"></a></td>
                        <td>Toluso</td>
                        <td>Lekki Phase 1, Lagos State</td>
                        <td>121 plots</td>
                        <td>80 plots</td>
                        <td>13 plots</td>
                    </tr>
                    <tr>
                        <td><a class="dhsco-rounded"></a></td>
                        <td>Crave</td>
                        <td>Epe, Lagos State</td>
                        <td>440 plots</td>
                        <td>330 plots</td>
                        <td>3 plots</td>
                    </tr>
                    <tr>
                        <td><a class="dhsco-rounded"></a></td>
                        <td>Folarin</td>
                        <td>Ago , Ogun State</td>
                        <td>250 plots</td>
                        <td>60 plots</td>
                        <td>77 plots</td>
                    </tr>
                    </tbody>
                </table>--}}
                You Don't Have any Recent Transactions
            </div>
        </div>
    </div>
@endsection
