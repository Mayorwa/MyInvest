@extends('template.interface')
@section('content')
    <div class="kt-portlet">
        <div class="kt-portlet__body">
            <div class="row">
                <div class="col-xl-9">
                    <div class="kt-timeline-v1 kt-timeline-v1--justified">
                        <div class="kt-timeline-v1__items">
                            <div class="kt-timeline-v1__marker"></div>

                            @foreach($transactions as $transaction)
                                <div class="kt-timeline-v1__item kt-timeline-v1__item">
                                    <div class="kt-timeline-v1__item-circle">
                                        <div class="kt-bg-danger"></div>
                                    </div>

                                    <span class="kt-timeline-v1__item-time kt-font-brand" style="width: fit-content;">
                                                {{ App\Http\Helpers\Helper::singular($transaction->created_at) }}
                                            </span>

                                    <div class="kt-timeline-v1__item-content">
                                        <div class="kt-timeline-v1__item-title">
                                            Payment For : {{$transaction->token->quantity.' plots,' . $transaction->estate->name}}
                                        </div>
                                        <div class="kt-timeline-v1__item-body">
                                            <p style="font-weight: bold">
                                                Status: <a href="#" class="btn btn-sm btn-label-success-o2 btn-bold">{{$transaction->status}}</a>
                                            </p>
                                        </div>
                                        <div class="kt-timeline-v1__item-actions">
                                            <a href="#" class="btn btn-sm btn-lab4el-success-o2 btn-bold p-0" style="background-color: transparent; font-size: 16px;"> NGN {{ App\Http\Helpers\Helper::MoneyConvert($transaction->amount, "full") }}</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            @if($landTrnx->isCompleted == false)
                                <div class="kt-timeline-v1__item kt-timeline-v1__item">
                                    <div class="kt-timeline-v1__item-circle">
                                        <div class="kt-bg-danger"></div>
                                    </div>

                                    <span class="kt-timeline-v1__item-time kt-font-warning" style="width: fit-content;">
                                                    {{ App\Http\Helpers\Helper::singular($landTrnx->nextPayment) }}
                                            </span>

                                    <div class="kt-timeline-v1__item-content">
                                        <div class="kt-timeline-v1__item-title text-muted text-center" style="font-size: 20px;">
                                            Pending
                                        </div>
                                    </div>
                                </div>
                            @endif
                            {{$transactions->links()}}
                        </div>
                    </div>
                </div>
                <div class="col-xl-3"></div>
            </div>
        </div>
    </div>
@endsection

