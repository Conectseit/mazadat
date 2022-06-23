@extends('Dashboard.layouts.master')
@section('title', trans('messages.financial_reviews'))
@section('breadcrumb')
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="{{route('admin.home')}}"><i class="icon-home2 position-left"></i> @lang('messages.home')
                </a>
            </li>
            <li class="active">@lang('messages.financial_reviews')</li>
        </ul>
        @include('Dashboard.layouts.parts.quick-links')
    </div>
@stop
@section('content')
    @include('Dashboard.layouts.parts.validation_errors')
    <!-- Basic datatable -->
    <div class="panel panel-flat" dir="{{ direction() }}" style="margin: 20px;">

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
                                <li class="active"><a href="#bank_deposit_transactions"
                                                      data-toggle="tab">{{ trans('messages.transaction.bank_deposit') }}</a>
                                </li>
                                <li><a href="#cash_transactions"
                                       data-toggle="tab">{{ trans('messages.transaction.cash') }}</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="bank_deposit_transactions">
                                    <div class="panel-body">
                                        @if($bank_deposit_transactions->count() > 0)
                                            <table class="table datatable-button-print-basic" id="transactions"
                                                   style="font-size: 16px;">
                                                <thead>
                                                <tr>
                                                    <th class="text-center">{{ trans('messages.user_name') }}</th>
                                                    <th class="text-center">{{ trans('messages.transaction.receipt_image') }}</th>
                                                    <th class="text-center">{{ trans('messages.transaction.amount') }}</th>
                                                    <th class="text-center">{{ trans('messages.transaction.date') }}</th>
                                                    <th class="text-center">@lang('messages.transaction.since')</th>
                                                    <th class="text-center">{{ trans('messages.accept') }}</th>
                                                    <th class="text-center">{{ trans('messages.not_accept') }}</th>
                                                    <th class="text-center">@lang('messages.form-actions')</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($bank_deposit_transactions as $transaction)
                                                    <tr id="transaction-row-{{ $transaction->id }}">
                                                        <td class="text-center">
                                                            <a href=""> {{ isNullable($transaction->user->user_name) }}</a>
                                                        </td>
                                                        <td class="text-center">
                                                            <a href="{{ $transaction->image_path }}"
                                                               data-popup="lightbox">
                                                                <img src="{{ $transaction->image_path }}" alt=""
                                                                     width="200" height="100" class="img-thumbnail"></a>
                                                        </td>
                                                        <td class="text-center">{{$transaction->amount}}</td>
                                                        <td class="text-center">{{$transaction->date}}</td>
                                                        <td class="text-center">{{isset($transaction->created_at) ?$transaction->created_at->format('y/m/d'):'---' }}</td>
                                                        <td class="text-center">
                                                            @if($transaction->is_verified ==0)
                                                                <a href="transaction/{{$transaction->id}}/verify/"
                                                                   class="btn btn-success btn-sm"> <i
                                                                        class="icon-check2"></i> {{trans('messages.verify')}}
                                                                </a>
                                                            @endif
                                                        </td>
                                                        <td class="text-center">
                                                            @if($transaction->is_verified ==0)
                                                                <a href="transaction/{{$transaction->id}}/not_verify/"
                                                                   class="btn btn-danger btn-sm">
                                                                    <i class="icon-check2"></i> {{trans('messages.not_verify')}}
                                                                </a>
                                                            @endif
                                                        </td>
                                                        <td class="text-center">
                                                            <div class="list-icons text-center">
                                                                <div class="list-icons-item dropdown text-center">
                                                                    <a href="#"
                                                                       class="list-icons-item caret-0 dropdown-toggle"
                                                                       data-toggle="dropdown">
                                                                        <i class="icon-menu9"></i>
                                                                    </a>
                                                                    <ul class="dropdown-menu dropdown-menu-{{ floating('right', 'left') }}">
                                                                        <li>
                                                                            <a data-id="{{ $transaction->id }}"
                                                                               class="delete-action"
                                                                               href="{{ Url('/transaction/transaction/'.$transaction->id) }}">
                                                                                <i class="icon-database-remove"></i>@lang('messages.delete')
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </td>

                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>

                                        @else
                                            <div style="text-align: center;"><h2> @lang('messages.no_data_found') </h2>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="tab-pane" id="cash_transactions">
                                    <div class="panel-body">
                                        @if($cash_transactions->count() > 0)
                                            <table class="table datatable-button-print-basic" id="transactions"
                                                   style="font-size: 16px;">
                                                <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th class="text-center">{{ trans('messages.user_name') }}</th>
                                                    <th class="text-center">{{ trans('messages.transaction.amount') }}</th>
                                                    <th class="text-center">{{ trans('messages.accept') }}</th>
                                                    <th class="text-center">@lang('messages.transaction.date')</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($cash_transactions as $transaction)
                                                    <tr id="transaction-row-{{ $transaction->id }}">

                                                        <td class="text-center">{{ $loop->iteration }}</td>
                                                        <td class="text-center">
                                                            <a href=""> {{ isNullable($transaction->user->user_name) }}</a>
                                                        </td>
                                                        <td class="text-center"><a
                                                                href=""> {{ isNullable($transaction->amount) }}</a></td>
                                                        <td class="text-center">
                                                            @if($transaction->is_verified ==0)
                                                                <a href="transaction/{{$transaction->id}}/verify_cash/"
                                                                   class="btn btn-success btn-sm"> <i
                                                                        class="icon-check2"></i> {{trans('messages.verify')}}
                                                                </a>
                                                            @endif
                                                        </td>
                                                        <td class="text-center">{{isset($transaction->created_at) ?$transaction->created_at->format('y/m/d'):'---' }}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>

                                        @else
                                            <div style="text-align: center;"><h2> @lang('messages.no_data_found') </h2>
                                            </div>
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
    @include('Dashboard.layouts.parts.ajax_delete', ['model' => 'transaction'])
@stop


