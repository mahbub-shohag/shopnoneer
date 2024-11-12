@extends('layouts.app')

@section('title')
    Edit Facility
@endsection

@section('bread_controller')
    <a href="{{ route('facility.index') }}">Facilities</a>
@endsection

@section('bread_action')
    Edit
@endsection

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-building me-1"></i>
            Edit Facility
        </div>

        <div class="card-body">
            <form action="{{ route('facility.update', $facility->id) }}" method="POST">
                {{ csrf_field() }}
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
                    <label class="custom-control-label">Facility Name</label>
                    <input class="form-control" type="text" name="name" value="{{ old('name', $facility->name) }}">
                </div>

                <div class="mb-3">
                    <label class="custom-control-label">Facility Category</label>
                    <select class="form-select" name="category_id">
                        @foreach($facility_categories as $category)
                            <option value="{{ $category->id }}" {{ $facility->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->label }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="custom-control-label">Division</label>
                    <select class="form-select" name="division_id">
                        @foreach($divisions as $division)
                            <option value="{{ $division->id }}" {{ $facility->division_id == $division->id ? 'selected' : '' }}>
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
                            <option value="{{ $district->id }}" @if($district->id == $facility->district_id) selected @endif>
                                {{ $district->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="custom-control-label">Upazila</label>
                    <select class="form-select" name="upazila_id">
                        <option value="">Select Upazila</option>
                        @foreach($upazilas as $upazila)
                            <option value="{{ $upazila->id }}" @if($upazila->id == $facility->upazila_id) selected @endif>
                                {{ $upazila->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3 d-flex">
                    {{--                    <label class="custom-control-label">Latitude:</label>--}}
                    <div class="input-group mb-3 d-flex align-items-center">
                        <input value="{{ $facility->latitude }}" type="text" id="latitude" name="latitude" class="form-control flex-grow-1" placeholder="Latitude" aria-label="Latitude" aria-describedby="latitude-addon">
                        <span style="margin-right:50px " class="input-group-text" id="latitude-addon">°</span>
                    </div>

                    {{--                    <label class="custom-control-label">Longitude:</label>--}}
                    <div class="input-group mb-3 d-flex align-items-center">
                        <input value="{{ $facility->longitude }}" type="text" id="longitude" name="longitude" class="form-control flex-grow-1" placeholder="Longitude" aria-label="Longitude" aria-describedby="longitude-addon">
                        <span class="input-group-text" id="longitude-addon">°</span>
                    </div>
                </div>

                <input
                        style="margin-bottom: 30px;margin-top: 10px;width: 15%"
                        id="pac-input"
                        class="controls"
                        type="text"
                        placeholder="Search Box"
                />
                <div id="map" style="height: 500px; width: 100%;"></div>

                <button class="btn btn-primary">Update Facility</button>
            </form>
        </div>
    </div>

    <script
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyABnAbo9ifTK9aGO-2oBameLdIKPxVKoXI&callback=initAutocomplete&libraries=places&v=weekly"
            defer
    ></script>

    <script>
        let map;
        let autocomplete;
        let marker;

        function initAutocomplete() {
            let latitude = document.getElementById('latitude').value;
            let longitude = document.getElementById('longitude').value;
            latitude = latitude!==""?parseFloat(latitude):23.7570681;
            longitude = longitude!==""?parseFloat(longitude):90.3587572;
            const initialPosition = { lat: latitude, lng: longitude };
            map = new google.maps.Map(document.getElementById("map"), {
                center: initialPosition,
                zoom: 13,
                mapTypeId: "roadmap",
            });

            marker = new google.maps.Marker({
                position: initialPosition,
                map: map,
                draggable: true,
            });

            marker.addListener("dragend", function (event) {
                const lat = event.latLng.lat();
                const lng = event.latLng.lng();
                $('#latitude').val(lat);
                $('#longitude').val(lng);
                map.setCenter(event.latLng);
            });

            const input = document.getElementById("pac-input");
            const searchBox = new google.maps.places.SearchBox(input);
            map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

            map.addListener("bounds_changed", function () {
                searchBox.setBounds(map.getBounds());
            });

            google.maps.event.addListener(searchBox, "places_changed", function () {
                const places = searchBox.getPlaces();
                if (places.length === 0) return;

                const bounds = new google.maps.LatLngBounds();
                places.forEach(function (place) {
                    if (!place.geometry) return;
                    if (place.geometry.viewport) {
                        bounds.union(place.geometry.viewport);
                    } else {
                        bounds.extend(place.geometry.location);
                    }

                    marker.setPosition(place.geometry.location);
                    $('#latitude').val(place.geometry.location.lat());
                    $('#longitude').val(place.geometry.location.lng());
                });
                map.fitBounds(bounds);
            });
        }

        window.initAutocomplete = initAutocomplete;
    </script>
@endsection
