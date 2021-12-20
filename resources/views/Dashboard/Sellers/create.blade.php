@extends('Dashboard.layouts.master')
@section('title', trans('messages.create-var',['var'=>trans('messages.seller.seller')]))
@section('style')
    <style>
        #map { height: 400px;}
    </style>
@endsection
@section('content')

    <!-- Page header -->
    <div class="page-header page-header-default">
        @section('breadcrumb')
        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li><a href="{{route('admin.home')}}"><i class="icon-home2 position-left"></i> @lang('messages.home')</a>
                </li>
                <li><a href="{{ route('sellers.index') }}"><i
                            class="icon-admin position-left"></i> @lang('messages.seller.sellers')</a></li>
                <li class="active">@lang('messages.create-var',['var'=>trans('messages.seller.seller')])</li>
            </ul>

            @include('Dashboard.layouts.parts.quick-links')
        </div>
        @endsection
    </div>
    <!-- /page header -->

    @include('Dashboard.layouts.parts.validation_errors')

    <div class="row" style="padding: 15px;">
        <div class="col-md-6">

            <!-- Basic layout-->
            <form action="{{ route('sellers.store') }}" class="form-horizontal" method="post"
                  enctype="multipart/form-data">
                @csrf
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title">{{ trans('messages.add_new_seller') }}</h5>
                        <div class="heading-elements">
                            <ul class="icons-list">
                                <li><a data-action="collapse"></a></li>
                                <li><a data-action="reload"></a></li>
                                <li><a data-action="close"></a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="panel-body">
                        <div class="box-body">
                            <div class="form-group">
                                <label
                                    class="col-lg-3 control-label display-block"> {{ trans('messages.seller.person/company') }} </label>
                                <div class="col-lg-9">
                                    <select name="is_company" onchange="select(this);"
                                            class="select-border-color border-warning form-control">
                                        <option  value="person" selected>{{trans('messages.person')}}</option>
                                        <option  id="option" value="company ">{{trans('messages.company')}}</option>
                                    </select>
                                </div>
                            </div>
                            <div id="commercial_register_image" style="display:none;">
                                <div class="form-group">
                                    <label>@lang('messages.commercial_register_image')
                                        <input type="file" class="col-lg-3 control-label display-block image " name="commercial_register_image">
                                        <img src=" {{ asset('uploads/default.png') }} " width="100px" class="thumbnail image-preview">
                                    </label>
                                </div><br>
                                <div class="form-group">
                                    <label>@lang('messages.seller.location'):</label>
                                    <div class="col-lg-12">
                                        <input id="searchInput" class=" form-control"   style="background-color: #FFF;margin-left: -150px;" placeholder=" اختر المكان علي الخريطة " name="other">
                                        <div id="map"></div>
                                    </div>
                                    <div class="col-lg-6">
                                        <input type="text" id="geo_lat" name="latitude" readonly="" placeholder=" latitude" class="form-control">
                                    </div>
                                    <div class="col-lg-6">
                                        <input type="text" id="geo_lng" name="longitude" readonly="" placeholder="longitude" class="form-control">
                                    </div>
                                </div>


{{--                                <div class="form-group">--}}
{{--                                    <label class="col-lg-3 control-label">{{ trans('messages.lat') }}</label>--}}
{{--                                    <div class="col-lg-9">--}}
{{--                                        <input type="text" class="form-control" value="" name="lat" placeholder="@lang('messages.lat') ">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">{{ trans('messages.full_name') }}</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" value="" name="full_name" placeholder="@lang('messages.full_name') ">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">{{ trans('messages.user_name') }}</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" value="" name="user_name" placeholder="@lang('messages.user_name') ">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">{{ trans('messages.email') }}</label>
                                <div class="col-lg-9">
                                    <input type="email" name="email" class="form-control" value="{{ old('email') }}"
                                           placeholder="{{ trans('messages.email') }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-3 control-label">{{ trans('messages.mobile') }}</label>
                                <div class="col-lg-9">
                                    <input type="text" name="mobile" value="{{ old('mobile') }}" class="form-control"
                                           placeholder="{{ trans('messages.mobile') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">{{ trans('messages.P_O_Box') }}</label>
                                <div class="col-lg-9">
                                    <input type="text" name="P_O_Box" value="{{ old('P_O_Box') }}" class="form-control"
                                           placeholder="{{ trans('messages.P_O_Box') }}">
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-lg-3 control-label"> {{ trans('messages.password') }} </label>
                                <div class="col-lg-9">
                                    <input type="password" class="form-control" name="password"
                                           placeholder=" {{ trans('messages.password') }} "/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-3 control-label"> {{ trans('messages.confirm_password') }} </label>
                                <div class="col-lg-9">
                                    <input type="password" class="form-control" name="password_confirmation"
                                           placeholder=" {{ trans('messages.confirm_password') }} "/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-3 control-label">{{ trans('messages.gender') }}</label>
                                <div class="col-lg-9">
                                    <select name=" gender" class="select-border-color border-warning">
                                        <option value="male">{{trans('messages.male')}}</option>
                                        <option value="female">{{trans('messages.female')}}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-3 control-label display-block">{{ trans('messages.is_appear_name')}}:</label>
                                <label class="radio-inline">
                                    <input type="radio"  value="1" class="styled" name="is_appear_name" checked="checked">{{trans('messages.Yes')}}
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" value="0" class="styled" name="is_appear_name">{{trans('messages.No')}}
                                </label>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-3 control-label display-block"> {{ trans('messages.city_name') }} </label>
                                <div class="col-lg-9">
                                    <select name="city_id" class="select-border-color border-warning form-control">
                                        @foreach ($cities as $city)
                                            <option value="{{ $city->id }}"> {{ $city->$name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>@lang('messages.seller.image'):</label>
                                    <input type="file" class="form-control image " name="image">
                                    <img src=" {{ asset('uploads/default.png') }} " width="100px" class="thumbnail image-preview">
                            </div>


                        </div>

                    </div>

                    <div class="text-right" style="padding-bottom: 10px; padding-left: 10px;">
                        <input type="submit" class="btn btn-primary"
                               value=" {{ trans('messages.add_and_forward_to_list') }} "/>
                        {{--                        <input type="submit" class="btn btn-success" name="back" value=" {{ trans('messages.add_and_come_back') }} " />--}}
                    </div>

                </div>
            </form>
            <!-- /basic layout -->
        </div>


        <div class="col-md-6">
            <div class="panel panel-flat">

                <div class="panel-heading">
                    <h5 class="panel-title"> {{ trans('messages.latest_sellers') }} </h5>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                            <li><a data-action="reload"></a></li>
                            <li><a data-action="close"></a></li>
                        </ul>
                    </div>
                </div>

                <div class="panel-body">
                    <table class="table table-bordered table-hover">
                        <tr class="text-center">
                            <th> {{ trans('messages.full_name') }} </th>
                            <th> {{ trans('messages.user_name') }} </th>
                        </tr>
                        @forelse($latest_sellers as $seller)
                            <tr>
                                <td> {{ $seller->full_name }} </td>
                                <td>{{ $seller->user_name }}</td>
                            </tr>
                        @empty
                        @endforelse
                    </table>
                </div>
            </div>
        </div>
    </div>


@section('scripts')

    <script>
    function select(nameSelect) {
    console.log(nameSelect);
    if (nameSelect) {
    optionValue = document.getElementById("option").value;
    if (optionValue == nameSelect.value) {
    document.getElementById("commercial_register_image").style.display = "block";
    } else {
    document.getElementById("commercial_register_image").style.display = "none";
    }
    } else {
    document.getElementById("commercial_register_image").style.display = "none";
    }
    }
    </script>





    {{--    //Map//--}}
    <script>
        function initMap() {
            let lat_val = 24.7135517;
            let lng_val = 46.67529569;
            var map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: lat_val, lng: lng_val},
                zoom: 13
            });

            var input = document.getElementById('searchInput');
            map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

            var autocomplete = new google.maps.places.Autocomplete(input);
            autocomplete.bindTo('bounds', map);

            var infowindow = new google.maps.InfoWindow();

            var marker = new google.maps.Marker({ position: {lat: lat_val, lng: lng_val}, map: map, anchorPoint: new google.maps.Point(0, -29), draggable :true });

            google.maps.event.addListener(map, 'click', function (event) {
                document.getElementById("geo_lat").value = event.latLng.lat();
                document.getElementById("geo_lng").value = event.latLng.lng();
                marker.setPosition(event.latLng);
            });


            marker.addListener('position_changed', printMarkerLocation);
            function printMarkerLocation() {
                document.getElementById('geo_lat').value = marker.position.lat();
                document.getElementById('geo_lng').value = marker.position.lng();

                // console.log('Lat: ' + marker.position.lat() + ' Lng:' + marker.position.lng() );
            }
            autocomplete.addListener('place_changed', function () {
                infowindow.close();
                marker.setVisible(false);
                var place = autocomplete.getPlace();
                if (!place.geometry) {
                    window.alert("Autocomplete's returned place contains no geometry");
                    return;
                }

                // If the place has a geometry, then present it on a map.
                if (place.geometry.viewport) {
                    map.fitBounds(place.geometry.viewport);
                } else {
                    map.setCenter(place.geometry.location);
                    map.setZoom(17);
                }
                marker.setIcon(({
                    url: place.icon,
                    size: new google.maps.Size(71, 71),
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(17, 34),
                    scaledSize: new google.maps.Size(35, 35)
                }));
                marker.setPosition(place.geometry.location);
                marker.setVisible(true);

                var address = '';
                if (place.address_components) {
                    address = [
                        (place.address_components[0] && place.address_components[0].short_name || ''),
                        (place.address_components[1] && place.address_components[1].short_name || ''),
                        (place.address_components[2] && place.address_components[2].short_name || '')
                    ].join(' ');
                }

                infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
                infowindow.open(map, marker);

                //Location details
                for (var i = 0; i < place.address_components.length; i++) {
                    if (place.address_components[i].types[0] == 'postal_code') {
                        document.getElementById('postal_code').value = place.address_components[i].long_name;
                    }
                    if (place.address_components[i].types[0] == 'country') {
                        document.getElementById('country').value = place.address_components[i].long_name;
                    }
                }
                document.getElementById('location').value = place.formatted_address;
            });
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?libraries=places&callback=initMap&key=AIzaSyDdCP49XcVxRLuY-4CYtxHXxnqucDvQLE8" >
    </script>
@stop
@stop



