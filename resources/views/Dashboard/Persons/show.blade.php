@extends('Dashboard.layouts.master')
@section('title', trans('messages.person.persons'))
@section('style')
    <style> #map {height: 400px;}

        @media print {
            head, breadcrumb,nav, ul, .test_print {
                display: none;
            }
        }
    </style>
@endsection
@section('breadcrumb')
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="{{route('admin.home')}}"><i
                        class="icon-home2 position-left"></i> @lang('messages.home')</a>
            </li>
            <li><a href="{{ route('persons.index') }}"><i
                        class="icon-admin position-left"></i> @lang('messages.person.persons')</a></li>
            <li class="active">@lang('messages.show')</li>
        </ul>
        @include('Dashboard.layouts.parts.quick-links')
    </div>
@stop
@section('content')

    <!-- Toolbar -->
    <div class="navbar navbar-default navbar-xs content-group">
        @include('Dashboard.layouts.parts.validation_errors')

        <ul class="nav navbar-nav visible-xs-block">
            <li class="full-width text-center"><a data-toggle="collapse" data-target="#navbar-filter"><i
                        class="icon-menu7"></i></a></li>
        </ul>

        <div class="navbar-collapse collapse" id="navbar-filter">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#person_data" data-toggle="tab"><i
                            class="icon-menu7 position-left"></i> {{ trans('messages.person.person_data') }}</a></li>
                <li class=""><a href="#other_data" data-toggle="tab"><i
                            class="icon-menu7 position-left"></i> {{ trans('messages.person.data_need_accept') }}</a>
                </li>
                <li><a href="#main_address" data-toggle="tab"><i
                            class="icon-cog3 position-left"></i> {{trans('messages.person.main_address_on_map')}}</a>
                </li>
                <li><a href="#additional_address" data-toggle="tab"><i
                            class="icon-cog3 position-left"></i> {{trans('messages.person.additional_address')}}</a>
                </li>

                <li><a href="#person_account_statement" data-toggle="tab"><i
                            class="icon-calendar3 position-left"></i> {{ trans('messages.account_statement') }}
                        <span class="badge badge-success badge-inline position-right">
                            {{$person_bids->count()}}
                        </span></a>
                </li>
                <li><a href="#send_notification" data-toggle="tab"><i
                            class="icon-bell3 position-left"></i> {{trans('messages.notification.send')}}</a></li>
                <li><a href="#wallet" data-toggle="tab"><i
                            class="icon-cog3 position-left"></i> {{trans('messages.wallet')}}</a></li>
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
                        <div class="tab-pane fade in active" id="person_data">
                            <!-- person_data -->
                            <div class="timeline timeline-left content-group">
                                <div class="timeline-container">
                                    <!-- Sales stats -->
                                    <div class="timeline-row">
                                        <div class="panel panel-flat timeline-content">
                                            <div class="panel-heading">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <form action="#">

                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="form-group row">
                                                                        <label
                                                                            class="col-form-label col-lg-3">{{ trans('messages.personal_image') }}
                                                                            :</label>
                                                                        <div class="col-lg-9">
                                                                            <img src="{{ $person->image_path }}" alt=""
                                                                                 class=" img-thumbnail">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="form-group row">

                                                                        <label class="col-form-label col-lg-3"><span
                                                                                class="badge badge-info">{{ trans('messages.wallet') }} : </span></label>

                                                                        <div class="col-lg-9">
                                                                            <input type="text" class="form-control"
                                                                                   value="{{ $person->wallet}} /ريال-سعودي/"
                                                                                   readonly>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                            <div class="form-group row">
                                                                <label
                                                                    class="col-form-label col-lg-3">{{ trans('messages.type') }}
                                                                    :</label>
                                                                <div class="col-lg-9">
                                                                    <input type="text" class="form-control"
                                                                           value="{{ $person->is_company=='company'?trans('messages.company.company'):trans('messages.person.person')}}"
                                                                           readonly>

                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label
                                                                    class="col-form-label col-lg-3">{{ trans('messages.person.full_name') }}
                                                                    :</label>
                                                                <div class="col-lg-9">
                                                                    <input type="text" class="form-control"
                                                                           value="{{ $person->full_name }}" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label
                                                                    class="col-form-label col-lg-3">{{ trans('messages.first_name') }}
                                                                    :</label>
                                                                <div class="col-lg-9">
                                                                    <input type="text" class="form-control"
                                                                           value="{{ $person->first_name }}" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label
                                                                    class="col-form-label col-lg-3">{{ trans('messages.middle_name') }}
                                                                    :</label>
                                                                <div class="col-lg-9">
                                                                    <input type="text" class="form-control"
                                                                           value="{{ $person->middle_name }}" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label
                                                                    class="col-form-label col-lg-3">{{ trans('messages.last_name') }}
                                                                    :</label>
                                                                <div class="col-lg-9">
                                                                    <input type="text" class="form-control"
                                                                           value="{{ $person->last_name }}" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label
                                                                    class="col-form-label col-lg-3">{{ trans('messages.user_name') }}
                                                                    :</label>
                                                                <div class="col-lg-9">
                                                                    <input type="text" class="form-control"
                                                                           value="{{ $person->user_name }}" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label
                                                                    class="col-form-label col-lg-3">{{ trans('messages.email') }}
                                                                    :</label>
                                                                <div class="col-lg-9">
                                                                    <input type="text" class="form-control"
                                                                           value="{{ $person->email }}" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label
                                                                    class="col-form-label col-lg-3">{{ trans('messages.mobile') }}
                                                                    :</label>
                                                                <div class="col-lg-9">
                                                                    <input type="text" class="form-control"
                                                                           value="{{ $person->mobile }}" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label
                                                                    class="col-form-label col-lg-3">{{ trans('messages.since') }}
                                                                    :</label>
                                                                <div class="col-lg-9">
                                                                    <input type="text" class="form-control"
                                                                           value="{{ $person->created_at->diffForHumans() }}"
                                                                           readonly>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /sales stats -->
                                </div>
                            </div>
                            <!-- /person_data -->
                        </div>
                        <div class="tab-pane fade in " id="other_data">
                            <!-- person_data -->
                            <div class="timeline timeline-left content-group">
                                <div class="timeline-container">
                                    <!-- Sales stats -->
                                    <div class="timeline-row">
                                        <div class="panel panel-flat timeline-content">
                                            <div class="panel-heading">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <form action="#">

                                                            <div class="form-group row">
                                                                <label
                                                                    class="col-form-label col-lg-3">{{ trans('messages.nationality.nationality') }}
                                                                    :</label>
                                                                <div class="col-lg-9">
                                                                    <input type="text" class="form-control"
                                                                           value="{{ isset($person->nationality)?$person->nationality->$name:'' }}"
                                                                           readonly>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label
                                                                    class="col-form-label col-lg-3">{{ trans('messages.city.city') }}
                                                                    :</label>
                                                                <div class="col-lg-9">
                                                                    <input type="text" class="form-control"
                                                                           value="{{ isset($person->city)?$person->city->$name :''}}"
                                                                           readonly>
                                                                </div>
                                                            </div>


                                                            <div class="form-group row">
                                                                <label
                                                                    class="col-form-label col-lg-3">{{trans('messages.P_O_Box')}}
                                                                    :</label>
                                                                <div class="col-lg-9">
                                                                    <input type="text" class="form-control"
                                                                           value="{{ isset($person->P_O_Box )?$person->P_O_Box :''}}"
                                                                           readonly>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label
                                                                    class="col-form-label col-lg-3">{{ trans('messages.person.block') }}
                                                                    :</label>
                                                                <div class="col-lg-9">
                                                                    <input type="text" class="form-control"
                                                                           value="{{ isset($person->block )?$person->block :''}}"
                                                                           readonly>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label
                                                                    class="col-form-label col-lg-3">{{ trans('messages.person.street') }}
                                                                    :</label>
                                                                <div class="col-lg-9">
                                                                    <input type="text" class="form-control"
                                                                           value="{{ isset($person->street )?$person->street :''}}"
                                                                           readonly>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label
                                                                    class="col-form-label col-lg-3">{{ trans('messages.person.block_num') }}
                                                                    :</label>
                                                                <div class="col-lg-9">
                                                                    <input type="text" class="form-control"
                                                                           value="{{ isset($person->block_num )?$person->block_num :''}}"
                                                                           readonly>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label
                                                                    class="col-form-label col-lg-3">{{ trans('messages.person.signs') }}
                                                                    :</label>
                                                                <div class="col-lg-9">
                                                                    <input type="text" class="form-control"
                                                                           value="{{ isset($person->signs )?$person->signs :''}}"
                                                                           readonly>
                                                                </div>
                                                            </div>


                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="form-group row">
                                                                        <label
                                                                            class="col-form-label col-lg-3">{{ trans('messages.person.identity') }}
                                                                            :</label>
                                                                        <div class="col-lg-9">
                                                                            <img
                                                                                src="{{ $person->passport_image_path }}"
                                                                                alt="" class=" img-thumbnail">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                @if($person->is_checked_account ==0)
                                                                    <a href="{{route('not_verified',$person->id)}}"
                                                                       class="btn btn-danger btn-sm"><i
                                                                            class="icon-close2"></i>{{trans('messages.not_verified')}}
                                                                    </a>
                                                                    <a href="{{route('verified',$person->id)}}"
                                                                       class="btn btn-success btn-sm"> <i
                                                                            class="icon-check2"></i> {{trans('messages.verified')}}
                                                                    </a>
                                                                @endif
                                                            </div>
                                                            <div class="form-group row">
                                                                @if($person->is_checked_account ==1)
                                                                    <div class="btn btn-success btn-sm">
                                                                        <i class="icon-check2"></i> {{trans('messages.verified')}}
                                                                    </div>
                                                                @endif
                                                            </div>

                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /sales stats -->
                                </div>
                            </div>
                            <!-- /person_data -->
                        </div>
                        <div class="tab-pane fade" id="main_address">
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
                                    <h6 class="content-group-sm text-semibold">{{ trans('messages.person.location') }}
                                        :</h6>
                                    <div class="form-group row"><br>
                                        <div class="col-lg-9">
                                            <div id="map"></div>
                                        </div>
                                        <div class="col-lg-6">
                                            <input type="text" id="geo_lat" value="{{ $person->latitude }}"
                                                   name="latitude" readonly="" placeholder=" latitude "
                                                   class="form-control">
                                        </div>
                                        <div class="col-lg-6">
                                            <input type="text" id="geo_lng" value="{{ $person->longitude }}"
                                                   name="longitude" readonly="" placeholder="longitude"
                                                   class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="additional_address">
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
                                    @if($person_addresses->count() > 0)

                                        @foreach($person_addresses as $person_address)
                                            <div class="row">
                                                <div class="form-group mb-4 row">
                                                    <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                                        <label for="block"
                                                               class="form-label"> {{trans('messages.block')}}:</label>
                                                    </div>
                                                    <div class="col-lg-10 col-md-9">{{ $person_address->block}}</div>
                                                </div>
                                                <div class="form-group mb-4 row">
                                                    <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                                        <label for="block"
                                                               class="form-label"> {{trans('messages.street')}}:</label>
                                                    </div>
                                                    <div class="col-lg-10 col-md-9">{{ $person_address->street}}:</div>
                                                </div>
                                                <div class="form-group mb-4 row">
                                                    <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                                        <label for="block"
                                                               class="form-label"> {{trans('messages.block_num')}}
                                                            :</label>
                                                    </div>
                                                    <div
                                                        class="col-lg-10 col-md-9">{{ $person_address->block_num}}</div>

                                                </div>
                                                <div class="form-group mb-4 row">
                                                    <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                                        <label for="block"
                                                               class="form-label"> {{trans('messages.signs')}}:</label>
                                                    </div>
                                                    <div class="col-lg-10 col-md-9">{{ $person_address->signs}}</div>
                                                </div>
                                            </div>
                                            <hr>
                                        @endforeach

                                    @else
                                        <div style="text-align: center;">
                                            <h2> @lang('messages.no_additional_address_found') </h2></div>
                                    @endif
                                </div>
                            </div>

                        </div>

                        <div class="tab-pane fade" id="person_account_statement">
                            <div class="panel panel-flat">
                                <div class="panel-body">
                                    <div class="tabbable">
                                        <ul class="nav nav-pills nav-pills-bordered nav-justified test_print">
                                            <li class="active"><a href="#user_bids" data-toggle="tab">{{ trans('messages.bids') }}</a></li>
                                            <li><a href="#transactions" data-toggle="tab">{{ trans('messages.payment') }}</a></li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="user_bids">
                                                <div class="panel-body">
                                                    <!-- person_bids -->
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
                                                            @if($person_bids->count() > 0)

                                                                <a href="" id="printme" target="_blank" class="btn btn-info printme"><i
                                                                        class="fa fa-print"></i> Print</a>

                                                                <table class="table table-striped table-dark "
                                                                       id="auction_bids"
                                                                       style="font-size: 16px;">
                                                                    <thead class="table-dark">
                                                                    <tr>
                                                                        <th class="text-center">
                                                                            <h3>{{ trans('messages.auction.name') }}
                                                                                : </h3></th>
                                                                        <th class="text-center">
                                                                            <h3>{{ trans('messages.auction.buyer_offer') }}
                                                                                : </h3></th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    @foreach($person_bids as $bid)
                                                                        <tr id="auction_bids-row-{{ $bid->id }}">
                                                                            <td class="text-center">
                                                                                {{$bid->auction->$name}}
                                                                            </td>
                                                                            <td class="text-center">
                                                                                {{$bid->buyer_offer}} / ريال- سعودي
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                    </tbody>
                                                                </table>
                                                            @else
                                                                <div style="text-align: center;">
                                                                    <h3> @lang('messages.no_data_found') </h3></div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <!-- /person_bids -->
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="transactions">
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

                                                        <a href="" id="print_transactions" target="_blank" class="btn btn-info print_transactions"><i
                                                                class="fa fa-print"></i> Print</a>

                                                        <table class="table table-striped "
                                                               id="transactions" style="font-size: 16px;">
                                                            <thead>
                                                            <tr>
                                                                <th class="text-center">#</th>
                                                                <th class="text-center">{{ trans('messages.transaction.payment_type') }}</th>
                                                                <th class="text-center">{{ trans('messages.transaction.amount') }}</th>
                                                                <th class="text-center">@lang('messages.transaction.date')</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach($person->payments as $transaction)
                                                                <tr id="transaction-row-{{ $transaction->id }}">
                                                                    <td class="text-center">{{ $loop->iteration }}</td>
                                                                    <td class="text-center">
                                                                        {{ isNullable($transaction->payment_type) }}</a>
                                                                    </td>
                                                                    <td class="text-center"><a
                                                                            href=""> {{ isNullable($transaction->amount) }}</a>
                                                                    </td>
                                                                    <td class="text-center">{{isset($transaction->created_at) ?$transaction->created_at->format('y/m/d'):'---' }}</td>
                                                                </tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <br><h5>{{trans('total_wallet')}} :: {{$person ->wallet}}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                                              method="post" enctype="multipart/form-data"
                                              style="border:1px solid grey;padding:20px 30px">
                                            @csrf
                                            <input type="hidden" name="user_id" value="{{ $person->id }}"/>
                                            <br>
                                            <div class="form-group">
                                                <label
                                                    class="col-lg-3 control-label display-block"> {{ trans('messages.message.text') }}
                                                    : </label>
                                                <div class="col-lg-6">
                                                    <select name="text" class="select">
                                                        <optgroup label="{{ trans('messages.message.text')}}">
                                                            <option selected
                                                                    disabled>{{trans('messages.select')}}</option>
                                                            @foreach($messages as $message)
                                                                <option
                                                                    value="{{ $message->text }}"> {{ $message->text }} </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <br>

                                            <div style="text-align: center;">
                                                <button type="submit"
                                                        class="btn btn-primary"> {{ trans('messages.notification.send') }}
                                                    <i class="icon-arrow-left13 position-right"></i></button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="wallet">
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

                                    <div class="form-group row">
                                        <label class="col-form-label col-lg-3">{{ trans('messages.wallet') }}:</label>
                                        <div class="col-lg-9">
                                            <input type="text" class="form-control"
                                                   value="{{ $person->wallet }} ريال-سعودي" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row"><br>
                                        <a href="#" data-toggle="modal" data-target="#add_wallet"
                                           class="btn btn-success btn-labeled btn-labeled-left"><b><i
                                                    class="icon-plus2"></i></b>{{ trans('messages.person.add_wallet') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('Dashboard.Persons.add_to_wallet_modal')
    </div>

@stop

@section('scripts')
    <script>
        function initMap() {
            let lat_val = {{ $person->latitude }};
            let lng_val = {{ $person->longitude }};
            var map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: lat_val, lng: lng_val},
                zoom: 13
            });
            var marker = new google.maps.Marker({position: {lat: lat_val, lng: lng_val}, map: map, draggable: true});
        }
    </script>
    <script
        src="https://maps.googleapis.com/maps/api/js?libraries=places&callback=initMap&key=AIzaSyBzIZuaInB0vFf3dl0_Ya7r96rywFeZLks">
    </script>

    <script>
        $(".print_transactions").click(function (e) {
            e.preventDefault();

            window.print();
        });

        $(".printme").click(function (e) {
            e.preventDefault();

            window.print();
        });
    </script>
@stop
