@extends('Dashboard.layouts.master')
@section('title', trans('messages.buyer.buyers'))
@section('breadcrumb')
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="{{route('admin.home')}}"><i class="icon-home2 position-left"></i> @lang('messages.home')</a>
            </li>
            <li><a href="{{ route('buyers.index') }}"><i
                        class="icon-admin position-left"></i> @lang('messages.buyer.buyers')</a></li>
            <li class="active">@lang('messages.buyer.show')</li>
        </ul>
        @include('Dashboard.layouts.parts.quick-links')
    </div>
@stop

@section('content')

    <!-- Toolbar -->
    <div class="navbar navbar-default navbar-xs content-group">
        @include('Dashboard.layouts.parts.validation_errors')
        <ul class="nav navbar-nav visible-xs-block">
            <li class="full-width text-center"><a data-toggle="collapse" data-target="#navbar-filter"><i class="icon-menu7"></i></a></li>
        </ul>

        <div class="navbar-collapse collapse" id="navbar-filter">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#buyer_data" data-toggle="tab"><i
                            class="icon-menu7 position-left"></i> {{ trans('messages.buyer.buyer_data') }}</a></li>
                <li><a href="#buyer_auctions" data-toggle="tab"><i
                            class="icon-calendar3 position-left"></i> {{ trans('messages.buyer.buyer_auctions') }}
                        <span class="badge badge-success badge-inline position-right">{{$buyer_auctions->count()}}</span></a>
                </li>
                <li><a href="#transactions" data-toggle="tab"><i class="icon-cog3 position-left"></i> {{trans('messages.transaction.transactions')}}</a></li>
                <li><a href="#send_notification" data-toggle="tab"><i class="icon-bell3 position-left"></i> {{trans('messages.notification.send')}}</a></li>
                <li><a href="#settings" data-toggle="tab"><i class="icon-cog3 position-left"></i> Settings</a></li>
            </ul>
        </div>
    </div>
    <!-- /toolbar -->
    <!-- Content area -->
    <div class="content" dir="{{ direction() }}">

        <!-- User profile -->
        <div class="row">
            <div class="col-lg-9">
                <div class="tabbable">
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="buyer_data">
                            <!-- buyer_data -->
                            <div class="timeline timeline-left content-group">
                                <div class="timeline-container">
                                    <!-- Sales stats -->
                                    <div class="timeline-row">
                                        <div class="panel panel-flat timeline-content">
                                            <div class="panel-heading">
                                                <div class="card">
                                                    {{--                                                    <div class="card-header header-elements-inline">--}}
                                                    {{--                                                        <h5 class="card-title">{{ trans('messages.buyer.buyer_data') }}</h5>--}}
                                                    {{--                                                    </div>--}}
                                                    <div class="card-body">

                                                        <form action="#">
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class="form-group row">
                                                                        <label class="col-form-label col-lg-3">{{ trans('messages.personal_image') }}:</label>
                                                                        <div class="col-lg-9">
                                                                            <img src="{{ $buyer->image_path }}" alt="" class=" img-thumbnail">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div><hr>
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class="form-group row"><br>
                                                                        <label class=" col-lg-3 ">{{ trans('messages.wallet') }}:</label>
                                                                        <div class="col-lg-9">
                                                                            <input type="text" class="form-control" value="{{ $buyer->wallet}} /ريال-سعودي/" readonly>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div><hr>

                                                            <div class="form-group row">
                                                                <label class="col-form-label col-lg-3">{{ trans('messages.type') }}:</label>
                                                                <div class="col-lg-9">
                                                                    <input type="text" class="form-control" value="{{ $buyer->is_company=='company'?trans('messages.company'):trans('messages.person')}}" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-form-label col-lg-3">{{ trans('messages.buyer.full_name') }}:</label>
                                                                <div class="col-lg-9">
                                                                    <input type="text" class="form-control" value="{{ $buyer->full_name }}" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-form-label col-lg-3">{{ trans('messages.user_name') }}:</label>
                                                                <div class="col-lg-9">
                                                                    <input type="text" class="form-control" value="{{ $buyer->user_name }}" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-form-label col-lg-3">{{ trans('messages.email') }}:</label>
                                                                <div class="col-lg-9">
                                                                    <input type="text" class="form-control" value="{{ $buyer->email }}" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-form-label col-lg-3">{{ trans('messages.mobile') }}:</label>
                                                                <div class="col-lg-9">
                                                                    <input type="text" class="form-control" value="{{ $buyer->mobile }}" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-form-label col-lg-3">{{ trans('messages.nationality.nationality') }}:</label>
                                                                <div class="col-lg-9">
                                                                    <input type="text" class="form-control" value="{{ $buyer->nationality->$name }}" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-form-label col-lg-3">{{ trans('messages.city.city') }}:</label>
                                                                <div class="col-lg-9">
                                                                    <input type="text" class="form-control" value="{{ $buyer->city->$name }}" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-form-label col-lg-3">{{ trans('messages.since') }}:</label>
                                                                <div class="col-lg-9">
                                                                    <input type="text" class="form-control"
                                                                           value="{{ $buyer->created_at->diffForHumans() }}" readonly>
                                                                </div>
                                                            </div>



                                                            @if($buyer->is_company=='company')

                                                                <div class="form-group row">
                                                                    <label class="col-form-label col-lg-3">{{ trans('messages.commercial_register_image') }}:</label>
                                                                    <div class="col-lg-9">
                                                                        <img src="{{ $buyer->commercial_register_image_path }}" alt="">
                                                                    </div>
                                                                </div>
{{--                                                                <div class="form-group row"><br>--}}
{{--                                                                    <label class="col-form-label col-lg-3">{{ trans('messages.buyer.location') }}:</label>--}}

{{--                                                                    <div class="col-lg-9">--}}
{{--                                                                        <input id="searchInput" class=" form-control"   style="background-color: #FFF;margin-left: -180px;" placeholder=" اختر المكان علي الخريطة " name="other" >--}}
{{--                                                                        <div id="map"></div>--}}
{{--                                                                    </div>--}}
{{--                                                                    <div class="col-lg-6">--}}
{{--                                                                        <input type="text" id="geo_lat"  value="{{ $buyer->latitude }}"  name="latitude" readonly="" placeholder=" latitude " class="form-control" >--}}
{{--                                                                    </div>--}}
{{--                                                                    <div class="col-lg-6">--}}
{{--                                                                        <input type="text" id="geo_lng"  value="{{ $buyer->longitude }}"  name="longitude" readonly="" placeholder="longitude" class="form-control" >--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}
                                                            @endif
                                                        </form>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /sales stats -->
                                </div>
                            </div>
                            <!-- /buyer_data -->
                        </div>
                        <div class="tab-pane fade" id="buyer_auctions">
                            <!-- Seller_auctions -->
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
                                    <!-- Palette colors -->
                                    <h6 class="content-group-sm text-semibold">
                                        {{__('messages.buyer.full_name')}}
                                        <small class="display-block">{{$buyer->full_name}}</small>
                                    </h6>

                                    <div class="row">
                                        @foreach($buyer_auctions as $buyer_auction)
                                            <div class="col-sm-4 col-lg-2">
                                                <div class="panel">
                                                    <div class="bg-info-800 demo-color">
                                                        <span>{{$buyer_auction->auction->$name}}</span></div>

                                                    <div class="p-15">
                                                        <div class="media-body">
                                                            <strong>{{$buyer_auction->auction->start_auction_price}}
                                                                ريال</strong>
                                                            <div
                                                                class="text-muted mt-5">{{$buyer_auction->auction->value_of_increment}}
                                                                ريال
                                                            </div>
                                                        </div>
                                                        <div class="media-right">
                                                            <ul class="icons-list">
                                                                <li>
                                                                    <a href="#" data-toggle="modal" data-target="#info_800">
                                                                        <i class="icon-three-bars"></i>
                                                                        {{__('messages.buyer.auction_details')}}</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div>
                                                    <span class="badge  badge-pill" style="background-color: #00838F;">
                                                        <a href={{ route('auctions.show', $buyer_auction->auction->id) }}>{{__('messages.auction.show_auction_bids')}}</a>
                                                    </span>
                                                </div>
                                            </div>



                                            <!-- auction modal -->
                                            <div id="info_800" class="modal fade">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">
                                                                &times;
                                                            </button>
                                                            <h5 class="modal-title">{{__('messages.description')}}:</h5>
                                                        </div>

                                                        <div class="modal-body">
                                                            {{$buyer_auction->auction->$description}}                                                        </div>

                                                        <div class="table-responsive content-group">
                                                            <table class="table">
                                                                <tr>
                                                                    <td>{{__('messages.auction.name')}}:</td>
                                                                    <td><code>{{$buyer_auction->auction->$name}}</code></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>{{__('messages.auction.start_auction_price')}}
                                                                        :
                                                                    </td>
                                                                    <td>
                                                                        <code>{{$buyer_auction->auction->start_auction_price}}</code>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>{{__('messages.auction.value_of_increment')}}:
                                                                    </td>
                                                                    <td>
                                                                        <code>.{{$buyer_auction->auction->value_of_increment}}</code>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>


                                                        <div class="modal-footer">
                                                            <div>
                                                                <span class="badge  badge-pill" style="background-color: #00838F;">
                                                                    <a href={{ route('auctions.show', $buyer_auction->auction->id) }}>{{__('messages.auction.show_auction_bids')}}</a>
                                                                </span>
                                                            </div>
                                                            <button type="button"
                                                                    class="btn btn-link btn-xs text-uppercase text-semibold"
                                                                    data-dismiss="modal">Close
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /auction modal -->
                                        @endforeach
                                    </div>
                                    <!-- /palette colors -->
                                </div>
                            </div>
                            <!-- /Seller_auctions -->
                        </div>
                        <div class="tab-pane fade" id="send_notification">
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
                                    <h6 class="content-group-sm text-semibold">{{__('messages.notification.send')}}</h6>
                                    <div class="row">
                                        <form action="{{ route('send_single_notify') }}" class="form-horizontal"
                                              method="post" enctype="multipart/form-data" style="border:1px solid grey;padding:20px 30px">
                                            @csrf
                                            <input type="hidden" name="user_id" value="{{ $buyer->id }}"/>
                                            <label> {{ trans('messages.notification.title') }} </label>
                                            <input type="text" class="form-control" name="title"/><br>
                                            <label> {{ trans('messages.notification.text') }} </label>
                                            <textarea class="form-control" name="text"></textarea><br>
                                            <center>
                                                <button type="submit"
                                                        class="btn btn-primary"> {{ trans('messages.notification.send') }}
                                                    <i class="icon-arrow-left13 position-right"></i></button>
                                            </center>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="transactions">


                            <!-- transactions -->
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
                                    <!-- Palette colors -->
                                    <div class="row">
                                        <div class="list-icons" style="padding: 10px;">
                                            <a href="#" data-toggle="modal" data-target="#add_balance"
                                               class="btn btn-success btn-labeled btn-labeled-left"><b><i
                                                        class="icon-plus2"></i></b>{{ trans('messages.buyer.add_balance') }}
                                            </a>
{{--                                            <a href="{{route('transactions.create')}}" class="btn btn-success btn-labeled btn-labeled-left"><b><i--}}
{{--                                                        class="icon-plus2"></i></b>{{ trans('messages.transaction.add') }}</a>--}}
                                        </div>
                                        @if($buyer->payments->count() > 0)
                                            <table class="table datatable-basic" id="transactions" style="font-size: 16px;">
                                                <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th class="text-center">{{ trans('messages.transaction.payment_type') }}</th>
                                                    <th class="text-center">{{ trans('messages.transaction.amount') }}</th>
                                                    <th class="text-center">@lang('messages.transaction.since')</th>
                                                    <th class="text-center">@lang('messages.form-actions')</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($buyer->payments as $transaction)
                                                    <tr id="transaction-row-{{ $transaction->id }}">

                                                        <td class="text-center">{{ $loop->iteration }}</td>
                                                        <td class="text-center"><a href=""> {{ isNullable($transaction->payment_type) }}</a></td>
                                                        <td class="text-center"><a href=""> {{ isNullable($transaction->amount) }}</a></td>
                                                        <td class="text-center">{{isset($transaction->created_at) ?$transaction->created_at->format('y/m/d'):'---' }}</td>
                                                        <td class="text-center">
                                                            <div class="list-icons text-center">
                                                                <div class="list-icons-item dropdown text-center">
                                                                    <a href="#" class="list-icons-item caret-0 dropdown-toggle" data-toggle="dropdown">
                                                                        <i class="icon-menu9"></i>
                                                                    </a>
                                                                    <ul class="dropdown-menu dropdown-menu-{{ floating('right', 'left') }}">
{{--                                                                        <li>--}}
{{--                                                                            <a href="{{ route('transactions.edit',$transaction->id) }}"> <i--}}
{{--                                                                                    class="icon-database-edit2"></i>@lang('messages.edit') </a>--}}
{{--                                                                        </li>--}}
                                                                        <li>
                                                                            <a data-id="{{ $transaction->id }}" class="delete-action"
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
                                            <center><h2> @lang('messages.no_data_found') </h2></center>
                                        @endif
                                    </div>
                                    <!-- /palette colors -->
                                </div>
                            </div>
                            <!-- /transactions -->

                        </div>
                        <div class="tab-pane fade" id="settings">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('Dashboard.Buyers.add_balance_modal')

    </div>

@stop

@section('scripts')
        @include('Dashboard.layouts.parts.ajax_delete', ['model' => 'transaction'])
@stop
