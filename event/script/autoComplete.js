function initMap() {
    var bangkok = { lat: 13.806137, lng: 100.5230946 };
    var elementId = document.getElementById("map");
    var map = new google.maps.Map(elementId, {
        center: bangkok,
        zoom: 12
    });

    var input = document.getElementById("event-map");

    var autocomplete = new google.maps.places.Autocomplete(input);
    
    autocomplete.bindTo('bounds', map);

    var infowindow = new google.maps.InfoWindow();
    var marker = new google.maps.Marker({
        map: map,
        anchorPoint: new google.maps.Point(0, -29)
    });

    autocomplete.addListener('place_changed', function () {
        infowindow.close();
        marker.setVisible(false);
        var place = autocomplete.getPlace();
        if (!place.geometry) {
            window.alert("No details available for input: '" + place.name + "'");
            return;
        }

        if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
            let lat = place.geometry.location.lat();
            let lng = place.geometry.location.lng();
            document.getElementById("lat").value = lat;
            document.getElementById("lng").value = lng;
            $("#event-map-geo").val(lat+" "+lng);
        } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);
        }
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
    });
}