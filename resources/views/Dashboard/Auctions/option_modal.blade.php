<!-- option modal -->
<div id="add_options" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="table-responsive content-group">
                    <!-- Basic layout-->
                    <form action="{{ route('auction_data.store') }}" class="form-horizontal" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h5 class="panel-title">{{ trans('messages.option.add') }}</h5>
                            </div>
                            <div class="panel-body">
                                <div class="box-body">
                                    <input type="hidden" name="auction_id" value="{{$auction->id}}" >
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label display-block"> {{ trans('messages.auction.choose_options') }} </label>
                                        <div class="col-lg-6">
                                            <select name="option_id" id="options" class="select">
                                                <optgroup label="{{ trans('messages.option.options') }}">
                                                    @foreach($auction->category->options as $option)
                                                        <option value="{{ $option->id }}"> {{ $option->$name }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div><br>
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label display-block"> {{ trans('messages.auction.choose_option_details') }} </label>
                                        <div class="col-lg-6">
                                            <select name="option_details_id" id="option_details" class="select">
                                                <optgroup label="{{ trans('messages.auction.choose_option_details') }}">
                                                    @foreach($auction->category->option_details as $option_detail)
                                                        <option value="{{ $option_detail->id }}"> {{ $option_detail->$value }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div><br>
                                </div>
                            </div>
                            <div class="text-right" style="padding-bottom: 10px; padding-left: 10px;">
                                <input type="submit" class="btn btn-primary" value=" {{ trans('messages.add_and_forward_to_list') }} "/>
                            </div>
                        </div>
                    </form>
                    <!-- /basic layout -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link btn-xs text-uppercase text-semibold" data-dismiss="modal">Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /option modal -->

@section('scripts')
    @include('Dashboard.layouts.parts.ajax_get_options')







    <script>
        function initMap() {
            let lat_val = {{ $auction->latitude }};
            let lng_val = {{ $auction->longitude }};
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




@endsection
