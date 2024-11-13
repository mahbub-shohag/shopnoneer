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
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Project
        </div>

        <div class="card-body">
            <form action="{{route('project.store')}}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                {{ method_field('POST') }}

                <div class="mb-3">
                    <label class="custom-control-label" >Title</label>
                    <input class="form-control" required type="text" name="title">
                </div>
                <div class="mb-3">
                    <label for="divisionSelect" class="form-label">Division</label>
                    <select id="divisionSelect" class="form-select" name="division_id" required>
                        <option value="">Select Division</option>
                        @foreach($divisions as $division)
                            <option value="{{ $division->id }}">{{ $division->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- District Dropdown -->
                <div class="mb-3">
                    <label for="districtSelect" class="form-label">District</label>
                    <select id="districtSelect" class="form-select" name="district_id" required>
                        <option value="">Select District</option>
                    </select>
                </div>

                <!-- Upazila Dropdown -->
                <div class="mb-3">
                    <label for="upazilaSelect" class="form-label">Upazila</label>
                    <select id="upazilaSelect" class="form-select upazila-select-housing" name="upazila_id" required>
                        <option value="">Select Upazila</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="housingSelect" class="form-label">Housing</label>
                    <select id="housingSelect" class="form-select" name="housing_id" required>
                        <option value="">Select Housing</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="custom-control-label">Road</label>
                    <input type="number" class="form-control" name="road" onwheel="this.blur()">
                </div>

                <div class="mb-3">
                    <label class="custom-control-label">Block</label>
                    <input type="text" class="form-control" name="block">
                </div>

                <div class="mb-3">
                    <label class="custom-control-label">Plot Number</label>
                    <input type="text" class="form-control" name="plot">
                </div>

                <div class="mb-3">
                    <label class="custom-control-label">Plot Size</label>
                    <input type="number" class="form-control" name="plot_size" onwheel="this.blur()">
                </div>

                <div class="mb-3">
                    <label class="custom-control-label">Plot Face</label>
                    <select class="form-control" name="plot_face">
                        <option>North</option>
                        <option>South</option>
                        <option>East</option>
                        <option>West</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="custom-control-label">Is Corner</label>
                    <input type="checkbox" class="form-checkbox" name="is_corner">
                </div>

                <div class="mb-3">
                    <label class="custom-control-label">Storied</label>
                    <input type="number" class="form-control" name="storied" onwheel="this.blur()">
                </div>

                <div class="mb-3">
                    <label class="custom-control-label">No of Units</label>
                    <input type="number" class="form-control" name="no_of_units" onwheel="this.blur()">
                </div>

                <div class="mb-3">
                    <label class="custom-control-label">Floor Area</label>
                    <input type="number" class="form-control" name="floor_area" onwheel="this.blur()">
                </div>

                <div class="mb-3">
                    <label class="custom-control-label">Floor No</label>
                    <input type="number" class="form-control" name="floor_no" onwheel="this.blur()">
                </div>

                <div class="mb-3">
                    <label class="custom-control-label">No of Beds</label>
                    <input type="number" class="form-control" name="no_of_beds" onwheel="this.blur()">
                </div>

                <div class="mb-3">
                    <label class="custom-control-label">No of Baths</label>
                    <input type="number" class="form-control" name="no_of_baths" onwheel="this.blur()">
                </div>

                <div class="mb-3">
                    <label class="custom-control-label">No of Balcony</label>
                    <input type="text" class="form-control" name="no_of_balcony">
                </div>

                <div class="mb-3">
                    <label class="custom-control-label">Parking Available?</label>
                    <input type="checkbox" class="form-checkbox" name="parking_available">
                </div>

                <div class="mb-3">
                    <label class="custom-control-label">Owner Name</label>
                    <input type="text" class="form-control" name="owner_name">
                </div>

                <div class="mb-3">
                    <label class="custom-control-label">Owner Phone</label>
                    <input type="text" class="form-control" name="owner_phone">
                </div>

                <div class="mb-3">
                    <label class="custom-control-label">Owner Email</label>
                    <input type="text" class="form-control" name="owner_email">
                </div>

                <div class="mb-3">
                    <label class="custom-control-label">Rate Per sqft</label>
                    <input type="text" class="form-control" name="rate_per_sqft">
                </div>

                <div class="mb-3">
                    <label class="custom-control-label">Total Price</label>
                    <input type="number" class="form-control" name="total_price">
                </div>

                <div class="mb-3">
                    <label class="custom-control-label">Description</label>
                    <textarea class="form-control" name="description" rows="5"></textarea>
                </div>

                <div class="mb-3">
                    <label class="custom-control-label">Project Image</label>
                    <input type="file" class="form-control" style="margin-bottom: 15px;" name="project_image[]" accept="image/*">
                    <button class="btn btn-primary btn-sm image_add_btn">Add Image</button>
                </div>

                <div class="mb-3">
                    <label for="autocomplete" class="custom-control-label">Enter Address</label>
                    <input type="text" class="form-control" id="autocomplete" placeholder="Enter your address">
                </div>

                <!-- Google Map Container -->
                <div id="map" style="height: 400px; width: 100%;"></div>

                <!-- Latitude and Longitude Fields (Hidden) -->
                <input type="hidden" id="latitude" name="latitude">
                <input type="hidden" id="longitude" name="longitude">
                <button class="btn btn-primary mt-4">Submit</button>
            </form>
        </div>
    </div>

    <!-- Include External Scripts -->
    <script src="{{ asset('assets/js/ajax-handlers.js') }}"></script>
    <script src="{{ asset('assets/js/google-maps.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyABnAbo9ifTK9aGO-2oBameLdIKPxVKoXI&callback=initAutocomplete&libraries=places" defer></script>


@endsection
