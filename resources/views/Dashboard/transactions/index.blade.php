@extends('Dashboard.layouts.master')
@section('title', trans('messages.transaction.transactions'))
@section('breadcrumb')
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="{{route('admin.home')}}"><i class="icon-home2 position-left"></i> @lang('messages.home')
                </a>
            </li>
            <li class="active">@lang('messages.transaction.transactions')</li>
        </ul>
        @include('Dashboard.layouts.parts.quick-links')
    </div>
@endsection


@section('content')
{{--    @include('Dashboard.layouts.parts.validation_errors')--}}


    <!-- Basic datatable -->
    <div class="panel panel-flat" dir="{{ direction() }}" style="margin: 20px;">
        <div class="panel-heading">
            @include('Dashboard.layouts.parts.table-header', ['collection' => $transactions, 'name' => 'transactions', 'icon' => 'transactions'])
        </div>
        <br>
{{--        <div class="list-icons" style="padding-right: 10px;">--}}
{{--            <a href="{{route('transactions.create')}}" class="btn btn-success btn-labeled btn-labeled-left"><b><i--}}
{{--                        class="icon-plus2"></i></b>{{ trans('messages.transaction.add') }}</a>--}}
{{--        </div>--}}

        <!-- Basic pills -->
        <div class="row" style="padding: 15px;">
            <div class="col-md-12">
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <div class="heading-elements">
                            <ul class="icons-list">
                                <li><a data-action="collapse"></a></li>
                                <li><a data-action="reload"></a></li>
                                <li><a data-action="close"></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="tabbable">
                            <ul class="nav nav-pills nav-pills-bordered nav-justified">
                                <li class="active"><a href="#online_transactions" data-toggle="tab">{{ trans('messages.transaction.online') }}</a></li>
                                <li><a href="#bank_deposit_transactions" data-toggle="tab">{{ trans('messages.transaction.bank_deposit') }}</a></li>
                                <li><a href="#cash_transactions" data-toggle="tab">{{ trans('messages.transaction.cash') }}</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="online_transactions">

                                    <div class="panel-body">
                                        @if($online_transactions->count() > 0)
                                            <table class="table datatable-basic" id="transactions" style="font-size: 16px;">
                                                <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th class="text-center">{{ trans('messages.user_name') }}</th>
{{--                                                    <th class="text-center">{{ trans('messages.transaction.user_wallet') }}</th>--}}
{{--                                                    <th class="text-center">{{ trans('messages.transaction.payment_type') }}</th>--}}
                                                    <th class="text-center">{{ trans('messages.transaction.amount') }}</th>
                                                    <th class="text-center">@lang('messages.transaction.since')</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($online_transactions as $transaction)
                                                    <tr id="transaction-row-{{ $transaction->id }}">

                                                        <td class="text-center">{{ $loop->iteration }}</td>
                                                        <td class="text-center">
                                                            <a href={{ route('buyers.show', $transaction->user->id) }}> {{ isNullable($transaction->user->full_name) }}</a>
                                                        </td>
                                                        {{-- <td class="text-center"><a href=""> {{ isNullable($transaction->user->wallet) }}</a></td>--}}
{{--                                                        <td class="text-center"><a href=""> {{ isNullable($transaction->payment_type) }}</a></td>--}}
                                                        <td class="text-center"><a href=""> {{ isNullable($transaction->amount) }}</a></td>
                                                        <td class="text-center">{{isset($transaction->created_at) ?$transaction->created_at->format('y/m/d'):'---' }}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>

                                        @else
                                            <center><h2> @lang('messages.no_data_found') </h2></center>
                                        @endif
                                    </div>
                                </div>
                                <div class="tab-pane" id="bank_deposit_transactions">
                                    <div class="panel-body">
                                        @if($bank_deposit_transactions->count() > 0)
                                            <table class="table datatable-basic" id="transactions" style="font-size: 16px;">
                                                <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th class="text-center">{{ trans('messages.user_name') }}</th>
                                                    <th class="text-center">{{ trans('messages.transaction.receipt_image') }}</th>
                                                    <th class="text-center">@lang('messages.transaction.since')</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($bank_deposit_transactions as $transaction)
                                                    <tr id="transaction-row-{{ $transaction->id }}">

                                                        <td class="text-center">{{ $loop->iteration }}</td>
                                                        <td class="text-center">
                                                            <a href={{ route('buyers.show', $transaction->user->id) }}> {{ isNullable($transaction->user->full_name) }}</a>
                                                        </td>
                                                        <td class="text-center">
                                                            <a href="{{ $transaction->image_path }}" data-popup="lightbox">
                                                                <img src="{{ $transaction->image_path }}" alt="" width="200" height="100" class="img-thumbnail"></a>
                                                        </td>
                                                        <td class="text-center">{{isset($transaction->created_at) ?$transaction->created_at->format('y/m/d'):'---' }}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>

                                        @else
                                            <center><h2> @lang('messages.no_data_found') </h2></center>
                                        @endif
                                    </div>
                                </div>
                                <div class="tab-pane" id="cash_transactions">
                                    <div class="panel-body">
                                        @if($cash_transactions->count() > 0)
                                            <table class="table datatable-basic" id="transactions" style="font-size: 16px;">
                                                <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th class="text-center">{{ trans('messages.user_name') }}</th>
                                                    <th class="text-center">{{ trans('messages.transaction.amount') }}</th>
                                                    <th class="text-center">@lang('messages.transaction.since')</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($cash_transactions as $transaction)
                                                    <tr id="transaction-row-{{ $transaction->id }}">

                                                        <td class="text-center">{{ $loop->iteration }}</td>
                                                        <td class="text-center">
                                                            <a href={{ route('buyers.show', $transaction->user->id) }}> {{ isNullable($transaction->user->full_name) }}</a>
                                                        </td>                                                        <td class="text-center"><a href=""> {{ isNullable($transaction->amount) }}</a></td>
                                                        <td class="text-center">{{isset($transaction->created_at) ?$transaction->created_at->format('y/m/d'):'---' }}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>

                                        @else
                                            <center><h2> @lang('messages.no_data_found') </h2></center>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /basic pills -->

    </div>
    <!-- /basic datatable -->
@stop

@section('scripts')
{{--    @include('Dashboard.layouts.parts.ajax_delete', ['model' => 'transaction'])--}}
@stop

