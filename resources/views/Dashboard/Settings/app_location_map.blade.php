
{{--    //Map//--}}
<script>
    function initMap() {
        // let lat_val = 24.7135517;
        // let lng_val = 46.67529569;
        $latitude={{App\Models\Setting::where('key','latitude')->first()->value}};
        $longitude={{App\Models\Setting::where('key','longitude')->first()->value}};
        let lat_val =$latitude;
        let lng_val =$longitude;
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
{{--<script src="https://maps.googleapis.com/maps/api/js?libraries=places&callback=initMap&key=AIzaSyDdCP49XcVxRLuY-4CYtxHXxnqucDvQLE8" >--}}
<script src="https://maps.googleapis.com/maps/api/js?libraries=places&callback=initMap&key=AIzaSyBzIZuaInB0vFf3dl0_Ya7r96rywFeZLks" >
</script>
