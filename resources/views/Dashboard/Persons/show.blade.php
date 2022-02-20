@extends('Dashboard.layouts.master')
@section('title', trans('messages.person.persons'))

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
            <li class="full-width text-center"><a data-toggle="collapse" data-target="#navbar-filter"><i class="icon-menu7"></i></a></li>
        </ul>

        <div class="navbar-collapse collapse" id="navbar-filter">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#person_data" data-toggle="tab"><i
                            class="icon-menu7 position-left"></i> {{ trans('messages.person.person_data') }}</a></li>
{{--                <li><a href="#person_auctions" data-toggle="tab"><i--}}
{{--                            class="icon-calendar3 position-left"></i> {{ trans('messages.person.person_auctions') }}--}}
{{--                        <span class="badge badge-success badge-inline position-right">11--}}
{{--                            {{$person->person_auctions->count()}}--}}
{{--                        </span></a>--}}
{{--                </li>--}}
                <li><a href="#send_notification" data-toggle="tab"><i
                            class="icon-bell3 position-left"></i> {{trans('messages.notification.send')}}</a></li>
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
                                                                        <label class="col-form-label col-lg-3">{{ trans('messages.personal_image') }}:</label>
                                                                        <div class="col-lg-9">
                                                                            <img src="{{ $person->image_path }}" alt="" class=" img-thumbnail">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="form-group row">

                                                                        <label class="col-form-label col-lg-3"><span class="badge badge-info" >{{ trans('messages.wallet') }} : </span></label>

                                                                        <div class="col-lg-9">
                                                                            <input type="text" class="form-control" value="{{ $person->wallet}} /ريال-سعودي/" readonly>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                            <div class="form-group row">
                                                                <label class="col-form-label col-lg-3">{{ trans('messages.type') }}:</label>
                                                                <div class="col-lg-9">
                                                                    <input type="text" class="form-control" value="{{ $person->is_company=='company'?trans('messages.company.company'):trans('messages.person.person')}}" readonly>

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
                                                                    class="col-form-label col-lg-3">{{ trans('messages.user_name') }}
                                                                    :</label>
                                                                <div class="col-lg-9">
                                                                    <input type="text" class="form-control"
                                                                           value="{{ $person->user_name }}" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-form-label col-lg-3">{{ trans('messages.email') }}:</label>
                                                                <div class="col-lg-9">
                                                                    <input type="text" class="form-control" value="{{ $person->email }}" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-form-label col-lg-3">{{ trans('messages.mobile') }}:</label>
                                                                <div class="col-lg-9">
                                                                    <input type="text" class="form-control" value="{{ $person->mobile }}" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-form-label col-lg-3">{{ trans('messages.nationality.nationality') }}:</label>
                                                                <div class="col-lg-9">
                                                                    <input type="text" class="form-control" value="{{ isset($person->nationality)?$person->nationality->$name:'' }}" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-form-label col-lg-3">{{ trans('messages.city.city') }}:</label>
                                                                <div class="col-lg-9">
                                                                    <input type="text" class="form-control" value="{{ isset($person->city)?$person->city->$name :''}}" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-form-label col-lg-3">{{ trans('messages.since') }}:</label>
                                                                <div class="col-lg-9">
                                                                    <input type="text" class="form-control"
                                                                           value="{{ $person->created_at->diffForHumans() }}" readonly>
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
{{--                        <div class="tab-pane fade" id="person_auctions">--}}
{{--                            <!-- Seller_auctions -->--}}
{{--                            <div class="panel panel-flat">--}}
{{--                                <div class="panel-heading">--}}
{{--                                    <div class="heading-elements">--}}
{{--                                        <ul class="icons-list">--}}
{{--                                            <li><a data-action="collapse"></a></li>--}}
{{--                                            <li><a data-action="reload"></a></li>--}}
{{--                                            <li><a data-action="close"></a></li>--}}
{{--                                        </ul>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="panel-body">--}}
{{--                                    <!-- Palette colors -->--}}
{{--                                    <h6 class="content-group-sm text-semibold">--}}
{{--                                        {{__('messages.person.full_name')}}--}}
{{--                                        <small class="display-block">{{$person->full_name}}</small>--}}
{{--                                    </h6>--}}

{{--                                    <div class="row">--}}
{{--                                        @foreach($person_auctions as $person_auction)--}}
{{--                                            <div class="col-sm-4 col-lg-2">--}}
{{--                                                <div class="panel">--}}
{{--                                                    <div class="bg-info-800 demo-color">--}}
{{--                                                        <span>{{$person_auction->$name}}</span></div>--}}

{{--                                                    <div class="p-15">--}}
{{--                                                        <div class="media-body">--}}
{{--                                                            <strong>{{$person_auction->start_auction_price}}--}}
{{--                                                                ريال</strong>--}}
{{--                                                            <div--}}
{{--                                                                class="text-muted mt-5">{{$person_auction->value_of_increment}}--}}
{{--                                                                ريال--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}

{{--                                                        <div class="media-right">--}}
{{--                                                            <ul class="icons-list">--}}
{{--                                                                <li><a href="#" data-toggle="modal" data-target="#info_800">--}}
{{--                                                                        <i class="icon-three-bars"></i></a></li>--}}
{{--                                                            </ul>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div>--}}
{{--                                                    <span class="badge  badge-pill" style="background-color: #00838F;">--}}
{{--                                                        <a href={{ route('auctions.show', $person_auction->id) }}>{{__('messages.person.show_auction_bids')}}</a>--}}
{{--                                                    </span>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <!-- auction modal -->--}}
{{--                                            <div id="info_800" class="modal fade">--}}
{{--                                                <div class="modal-dialog">--}}
{{--                                                    <div class="modal-content">--}}
{{--                                                        <div class="modal-header">--}}
{{--                                                            <button type="button" class="close" data-dismiss="modal">--}}
{{--                                                                &times;--}}
{{--                                                            </button>--}}
{{--                                                            <h5 class="modal-title">{{__('messages.description')}}:</h5>--}}
{{--                                                        </div>--}}

{{--                                                        <div class="modal-body">--}}
{{--                                                            {{$person_auction->$description}}                                                        </div>--}}

{{--                                                        <div class="table-responsive content-group">--}}
{{--                                                            <table class="table">--}}
{{--                                                                <tr>--}}
{{--                                                                    <td>{{__('messages.auction.name')}}:</td>--}}
{{--                                                                    <td><code>{{$person_auction->$name}}</code></td>--}}
{{--                                                                </tr>--}}
{{--                                                                <tr>--}}
{{--                                                                    <td>{{__('messages.auction.start_auction_price')}}--}}
{{--                                                                        :--}}
{{--                                                                    </td>--}}
{{--                                                                    <td>--}}
{{--                                                                        <code>{{$person_auction->start_auction_price}}</code>--}}
{{--                                                                    </td>--}}
{{--                                                                </tr>--}}
{{--                                                                <tr>--}}
{{--                                                                    <td>{{__('messages.auction.value_of_increment')}}:--}}
{{--                                                                    </td>--}}
{{--                                                                    <td>--}}
{{--                                                                        <code>.{{$person_auction->value_of_increment}}</code>--}}
{{--                                                                    </td>--}}
{{--                                                                </tr>--}}
{{--                                                            </table>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="modal-footer">--}}
{{--                                                            <div>--}}
{{--                                                                <span class="badge  badge-pill"--}}
{{--                                                                      style="background-color: #00838F;">--}}
{{--                                                                    <a href={{ route('auctions.show', $person_auction->id) }}>{{__('messages.person.show_auction_bids')}}</a>--}}
{{--                                                                </span>--}}
{{--                                                            </div>--}}
{{--                                                            <button type="button"--}}
{{--                                                                    class="btn btn-link btn-xs text-uppercase text-semibold"--}}
{{--                                                                    data-dismiss="modal">Close--}}
{{--                                                            </button>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <!-- /auction modal -->--}}
{{--                                        @endforeach--}}
{{--                                    </div>--}}
{{--                                    <!-- /palette colors -->--}}

{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <!-- /Seller_auctions -->--}}

{{--                        </div>--}}
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
                                            <input type="hidden" name="user_id" value="{{ $person->id }}"/>
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
                        <div class="tab-pane fade" id="settings">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop

@section('scripts')
@stop
