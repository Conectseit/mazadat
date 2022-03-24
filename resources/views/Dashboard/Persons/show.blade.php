@extends('Dashboard.layouts.master')
@section('title', trans('messages.person.persons'))
@section('style')
    <style> #map { height: 400px;} </style>
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
            <li class="full-width text-center"><a data-toggle="collapse" data-target="#navbar-filter"><i class="icon-menu7"></i></a></li>
        </ul>

        <div class="navbar-collapse collapse" id="navbar-filter">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#person_data" data-toggle="tab"><i
                            class="icon-menu7 position-left"></i> {{ trans('messages.person.person_data') }}</a></li>
                <li class=""><a href="#other_data" data-toggle="tab"><i class="icon-menu7 position-left"></i> {{ trans('messages.person.data_need_accept') }}</a></li>
                <li><a href="#add_address" data-toggle="tab"><i class="icon-cog3 position-left"></i> {{trans('messages.person.additional_address')}}</a></li>



                {{--                <li><a href="#person_auctions" data-toggle="tab"><i--}}
{{--                            class="icon-calendar3 position-left"></i> {{ trans('messages.person.person_auctions') }}--}}
{{--                        <span class="badge badge-success badge-inline position-right">11--}}
{{--                            {{$person->person_auctions->count()}}--}}
{{--                        </span></a>--}}
{{--                </li>--}}
                <li><a href="#send_notification" data-toggle="tab"><i class="icon-bell3 position-left"></i> {{trans('messages.notification.send')}}</a></li>
                <li><a href="#wallet" data-toggle="tab"><i class="icon-cog3 position-left"></i> {{trans('messages.wallet')}}</a></li>

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
                                                                <label class="col-form-label col-lg-3">{{ trans('messages.person.full_name') }}:</label>
                                                                <div class="col-lg-9">
                                                                    <input type="text" class="form-control" value="{{ $person->full_name }}" readonly>
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
                                                                <label class="col-form-label col-lg-3">{{trans('messages.P_O_Box')}}:</label>
                                                                <div class="col-lg-9">
                                                                    <input type="text" class="form-control" value="{{ isset($person->P_O_Box )?$person->P_O_Box :''}}" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-form-label col-lg-3">{{ trans('messages.person.block') }}:</label>
                                                                <div class="col-lg-9">
                                                                    <input type="text" class="form-control" value="{{ isset($person->block )?$person->block :''}}" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-form-label col-lg-3">{{ trans('messages.person.street') }}:</label>
                                                                <div class="col-lg-9">
                                                                    <input type="text" class="form-control" value="{{ isset($person->street )?$person->street :''}}" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-form-label col-lg-3">{{ trans('messages.person.block_num') }}:</label>
                                                                <div class="col-lg-9">
                                                                    <input type="text" class="form-control" value="{{ isset($person->block_num )?$person->block_num :''}}" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-form-label col-lg-3">{{ trans('messages.person.signs') }}:</label>
                                                                <div class="col-lg-9">
                                                                    <input type="text" class="form-control" value="{{ isset($person->signs )?$person->signs :''}}" readonly>
                                                                </div>
                                                            </div>


                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="form-group row">
                                                                        <label class="col-form-label col-lg-3">{{ trans('messages.person.identity') }}:</label>
                                                                        <div class="col-lg-9">
                                                                            <img src="{{ $person->passport_image_path }}" alt="" class=" img-thumbnail">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">

                                                                @if($person->is_verified ==0)
{{--                                                                    <a href="person/{{$person->id}}/not_verified/" class="btn btn-danger btn-sm"><i--}}
{{--                                                                            class="icon-close2"></i>{{trans('messages.not_verified')}}</a>--}}
{{--                                                                    <a href="person/{{$person->id}}/verified/" class="btn btn-success btn-sm"> <i--}}
{{--                                                                            class="icon-check2"></i> {{trans('messages.verified')}}</a>--}}

                                                                    <a href="{{route('not_verified',$person->id)}}" class="btn btn-danger btn-sm"><i
                                                                            class="icon-close2"></i>{{trans('messages.not_verified')}}</a>
                                                                    <a href="{{route('verified',$person->id)}}" class="btn btn-success btn-sm"> <i
                                                                            class="icon-check2"></i> {{trans('messages.verified')}}</a>
                                                                @endif
                                                            </div>


                                                            <div class="form-group row">
                                                                @if($person->is_verified ==1)
                                                                    <div class="btn btn-success btn-sm">
                                                                        <i class="icon-check2"></i> {{trans('messages.verified')}}</div>
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
                        <div class="tab-pane fade" id="add_address">
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
                                    <h6 class="content-group-sm text-semibold">{{ trans('messages.person.location') }}:</h6>
                                    <div class="form-group row"><br>
{{--                                        <label class="col-form-label col-lg-3">{{ trans('messages.person.location') }}:</label>--}}

                                        <div class="col-lg-9">
                                            {{--                                                                    <input id="searchInput" class=" form-control"   style="background-color: #FFF;margin-left: -180px;" placeholder=" اختر المكان علي الخريطة " name="other" >--}}
                                            <div id="map"></div>
                                        </div>
                                        <div class="col-lg-6">
                                            <input type="text" id="geo_lat"  value="{{ $person->latitude }}"  name="latitude" readonly="" placeholder=" latitude " class="form-control" >
                                        </div>
                                        <div class="col-lg-6">
                                            <input type="text" id="geo_lng"  value="{{ $person->longitude }}"  name="longitude" readonly="" placeholder="longitude" class="form-control" >
                                        </div>
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
                                            <input type="text" class="form-control" value="{{ $person->wallet }} ريال-سعودي" readonly>
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
            var marker = new google.maps.Marker({ position: {lat: lat_val, lng: lng_val}, map: map, draggable :true });

        }

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?libraries=places&callback=initMap&key=AIzaSyBzIZuaInB0vFf3dl0_Ya7r96rywFeZLks" >
    </script>

@stop
