<script>
    function initMap() {
        let lat_val = {{ $auction->latitude }};
        let lng_val = {{ $auction->longitude }};
        var map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: lat_val, lng: lng_val},
            zoom: 13
        });
        var input = document.getElementById('searchInput');
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.bindTo('bounds', map);

        var infowindow = new google.maps.InfoWindow();

        var marker = new google.maps.Marker({
            position: {lat: lat_val, lng: lng_val},
            map: map,
            anchorPoint: new google.maps.Point(0, -29),
            draggable: true
        });
    }

</script>
<script
    src="https://maps.googleapis.com/maps/api/js?libraries=places&callback=initMap&key=AIzaSyBzIZuaInB0vFf3dl0_Ya7r96rywFeZLks">
</script>
