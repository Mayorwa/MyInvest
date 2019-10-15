@extends('template.interface')
@section('content')
<div class="kt-portlet">
    <div class="kt-portlet__body">
        <table class="table">
            <thead>
            <tr>
                <th></th>
                <th>Item</th>
                <th>Location</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Cycle</th>
                <th>Date</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><a class="dhsco-rounded"></a></td>
                <td>2 plots of land</td>
                <td>Ikoyi, Lagos State</td>
                <td>$ 2,848.00</td>
                <td><span style="width: 100px;"><span class="btn btn-bold btn-sm btn-font-sm  btn-label-success">Success</span></span></td>
                <td>$178.00/month</td>
                <td>2, March 2018</td>
            </tr>
            <tr>
                <td><a class="dhsco-rounded"></a></td>
                <td>1 plot of land</td>
                <td>Lekki Phase 1, Lagos State</td>
                <td>$3,0000.00</td>
                <td><span style="width: 100px;"><span class="btn btn-bold btn-sm btn-font-sm  btn-label-danger">Failed</span></span></td>
                <td>$300.00/month</td>
                <td>8, January 2018</td>
            </tr>
            <tr>
                <td><a class="dhsco-rounded"></a></td>
                <td>7 plots of land</td>
                <td>Epe, Lagos State</td>
                <td>$7,850.00</td>
                <td><span style="width: 100px;"><span class="btn btn-bold btn-sm btn-font-sm  btn-label-success">Success</span></span></td>
                <td>$687.00/month</td>
                <td>23, June 2018</td>
            </tr>
            <tr>
                <td><a class="dhsco-rounded"></a></td>
                <td>2 acres of land</td>
                <td>Ago , Ogun State</td>
                <td>$3,050.00</td>
                <td><span style="width: 100px;"><span class="btn btn-bold btn-sm btn-font-sm  btn-label-success">Success</span></span></td>
                <td>$300.00/month</td>
                <td>2, July 2019</td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
