@extends('front.layouts.master')
@section('title', trans('messages.my_profile'))
@section('style')
{{--    <style> #map { height: 400px;} </style>--}}
@endsection

@section('content')
    <main class="categories-bar row">
        @include('front.layouts.parts.nav_categories')
    </main>
    @include('front.layouts.parts.alert')
    <section class="my-wallet-page" dir="{{ direction() }}">
        <div class="container">
            <nav class="breadcrumb-nav" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item" style="padding-right: 10px;"><a href="{{route('front.my_profile')}}">{{ trans('messages.my_profile') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{route('front.my_wallet')}}">{{ trans('messages.user.my_wallet')}}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ trans('messages.cheque')}}</li>
                </ol>
            </nav>
        </div>
        <div class="wallet-balance">
            <div class="container">
                <div class="balance-content">
                    <h2>{{ trans('messages.our_offices')}}</h2>
                </div>
            </div>
        </div>
        <div class="container">
            <ul class="wallet-details">
                <li>
                    <p>{{ trans('messages.mobile')}} : </p>
                    <p>{{$mobile}}</p>
                </li>
                <li>
                    <p>{{ trans('messages.fax')}} : </p>
                    <p>{{$fax}}</p>
                </li>
                <li>
                    <p>{{ trans('messages.email')}} : </p>
                    <p>{{$email}}</p>
                </li>
            </ul>
            <div class="row">
                <div class="col-md-6">
                    <div class="payment-method payment-country">
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            <ul class="methods">
                                <li>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-headingOne">
                                            <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#flush-collapseOne"
                                                    aria-expanded="false" aria-controls="flush-collapseOne">
                                                {{ trans('messages.address')}}
                                            </button>
                                        </h2>
                                        <div id="flush-collapseOne" class="accordion-collapse collapse"
                                             aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">
                                                {{$address}}
                                            </div>
                                        </div>
                                    </div>
                                </li>


{{--                                <li>--}}
{{--                                    <div class="accordion-item">--}}
{{--                                        <h2 class="accordion-header" id="flush-headingTwo">--}}
{{--                                            <button class="accordion-button collapsed" type="button"--}}
{{--                                                    data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo"--}}
{{--                                                    aria-expanded="false" aria-controls="flush-collapseTwo">--}}
{{--                                                El Raiyad--}}
{{--                                            </button>--}}
{{--                                        </h2>--}}
{{--                                        <div id="flush-collapseTwo" class="accordion-collapse collapse"--}}
{{--                                             aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">--}}
{{--                                            <div class="accordion-body">--}}
{{--                                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero ullam--}}
{{--                                                repellat cupiditate esse! Tenetur, maiores laboriosam sequi dolorem--}}
{{--                                                libero voluptatum reiciendis omnis pariatur, neque consectetur aliquam--}}
{{--                                                dolorum incidunt sit odit!--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </li>--}}

                            </ul>
                        </div>
                    </div>
                </div>
            </div><br><br>

            <div class="terms">
{{--                <h4>{{ trans('messages.our_address_on_map')}}:</h4>--}}

{{--                <div class="form-group">--}}
{{--                    <div class="col-lg-12">--}}
{{--                        <input id="searchInput" class=" form-control"  placeholder=" اختر المكان علي الخريطة " name="other">--}}
{{--                        <div id="map"></div>--}}
{{--                    </div>--}}
{{--                    <div class="col-lg-6">--}}
{{--                        <input type="text" id="geo_lat" name="latitude" value="{{ $latitude }}" readonly="" placeholder=" latitude" class="form-control hidden d-none">--}}
{{--                    </div>--}}
{{--                    <div class="col-lg-6">--}}
{{--                        <input type="text" id="geo_lng" name="longitude"  value="{{ $longitude }}"readonly="" placeholder="longitude" class="form-control hidden d-none">--}}
{{--                    </div>--}}
{{--                </div>--}}

                <div class="terms">
                    <h4>{{ trans('messages.our_address_on_map')}}:</h4>
{{--                    <div id="map" class="m-6"></div>--}}
                    <iframe id="map" src="https://maps.google.com/maps?q={{ $latitude }},{{ $longitude }}&hl=es&z=14&output=embed" width="100%" frameborder="0" style="border:0;height: 400px;" allowfullscreen="allowfullscreen"></iframe>

                </div>

            </div>

        </div>
    </section>
@stop

@push('scripts')
{{--    <script>--}}
{{--        @include('front.layouts.parts.map')--}}
{{--    </script>--}}


{{--<script>--}}
{{--    function initMap() {--}}

{{--        let lat_val ={{ $latitude }};--}}
{{--        let lng_val ={{ $longitude }};--}}
{{--        var map = new google.maps.Map(document.getElementById('map'), {--}}
{{--            center: {lat: lat_val, lng: lng_val},--}}
{{--            zoom: 13--}}
{{--        });--}}

{{--        var input = document.getElementById('searchInput');--}}
{{--        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);--}}

{{--        var autocomplete = new google.maps.places.Autocomplete(input);--}}
{{--        autocomplete.bindTo('bounds', map);--}}

{{--        var infowindow = new google.maps.InfoWindow();--}}

{{--        var marker = new google.maps.Marker({ position: {lat: lat_val, lng: lng_val}, map: map, anchorPoint: new google.maps.Point(0, -29), draggable :true });--}}

{{--        google.maps.event.addListener(map, 'click', function (event) {--}}
{{--            document.getElementById("geo_lat").value = event.latLng.lat();--}}
{{--            document.getElementById("geo_lng").value = event.latLng.lng();--}}
{{--            marker.setPosition(event.latLng);--}}
{{--        });--}}


{{--        marker.addListener('position_changed', printMarkerLocation);--}}
{{--        function printMarkerLocation() {--}}
{{--            document.getElementById('geo_lat').value = marker.position.lat();--}}
{{--            document.getElementById('geo_lng').value = marker.position.lng();--}}

{{--            // console.log('Lat: ' + marker.position.lat() + ' Lng:' + marker.position.lng() );--}}
{{--        }--}}
{{--        autocomplete.addListener('place_changed', function () {--}}
{{--            infowindow.close();--}}
{{--            marker.setVisible(false);--}}
{{--            var place = autocomplete.getPlace();--}}
{{--            if (!place.geometry) {--}}
{{--                window.alert("Autocomplete's returned place contains no geometry");--}}
{{--                return;--}}
{{--            }--}}

{{--            // If the place has a geometry, then present it on a map.--}}
{{--            if (place.geometry.viewport) {--}}
{{--                map.fitBounds(place.geometry.viewport);--}}
{{--            } else {--}}
{{--                map.setCenter(place.geometry.location);--}}
{{--                map.setZoom(17);--}}
{{--            }--}}
{{--            marker.setIcon(({--}}
{{--                url: place.icon,--}}
{{--                size: new google.maps.Size(71, 71),--}}
{{--                origin: new google.maps.Point(0, 0),--}}
{{--                anchor: new google.maps.Point(17, 34),--}}
{{--                scaledSize: new google.maps.Size(35, 35)--}}
{{--            }));--}}
{{--            marker.setPosition(place.geometry.location);--}}
{{--            marker.setVisible(true);--}}

{{--            var address = '';--}}
{{--            if (place.address_components) {--}}
{{--                address = [--}}
{{--                    (place.address_components[0] && place.address_components[0].short_name || ''),--}}
{{--                    (place.address_components[1] && place.address_components[1].short_name || ''),--}}
{{--                    (place.address_components[2] && place.address_components[2].short_name || '')--}}
{{--                ].join(' ');--}}
{{--            }--}}

{{--            infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);--}}
{{--            infowindow.open(map, marker);--}}

{{--            //Location details--}}
{{--            for (var i = 0; i < place.address_components.length; i++) {--}}
{{--                if (place.address_components[i].types[0] == 'postal_code') {--}}
{{--                    document.getElementById('postal_code').value = place.address_components[i].long_name;--}}
{{--                }--}}
{{--                if (place.address_components[i].types[0] == 'country') {--}}
{{--                    document.getElementById('country').value = place.address_components[i].long_name;--}}
{{--                }--}}
{{--            }--}}
{{--            document.getElementById('location').value = place.formatted_address;--}}
{{--        });--}}
{{--    }--}}

{{--</script>--}}
{{--<script src="https://maps.googleapis.com/maps/api/js?libraries=places&callback=initMap&key=AIzaSyDdCP49XcVxRLuY-4CYtxHXxnqucDvQLE8" >--}}
{{--<script src="https://maps.googleapis.com/maps/api/js?libraries=places&callback=initMap&key=AIzaSyBzIZuaInB0vFf3dl0_Ya7r96rywFeZLks" >--}}
{{--</script>--}}
@endpush
