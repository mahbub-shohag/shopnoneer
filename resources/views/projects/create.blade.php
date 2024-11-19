@extends('layouts.app')

@section('title')
    Projects
@endsection

@section('bread_controller')
    <a href="/project">Project</a>
@endsection

@section('bread_action')
    Create
@endsection

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class=" mb-4">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-table me-1"></i> Project
            </div>
            <div class="card-body">
                <form action="{{ route('project.store') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('POST') }}

                    <div class="row g-4">
                        <div class="">
                            <label class="form-label">Title</label>
                            <input class="form-select" required type="text" name="title">
                        </div>

                        <div class="col-md-3">
                            <label for="divisionSelect" class="form-label">Division</label>
                            <select id="divisionSelect" class="form-select" name="division_id" required>
                                <option value="">Select Division</option>
                                @foreach($divisions as $division)
                                    <option value="{{ $division->id }}">{{ $division->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="districtSelect" class="form-label">District</label>
                            <select id="districtSelect" class="form-select" name="district_id" required>
                                <option value="">Select District</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="upazilaSelect" class="form-label">Upazila</label>
                            <select id="upazilaSelect" class="form-select upazila-select-housing" name="upazila_id"
                                    required>
                                <option value="">Select Upazila</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="housingSelect" class="form-label">Housing</label>
                            <select id="housingSelect" class="form-select " name="housing_id" required>
                                <option value="">Select Housing</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Road</label>
                            <input type="number" class="form-select" name="road" onwheel="this.blur()">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Block</label>
                            <input type="text" class="form-select" name="block">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Plot Number</label>
                            <input type="text" class="form-select" name="plot">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Plot Size</label>
                            <input type="text" class="form-select" name="plot_size">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Plot Face</label>
                            <select class="form-select" name="plot_face">
                                <option>North</option>
                                <option>South</option>
                                <option>East</option>
                                <option>West</option>
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Storied</label>
                            <input type="number" class="form-select" name="storied" onwheel="this.blur()">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">No of Units</label>
                            <input type="number" class="form-select" name="no_of_units" onwheel="this.blur()">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Floor Area</label>
                            <input type="number" class="form-select" name="floor_area" onwheel="this.blur()">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Floor No</label>
                            <input type="number" class="form-select" name="floor_no" onwheel="this.blur()">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">No of Beds</label>
                            <input type="number" class="form-select" name="no_of_beds" onwheel="this.blur()">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">No of Baths</label>
                            <input type="number" class="form-select" name="no_of_baths" onwheel="this.blur()">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">No of Balcony</label>
                            <input type="text" class="form-select" name="no_of_balcony">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Owner Name</label>
                            <input type="text" class="form-select" name="owner_name">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Owner Phone</label>
                            <input type="text" class="form-select" name="owner_phone">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Owner Email</label>
                            <input type="text" class="form-select" name="owner_email">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Rate Per sqft</label>
                            <input type="text" class="form-select" name="rate_per_sqft">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Total Price</label>
                            <input type="number" class="form-select" name="total_price">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Is Corner</label>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input initially-all-check-box" name="is_corner" id="is_corner" onchange="toggleCheckboxBackground(this)">
                                <label class="form-check-label" for="is_corner">Yes</label>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <input  type="checkbox" class="form-check-input initially-all-check-box" name="parking_available"  onchange="toggleCheckboxBackground(this)">
                            <label class="form-check-label">Parking Available?</label>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">Description</label>
                            <textarea class="form-select" name="description" rows="5"></textarea>
                            <button type="button" class="btn btn-primary mt-3" id="add-image-btn">Add Image</button>
                        </div>

                        <div class="image-input-container">
                            <div class="col-12 mb-3">
                                <input type="file" class="form-select" name="project_image[]" accept="image/*">
                            </div>
                        </div>
                        <label class="form-label card-body">Amenities</label>
                        <div class="row">
                            @foreach($amenities as $amenity)
                                <div class="col-md-4 col-sm-6 mb-3">
                                    <div class="d-flex align-items-center">
                                        <input
                                                class="form-check-input initially-all-check-box"
                                                type="checkbox"
                                                id="amenity_{{ $amenity->id }}"
                                                name="amenities[]"
                                                value="{{ $amenity->id }}"
                                                checked
                                                onchange="toggleCheckboxBackground(this)"
                                        >
                                        <label for="amenity_{{ $amenity->id }}" class="form-check-label">
                                            {{ $amenity->name }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Include External JS -->
                        <script src="{{ asset('js/amenities.js') }}"></script>

                    </div>
                    <button class="btn btn-primary mt-4">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/js/ajax-handlers.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $('#add-image-btn').click(function () {
            $('.image-input-container').append(`
            <div class="col-12 mb-3">
                <input type="file" class="form-select" name="project_image[]" accept="image/*">
            </div>
        `);
        });
    </script>

@endsection
