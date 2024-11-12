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
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Housing
        </div>

        <div class="card-body">
            <form id="housingForm" action="{{ route('housing.store') }}" method="POST">
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
                    <input class="form-control" type="text" name="name" required>
                </div>

                <div class="mb-3">
                    <label class="custom-control-label">Division</label>
                    <select class="form-select" name="division_id" id="divisionSelect" required>
                        <option value="">Select Division</option>
                        @foreach($divisions as $division)
                            <option value="{{ $division->id }}">{{ $division->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="custom-control-label">District</label>
                    <select class="form-select" name="district_id" id="districtSelect" required>
                        <option value="">Select District</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="custom-control-label">Upazila</label>
                    <select class="form-select" name="upazila_id" id="upazilaSelect" required>
                        <option value="">Select Upazila</option>
                    </select>
                </div>

                <div id="facility-cards" class="row">
                    <!-- Cards will be dynamically loaded here -->
                </div>

                <div class="mb-3 d-flex">
{{--                    <label class="custom-control-label">Latitude:</label>--}}
                    <div class="input-group mb-3 d-flex align-items-center">
                        <input type="text" id="latitude" name="latitude" class="form-control flex-grow-1" placeholder="Latitude" aria-label="Latitude" aria-describedby="latitude-addon">
                        <span style="margin-right:50px " class="input-group-text" id="latitude-addon">°</span>
                    </div>

{{--                    <label class="custom-control-label">Longitude:</label>--}}
                    <div class="input-group mb-3 d-flex align-items-center">
                        <input type="text" id="longitude" name="longitude" class="form-control flex-grow-1" placeholder="Longitude" aria-label="Longitude" aria-describedby="longitude-addon">
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

                <button class="btn btn-primary mt-4">Submit</button>
            </form>
        </div>
    </div>

    <script>
        // Handle Division Change
        $('#divisionSelect').change(function () {
            var division_id = $(this).val();
            $.ajax({
                url: "{{ route('districts_by_division_id') }}",
                data: { "_token": "{{ csrf_token() }}", 'division_id': division_id },
                type: 'POST',
                dataType: 'html',
                success: function (result) {
                    $('#districtSelect').html(result);
                    $('#upazilaSelect').html('<option value="">Select Upazila</option>'); // Clear Upazilas
                },
                error: function () {
                    alert("Error loading districts.");
                }
            });
        });

        // Handle District Change
        $('#districtSelect').change(function () {
            let district_id = $(this).val();
            $.ajax({
                url: "{{ route('upazillas_by_district_id') }}",
                data: { "_token": "{{ csrf_token() }}", 'district_id': district_id },
                type: 'POST',
                dataType: 'html',
                success: function (result) {
                    $('#upazilaSelect').html(result);
                },
                error: function () {
                    alert("Error loading upazilas.");
                }
            });
        });

        // Handle Upazila Change
        $('#upazilaSelect').change(function () {
            let upazila_id = $(this).val();
            $.ajax({
                url: "{{ route('facilities_by_upazila_id') }}",
                data: { "_token": "{{ csrf_token() }}", 'upazila_id': upazila_id },
                type: 'POST',
                dataType: 'json',
                success: function (groupedFacilities) {
                    $('#facility-cards').html(''); // Clear previous facilities cards
                    $.each(groupedFacilities, function (categoryId, category) {
                        let categoryLabel = category[0].category.label;
                        let cardHTML = `<div class="col-md-6 mb-4"><div class="card"><div class="card-header bg-teal text-white">${categoryLabel}</div><div class="card-body">`;

                        $.each(category, function (index, facility) {
                            cardHTML += `
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="facilities[${facility.id}]" value="${facility.id}">
                                    <label class="form-check-label">${facility.name}</label>
                                </div>
                            `;
                        });

                        cardHTML += '</div></div></div>';
                        $('#facility-cards').append(cardHTML);
                    });
                },
                error: function () {
                    alert("Error loading facilities.");
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
        let marker;

        function initAutocomplete() {
            const initialPosition = { lat: 23.7570681, lng: 90.3587572 };
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
