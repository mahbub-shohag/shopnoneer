
@extends('layouts.app')

@section('title')
    Housing
@endsection

@section('bread_controller')
    <a href="index.html">Housing</a>
@endsection

@section('bread_action')
    create
@endsection

@section('content')
    <style>
        /*
        * Always set the map height explicitly to define the size of the div element
        * that contains the map.
        */
        #map {
            height: 100%;
        }
        #description {
            font-family: Roboto;
            font-size: 15px;
            font-weight: 300;
        }

        #infowindow-content .title {
            font-weight: bold;
        }

        #infowindow-content {
            display: none;
        }

        #map #infowindow-content {
            display: inline;
        }

        .pac-card {
            background-color: #fff;
            border: 0;
            border-radius: 2px;
            box-shadow: 0 1px 4px -1px rgba(0, 0, 0, 0.3);
            margin: 10px;
            padding: 0 0.5em;
            font: 400 18px Roboto, Arial, sans-serif;
            overflow: hidden;
            font-family: Roboto;
            padding: 0;
        }

        #pac-container {
            padding-bottom: 12px;
            margin-right: 12px;
        }

        .pac-controls {
            display: inline-block;
            padding: 5px 11px;
        }

        .pac-controls label {
            font-family: Roboto;
            font-size: 13px;
            font-weight: 300;
        }

        #pac-input {
            background-color: #fff;
            font-family: Roboto;
            font-size: 15px;
            font-weight: 300;
            margin-left: 12px;
            padding: 0 11px 0 13px;
            text-overflow: ellipsis;
            width: 400px;
        }

        #pac-input:focus {
            border-color: #4d90fe;
        }

        #title {
            color: #fff;
            background-color: #4d90fe;
            font-size: 25px;
            font-weight: 500;
            padding: 6px 12px;
        }

        #target {
            width: 345px;
        }

    </style>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Housing
        </div>

        <div class="card-body">
            <form action="{{ route('housing.store') }}" method="POST">
                {{ csrf_field() }}
                {{ method_field('POST') }}

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ol>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ol>
                    </div>
                @endif
                <div class="mb-3">
                    <label class="custom-control-label">Housing Name</label>
                    <input class="form-control" type="text" name="name">
                </div>

                <div class="mb-3">
                    <label class="custom-control-label">Division</label>
                    <select class="form-select" name="division_id">
                        <option value="">Select Division</option>
                        @foreach($divisions as $division)
                            <option value="{{ $division->id }}" >{{ $division->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="custom-control-label">District</label>
                    <select class="form-select" name="district_id">
                        <option value="">Select District</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="custom-control-label">Upazila</label>
                    <select class="form-select" name="upazila_id">
                        <option value="">Select Upazila</option>
                    </select>
                </div>

                <div class="mb-3">
                    Latitude : <input type="text" id="latitude" name="latitude">
                    Longitude : <input type="text" id="longitude" name="longitude">
                </div>

                <input
                        style="margin-bottom: 30px"
                        id="pac-input"
                        class="controls"
                        type="text"
                        placeholder="Search Box"
                />
                <!-- Google Map Container -->
                <div id="map" style="height: 400px; width: 100%;"></div>

                <button class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

    <script>
        $('select[name="division_id"]').change(function(){
            var division_id = $(this).val();
            $.ajax({
                url : "{{ route('districts_by_division_id') }}",
                data : {
                    "_token": "{{ csrf_token() }}",
                    'division_id' : division_id
                },
                type : 'POST',
                dataType : 'html',
                success : function(result){
                    $('select[name="district_id"]').html('');
                    $('select[name="district_id"]').append(result);
                }
            });
        });

        $('select[name="district_id"]').change(function(){
            let district_id = $(this).val();
            $.ajax({
                url : "{{ route('upazillas_by_district_id') }}",
                data : {
                    "_token": "{{ csrf_token() }}",
                    'district_id' : district_id
                },
                type : 'POST',
                dataType : 'html',
                success : function(result){
                    $('select[name="upazila_id"]').html('');
                    $('select[name="upazila_id"]').append(result);
                }
            });
        });
    </script>


    <script
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyABnAbo9ifTK9aGO-2oBameLdIKPxVKoXI&callback=initAutocomplete&libraries=places&v=weekly"
            defer
    ></script>
    <script>
        let map;

        let autocomplete;

        function initAutocomplete() {
            let marker;
            const initialPosition = { lat: 23.7570681, lng: 90.3587572 };
            const map = new google.maps.Map(document.getElementById("map"), {
                center: { lat: 23.7570681, lng: 90.3587572 },
                zoom: 13,
                mapTypeId: "roadmap",
            });

            // Create a draggable marker
             marker = new google.maps.Marker({
                position: initialPosition,
                map: map,
                draggable: true,
            });

            // Log when dragging starts

            // Log when dragging ends
            marker.addListener("dragend", (event) => {

                const lat = event.latLng.lat();
                const lng = event.latLng.lng();
                // Display coordinates
                document.getElementById('latitude').value = lat;
                document.getElementById("longitude").value = lng;
                console.log("Map drag ended at:", map.getCenter().toString());
                map.setCenter(event.latLng);

            });



            // Create the search box and link it to the UI element.
            const input = document.getElementById("pac-input");
            const searchBox = new google.maps.places.SearchBox(input);

            map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
            // Bias the SearchBox results towards current map's viewport.
            map.addListener("bounds_changed", () => {
                searchBox.setBounds(map.getBounds());
            });

            // Add a click listener on the map
            map.addListener("click", (event) => {
                // Get latitude and longitude from the event object
                console.log(event);
                const lat = event.latLng.lat();
                const lng = event.latLng.lng();
                // Display coordinates
                document.getElementById('latitude').value = lat;
                document.getElementById("longitude").value = lng;
                // Remove the previous marker if it exists
                if (marker) {
                    //marker.setMap(null);
                }

                // Add a new marker at the clicked location
                // marker = new google.maps.Marker({
                //     position: event.latLng,
                //     map: map,
                //     draggable: true
                // });

                marker.setPosition(event.latLng);
                map.setCenter(event.latLng);

            });

            let markers = [];

            // Listen for the event fired when the user selects a prediction and retrieve
            // more details for that place.
            searchBox.addListener("places_changed", () => {
                const places = searchBox.getPlaces();

                if (places.length == 0) {
                    return;
                }

                // Clear out the old markers.
                markers.forEach((marker) => {
                    marker.setMap(null);
                });
                markers = [];

                // For each place, get the icon, name and location.
                const bounds = new google.maps.LatLngBounds();

                places.forEach((place) => {
                    if (!place.geometry || !place.geometry.location) {
                        console.log("Returned place contains no geometry");
                        return;
                    }

                    const icon = {
                        url: place.icon,
                        size: new google.maps.Size(71, 71),
                        origin: new google.maps.Point(0, 0),
                        anchor: new google.maps.Point(17, 34),
                        scaledSize: new google.maps.Size(25, 25),
                    };

                    // Create a marker for each place.
                    // markers.push(
                    //     new google.maps.Marker({
                    //         map,
                    //         icon,
                    //         title: place.name,
                    //         position: place.geometry.location,
                    //     }),
                    // );
                    if (place.geometry.viewport) {
                        // Only geocodes have viewport.
                        bounds.union(place.geometry.viewport);
                    } else {
                        bounds.extend(place.geometry.location);
                    }
                });
                map.fitBounds(bounds);
            });

            /*Place Marker*/
            let defaultLocation = { lat: 23.7570681, lng: 90.3587572 };
            autocomplete = new google.maps.places.Autocomplete(
                document.getElementById('autocomplete')
            );

            // Update the map and marker when an address is selected from the autocomplete suggestions
            autocomplete.addListener('place_changed', function() {
                let place = autocomplete.getPlace();

                if (!place.geometry) {
                    console.error('No details available for the input: ' + place.name);
                    return;
                }

                // Center the map on the selected place
                map.setCenter(place.geometry.location);
                map.setZoom(15);

                // Update the marker position
                marker.setPosition(place.geometry.location);

                // Set the latitude and longitude values
                document.getElementById('latitude').value = place.geometry.location.lat();
                document.getElementById('longitude').value = place.geometry.location.lng();
            });
            /*Place Marker*/
        }

        window.initAutocomplete = initAutocomplete;

    </script>



@endsection



