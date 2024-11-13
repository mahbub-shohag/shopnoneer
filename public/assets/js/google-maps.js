let map, marker;

function initAutocomplete() {
    const mapElement = document.getElementById("map");

    // Get latitude and longitude from the data attributes
    const initialPosition = {
        lat: parseFloat(mapElement.getAttribute("data-latitude")) || 23.756744,
        lng: parseFloat(mapElement.getAttribute("data-longitude")) || 90.356459,
    };

    map = new google.maps.Map(mapElement, {
        center: initialPosition,
        zoom: 18,
    });

    marker = new google.maps.Marker({
        position: initialPosition,
        map: map,
        draggable: true,
    });

    marker.addListener("dragend", function (event) {
        updateLatLngInputs(event.latLng.lat(), event.latLng.lng());
    });

    const input = document.getElementById("pac-input");
    const searchBox = new google.maps.places.SearchBox(input);
    searchBox.addListener("places_changed", function () {
        const places = searchBox.getPlaces();
        if (places.length === 0) return;
        const place = places[0];
        if (!place.geometry || !place.geometry.location) return;

        const location = place.geometry.location;
        marker.setPosition(location);
        map.setCenter(location);
        updateLatLngInputs(location.lat(), location.lng());
    });
}

function updateLatLngInputs(lat, lng) {
    document.getElementById('latitude').value = lat;
    document.getElementById('longitude').value = lng;
}

window.initAutocomplete = initAutocomplete;
