@extends('template.interface')
@section('content')
<div class="kt-portlet">
    <div class="kt-portlet__body">
        <table class="table">
            <thead>
            <tr>
                <th>Client name</th>
                <th>Property Size</th>
                <th>Property Name</th>
                <th>Payment Type</th>
                <th>Payment Cycle</th>
                <th>Amount In Total</th>
                <th>Amount Paid</th>
                <th>Amount Outstanding</th>
                <th>Direct Agent</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($transactions as $transaction)
                <tr>
                    <td>{{$transaction->user->name}}</td>
                    <td>{{$transaction->estate->size." sqms"}}</td>
                    <td>{{$transaction->estate->name}}</td>
                    <td>
                        @if($transaction->cycle !== 1)
                            <a class="btn btn-label-success btn-sm">installment</a>
                        @else
                            <a class="btn btn-label-danger btn-sm">outright</a>
                        @endif
                    </td>
                    <td>{{$transaction->cycle}}</td>
                    <td><sup>₦</sup>{{ App\Http\Helpers\Helper::MoneyConvert($transaction->amountinTotal, "full") }}</td>
                    <td><sup>₦</sup>{{ App\Http\Helpers\Helper::MoneyConvert($transaction->amountPaid, "full") }}</td>
                    <td><sup>₦</sup>{{ App\Http\Helpers\Helper::MoneyConvert($transaction->amountOutstand, "full")}}</td>
                    <td>
                        @if($transaction->agent !== null)
                            {{$transaction->agent->user->name}}
                        @else
                            None
                        @endif

                    </td>
                    <td>
                        <a href="{{URL('user/dashboard/transaction/'.$transaction->slug)}}" class="btn btn-primary">View</a>
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
        {{$transactions->links()}}
    </div>
</div>
@endsection
