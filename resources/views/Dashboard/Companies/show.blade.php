@extends('Dashboard.layouts.master')
@section('title', trans('messages.company.companies'))
@section('style')
    <style> #map { height: 400px;} </style>
@endsection
@section('breadcrumb')
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="{{route('admin.home')}}"><i
                        class="icon-home2 position-left"></i> @lang('messages.home')</a>
            </li>
            <li><a href="{{ route('companies.index') }}"><i
                        class="icon-admin position-left"></i> @lang('messages.company.companies')</a></li>
            <li class="active">@lang('messages.company.show')</li>
        </ul>
        @include('Dashboard.layouts.parts.quick-links')
    </div>
@endsection


@section('content')


    <!-- Toolbar -->
    <div class="navbar navbar-default navbar-xs content-group">
        @include('Dashboard.layouts.parts.validation_errors')

        <ul class="nav navbar-nav visible-xs-block">
            <li class="full-width text-center"><a data-toggle="collapse" data-target="#navbar-filter"><i class="icon-menu7"></i></a></li>
        </ul>

        <div class="navbar-collapse collapse" id="navbar-filter">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#company_data" data-toggle="tab"><i
                            class="icon-menu7 position-left"></i> {{ trans('messages.company.company_data') }}</a></li>
                <li><a href="#company_auctions" data-toggle="tab"><i
                            class="icon-calendar3 position-left"></i> {{ trans('messages.company.company_auctions') }}
                        <span
                            class="badge badge-success badge-inline position-right">
{{--                        {{$company->company_auctions->count()}}--}}
                        </span></a>
                </li>
                <li><a href="#send_notification" data-toggle="tab"><i
                            class="icon-bell3 position-left"></i> {{trans('messages.notification.send')}}</a></li>
{{--                <li><a href="#settings" data-toggle="tab"><i class="icon-cog3 position-left"></i> Settings</a></li>--}}
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
                        <div class="tab-pane fade in active" id="company_data">
                            <!-- company_data -->
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
                                                                        <label class="col-form-label col-lg-3">{{ trans('messages.company.image') }}:</label>
                                                                        <div class="col-lg-9">
                                                                            <img src="{{ $company->image_path }}" alt="" class=" img-thumbnail">
                                                                        </div>
                                                                    </div>
                                                                </div>
{{--                                                                <div class="col-lg-6">--}}
{{--                                                                    <div class="form-group row">--}}

{{--                                                                        <label class="col-form-label col-lg-3"><span class="badge badge-info" >{{ trans('messages.wallet') }} : </span></label>--}}

{{--                                                                        <div class="col-lg-9">--}}
{{--                                                                            <input type="text" class="form-control" value="{{ $company->wallet}} /ريال-سعودي/" readonly>--}}
{{--                                                                        </div>--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}
                                                            </div>
                                                            <hr>
{{--                                                            <div class="form-group row">--}}
{{--                                                                <label class="col-form-label col-lg-3">{{ trans('messages.type') }}:</label>--}}
{{--                                                                <div class="col-lg-9">--}}
{{--                                                                    <input type="text" class="form-control" value="{{ $company->is_company=='company'?trans('messages.company'):trans('messages.person')}}" readonly>--}}

{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                            <div class="form-group row">--}}
{{--                                                                <label--}}
{{--                                                                    class="col-form-label col-lg-3">{{ trans('messages.company.full_name') }}--}}
{{--                                                                    :</label>--}}
{{--                                                                <div class="col-lg-9">--}}
{{--                                                                    <input type="text" class="form-control"--}}
{{--                                                                           value="{{ $company->full_name }}" readonly>--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
                                                            <div class="form-group row">
                                                                <label
                                                                    class="col-form-label col-lg-3">{{ trans('messages.company.user_name') }}
                                                                    :</label>
                                                                <div class="col-lg-9">
                                                                    <input type="text" class="form-control"
                                                                           value="{{ $company->user_name }}" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-form-label col-lg-3">{{ trans('messages.email') }}:</label>
                                                                <div class="col-lg-9">
                                                                    <input type="text" class="form-control" value="{{ $company->email }}" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-form-label col-lg-3">{{ trans('messages.mobile') }}:</label>
                                                                <div class="col-lg-9">
                                                                    <input type="text" class="form-control" value="{{ $company->mobile }}" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-form-label col-lg-3">{{ trans('messages.nationality.nationality') }}:</label>
                                                                <div class="col-lg-9">
                                                                    <input type="text" class="form-control" value="{{isset( $company->nationality)?$company->nationality->$name:'' }}" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-form-label col-lg-3">{{ trans('messages.city.city') }}:</label>
                                                                <div class="col-lg-9">
                                                                    <input type="text" class="form-control" value="{{ isset($company->city)?$company->city->$name:'' }}" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-form-label col-lg-3">{{ trans('messages.since') }}:</label>
                                                                <div class="col-lg-9">
                                                                    <input type="text" class="form-control"
                                                                           value="{{ $company->created_at->diffForHumans() }}" readonly>
                                                                </div>
                                                            </div>

{{--                                                            @if($company->is_company=='company')--}}
                                                            <div class="form-group row"><br>
                                                                <div class="col-lg-6">
                                                                    <div class="form-group row">
                                                                        <label class="col-form-label col-lg-3">{{ trans('messages.commercial_register_image') }}:</label>
                                                                        <div class="col-lg-9">
                                                                            <img src="{{ $company->commercial_register_image_path }}" alt="" class=" img-thumbnail">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div><br>
                                                            <div class="form-group row"><br>
                                                                <label class="col-form-label col-lg-3">{{ trans('messages.company.location') }}:</label>

                                                                <div class="col-lg-9">
{{--                                                                    <input id="searchInput" class=" form-control"   style="background-color: #FFF;margin-left: -180px;" placeholder=" اختر المكان علي الخريطة " name="other" >--}}
                                                                    <div id="map"></div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <input type="text" id="geo_lat"  value="{{ $company->latitude }}"  name="latitude" readonly="" placeholder=" latitude " class="form-control" >
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <input type="text" id="geo_lng"  value="{{ $company->longitude }}"  name="longitude" readonly="" placeholder="longitude" class="form-control" >
                                                                </div>
                                                            </div>
{{--                                                            @endif--}}
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /sales stats -->
                                </div>
                            </div>
                            <!-- /company_data -->
                        </div>
                        <div class="tab-pane fade" id="company_auctions">
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
                                        {{__('messages.company.full_name')}}
                                        <small class="display-block">{{$company->user_name}}</small>
                                    </h6>

                                    <div class="row">
                                        @foreach($company_auctions as $company_auction)
                                            <div class="col-sm-4 col-lg-2">
                                                <div class="panel">
                                                    <div class="bg-info-800 demo-color">
                                                        <span>{{$company_auction->$name}}</span></div>

                                                    <div class="p-15">
                                                        <div class="media-body">
                                                            <strong>{{$company_auction->start_auction_price}}
                                                                ريال</strong>
                                                            <div
                                                                class="text-muted mt-5">{{$company_auction->value_of_increment}}
                                                                ريال
                                                            </div>
                                                        </div>

                                                        <div class="media-right">
                                                            <ul class="icons-list">
                                                                <li><a href="#" data-toggle="modal" data-target="#info_800">
                                                                        <i class="icon-three-bars"></i></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div>
                                                    <span class="badge  badge-pill" style="background-color: #00838F;">
                                                        <a href={{ route('auctions.show', $company_auction->id) }}>{{__('messages.company.show_auction_bids')}}</a>
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
                                                            {{$company_auction->$description}}                                                        </div>

                                                        <div class="table-responsive content-group">
                                                            <table class="table">
                                                                <tr>
                                                                    <td>{{__('messages.auction.name')}}:</td>
                                                                    <td><code>{{$company_auction->$name}}</code></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>{{__('messages.auction.start_auction_price')}}
                                                                        :
                                                                    </td>
                                                                    <td>
                                                                        <code>{{$company_auction->start_auction_price}}</code>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>{{__('messages.auction.value_of_increment')}}:
                                                                    </td>
                                                                    <td>
                                                                        <code>.{{$company_auction->value_of_increment}}</code>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <div>
                                                                <span class="badge  badge-pill"
                                                                      style="background-color: #00838F;">
                                                                    <a href={{ route('auctions.show', $company_auction->id) }}>{{__('messages.company.show_auction_bids')}}</a>
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
                                            <input type="hidden" name="user_id" value="{{ $company->id }}"/>
                                            <label> {{ trans('messages.notification.title') }} </label>
                                            <input type="text" class="form-control" name="title"/><br>
                                            <label> {{ trans('messages.notification.text') }} </label>
                                            <textarea class="form-control" name="text"></textarea><br>
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
{{--                        <div class="tab-pane fade" id="settings">--}}
{{--                        </div>--}}


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
                                            <input type="text" class="form-control" value="{{ $company->wallet }} ريال-سعودي" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row"><br>
                                        <a href="#" data-toggle="modal" data-target="#add_wallet"
                                           class="btn btn-success btn-labeled btn-labeled-left"><b>
                                                <i class="icon-plus2"></i></b>{{ trans('messages.person.add_wallet') }}

                                        </a>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('Dashboard.Companies.add_to_wallet_modal')

    </div>

@stop

@section('scripts')

    <script>
        function initMap() {
            let lat_val = {{ $company->latitude }};
            let lng_val = {{ $company->longitude }};
            var map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: lat_val, lng: lng_val},
                zoom: 13
            });

            // var input = document.getElementById('searchInput');
            // map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

            // var autocomplete = new google.maps.places.Autocomplete(input);
            // autocomplete.bindTo('bounds', map);
            //
            // var infowindow = new google.maps.InfoWindow();
            var marker = new google.maps.Marker({ position: {lat: lat_val, lng: lng_val}, map: map, draggable :true });
            // var marker = new google.maps.Marker({
            //     map: map,
            //     anchorPoint: new google.maps.Point(0, -29),
            //     draggable: true
            // });


            // google.maps.event.addListener(map, 'click', function (event) {
            //     document.getElementById("geo_lat").value = event.latLng.lat();
            //     document.getElementById("geo_lng").value = event.latLng.lng();
            //     marker.setPosition(event.latLng);
            // });

            //
            // marker.addListener('position_changed', printMarkerLocation);
            // function printMarkerLocation() {
            //     document.getElementById('geo_lat').value = marker.position.lat();
            //     document.getElementById('geo_lng').value = marker.position.lng();
            //
            //     // console.log('Lat: ' + marker.position.lat() + ' Lng:' + marker.position.lng() );
            // }
            // autocomplete.addListener('place_changed', function () {
            //     infowindow.close();
            //     marker.setVisible(false);
            //     var place = autocomplete.getPlace();
            //     if (!place.geometry) {
            //         window.alert("Autocomplete's returned place contains no geometry");
            //         return;
            //     }
            //
            //     // If the place has a geometry, then present it on a map.
            //     if (place.geometry.viewport) {
            //         map.fitBounds(place.geometry.viewport);
            //     } else {
            //         map.setCenter(place.geometry.location);
            //         map.setZoom(17);
            //     }
            //     marker.setIcon(({
            //         url: place.icon,
            //         size: new google.maps.Size(71, 71),
            //         origin: new google.maps.Point(0, 0),
            //         anchor: new google.maps.Point(17, 34),
            //         scaledSize: new google.maps.Size(35, 35)
            //     }));
            //     marker.setPosition(place.geometry.location);
            //     marker.setVisible(true);
            //
            //     var address = '';
            //     if (place.address_components) {
            //         address = [
            //             (place.address_components[0] && place.address_components[0].short_name || ''),
            //             (place.address_components[1] && place.address_components[1].short_name || ''),
            //             (place.address_components[2] && place.address_components[2].short_name || '')
            //         ].join(' ');
            //     }
            //
            //     infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
            //     infowindow.open(map, marker);
            //
            //     //Location details
            //     for (var i = 0; i < place.address_components.length; i++) {
            //         if (place.address_components[i].types[0] == 'postal_code') {
            //             document.getElementById('postal_code').value = place.address_components[i].long_name;
            //         }
            //         if (place.address_components[i].types[0] == 'country') {
            //             document.getElementById('country').value = place.address_components[i].long_name;
            //         }
            //     }
            //     document.getElementById('location').value = place.formatted_address;
            // });
        }

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?libraries=places&callback=initMap&key=AIzaSyBzIZuaInB0vFf3dl0_Ya7r96rywFeZLks" >
    </script>

{{--    @include('Dashboard.layouts.parts.map')--}}
@stop
