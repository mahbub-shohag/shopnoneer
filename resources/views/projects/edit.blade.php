@extends('layouts.app')

@section('title')
    Projects
@endsection

@section('bread_controller')
    <a href="index.html">Project</a>
@endsection

@section('bread_action')
    create
@endsection

@section('content')
    <div class="mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Project
        </div>

        <div class="card-body">
            <form action="{{route('project.update',  $project->id)}}" method="POST">
                {{csrf_field()}}
                {{ method_field('PUT') }}
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
                    <label class="custom-control-label">Title</label>
                    <input class="form-control" type="text" name="title" value="{{ $project->title }}">
                </div>
                <div class="mb-3">
                    <label class="custom-control-label">Division</label>
                    <select class="form-select" name="division_id">
                        <option value="">Select Division</option>
                        @foreach($divisions as $division)
                            <option value="{{ $division->id }}" @if($division->id == $project->division_id) selected @endif>
                                {{ $division->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="custom-control-label">District</label>
                    <select class="form-select" name="district_id">
                        <option value="">Select District</option>
                        @foreach($districts as $district)
                            <option value="{{ $district->id }}" @if($district->id == $project->district_id) selected @endif>
                                {{ $district->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="custom-control-label">Upazila</label>
                    <select class="form-select" name="upazila_id">
                        <option value="">Select Upazila</option>
                        @foreach($upazillas as $upazila)
                            <option value="{{ $upazila->id }}" @if($upazila->id == $project->upazila_id) selected @endif>
                                {{ $upazila->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="custom-control-label">Housing</label>
                    <select class="form-select" name="housing_id">
                        <option value="">Select Housing</option>
                        @foreach($housings as $housing)
                            <option value="{{ $housing->id }}" @if($housing->id == $project->housing_id) selected @endif>
                                {{ $housing->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="custom-control-label">Road</label>
                    <input type="number" class="form-control" name="road" value="{{ $project->road }}">
                </div>

                <div class="mb-3">
                    <label class="custom-control-label">Block</label>
                    <input type="text" class="form-control" name="block" value="{{ $project->block }}">
                </div>

                <div class="mb-3">
                    <label class="custom-control-label">Plot Number</label>
                    <input type="text" class="form-control" name="plot" value="{{ $project->plot }}">
                </div>

                <div class="mb-3">
                    <label class="custom-control-label">Plot Size</label>
                    <input type="number" class="form-control" name="plot_size" value="{{ $project->plot_size}}">
                </div>

                <div class="mb-3">
                    <label class="custom-control-label">Plot Face</label>
                    <select class="form-control" name="plot_face">
                        <option value="North" {{ $project->plot_face == 'North' ? 'selected' : '' }}>North</option>
                        <option value="South" {{ $project->plot_face == 'South' ? 'selected' : '' }}>South</option>
                        <option value="East"  {{ $project->plot_face == 'East' ? 'selected' : '' }}>East</option>
                        <option value="West"  {{ $project->plot_face == 'West' ? 'selected' : '' }}>West</option>
                    </select>
                </div>


                <div class="mb-3">
                    <label class="custom-control-label">Is Corner</label>
                    <input type="checkbox" class="form-checkbox" name="is_corner" value="{{ $project->is_corner }}"
                            {{ $project->is_corner == 1 ? 'checked' : '' }}>
                </div>

                <div class="mb-3">
                    <label class="custom-control-label">No of Units</label>
                    <input type="number" class="form-control" name="no_of_units" value="{{ $project->storied}}" >
                </div>
                <div class="mb-3">
                    <label class="custom-control-label">Storied</label>
                    <input type="number" class="form-control" name="storied"  value="{{ $project->no_of_units }}">
                </div>


                <div class="mb-3">
                    <label class="custom-control-label">Floor Area</label>
                    <input type="number" class="form-control" name="floor_area" value="{{ $project->floor_area }}">
                </div>

                <div class="mb-3">
                    <label class="custom-control-label">floor_no</label>
                    <input type="number" class="form-control" name="floor_no" value="{{ $project->floor_no}}">
                </div>

                <div class="mb-3">
                    <label class="custom-control-label">No of Beds</label>
                    <input type="number" class="form-control" name="no_of_beds" value="{{ $project->no_of_beds }}">
                </div>

                <div class="mb-3">
                    <label class="custom-control-label">No of Baths</label>
                    <input type="number" class="form-control" name="no_of_baths" value="{{ $project->no_of_baths }}">
                </div>

                <div class="mb-3">
                    <label class="custom-control-label">No of Balcony</label>
                    <input type="number" class="form-control" name="no_of_balcony"  value="{{ $project->no_of_balcony }}">
                </div>

                <div class="mb-3">
                    <label class="custom-control-label">Parking Available?</label>
                    <input type="checkbox" class="form-checkbox" name="parking_available" value="{{ $project->parking_available}}"
                      {{$project->parking_available == 1  ? 'checked' : ''}}
                    >


                </div>

                <div class="mb-3">
                    <label class="custom-control-label">Owner Name</label>
                    <input type="text" class="form-control" name="owner_name" value="{{ $project->owner_name }}">
                </div>

                <div class="mb-3">
                    <label class="custom-control-label">Owner Phone</label>
                    <input type="text" class="form-control" name="owner_phone" value="{{ $project->owner_phone }}">
                </div>

                <div class="mb-3">
                    <label class="custom-control-label">Owner Email</label>
                    <input type="text" class="form-control" name="owner_email" value="{{ $project->owner_email }}">
                </div>

                <div class="mb-3">
                    <label class="custom-control-label">Rate Per sqft</label>
                    <input type="text" class="form-control" name="rate_per_sqft" value="{{ $project->rate_per_sqft }}">
                </div>

                <div class="mb-3">
                    <label class="custom-control-label">Total Price</label>
                    <input type="number" class="form-control" name="total_price" value="{{ $project->total_price }}">
                </div>

                <div class="mb-3">
                    <label class="custom-control-label">Description</label>
                    <input type="text" class="form-control" name="description" value="{{ $project->description }}">
                </div>

                <div class="mb-3">
                    <label for="autocomplete" class="custom-control-label">Enter Address</label>
                    <input type="text" class="form-control" id="autocomplete" placeholder="Enter your address">
                </div>

                <!-- Map Container -->
                <div id="map" style="height: 400px; width: 100%;"></div>

                <!-- Latitude and Longitude Fields (Hidden) -->
                <input type="hidden" id="latitude" name="latitude">
                <input type="hidden" id="longitude" name="longitude">




                <button class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

    <script>
        $('select[name="division_id"]').change(function(){
            var division_id = $(this).val();
            $.ajax({
                headers: {

                },
                url : "{{route('districts_by_division_id')}}",
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
            var district_id = $(this).val();
            $.ajax({
                headers: {

                },
                url : "{{route('upazillas_by_district_id')}}",
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




        $('select[name="upazila_id"]').change(function(){
            var upazila_id = $(this).val();
            $.ajax({
                headers: {

                },
                url : "{{route('housings_by_upazila_id')}}",
                data : {
                    "_token": "{{ csrf_token() }}",
                    'upazila_id' : upazila_id
                },
                type : 'POST',
                dataType : 'html',
                success : function(result){
                    $('select[name="housing_id"]').html('');
                    $('select[name="housing_id"]').append(result);
                }
            });
        });
    </script>

    <!-- Load Google Maps JavaScript API with Places Library -->
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=YOUR_GOOGLE_MAPS_API_KEY&libraries=places">
    </script>

    <script>
        let map;
        let marker;
        let autocomplete;

        function initMap() {
            // Default location (latitude and longitude)
            let defaultLocation = { lat: -34.397, lng: 150.644 };

            // Initialize map centered on the default location
            map = new google.maps.Map(document.getElementById('map'), {
                center: defaultLocation,
                zoom: 8
            });

            // Initialize the marker
            marker = new google.maps.Marker({
                map: map,
                position: defaultLocation,
                draggable: true
            });

            // Update latitude and longitude fields when marker is moved
            google.maps.event.addListener(marker, 'dragend', function(event) {
                document.getElementById('latitude').value = event.latLng.lat();
                document.getElementById('longitude').value = event.latLng.lng();
            });

            // Initialize the autocomplete input field
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
        }

        // Load the map after the page has loaded
        window.onload = function() {
            initMap();
        };
    </script>

@endsection
