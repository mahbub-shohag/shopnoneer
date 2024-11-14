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
    <div class=" mb-4">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-table me-1"></i> Project
            </div>
            <div class="card-body">
                <form action="{{ route('project.store') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('POST') }}

                    <!-- Use Bootstrap Grid for Layout -->
                    <div class="row g-4">
                        <!-- Title -->
                        <div class="">
                            <label class="form-label">Title</label>
                            <input class="form-control" type="text" name="title" value="{{ $project->title }}">
                        </div>

                        <!-- Division -->
                        <div class="col-md-3">
                            <label for="divisionSelect" class="form-label">Division</label>
                            <select id="divisionSelect" class="form-select" name="division_id" required>
                                <option value="">Select Division</option>
                                @foreach($divisions as $division)
                                    <option value="{{ $division->id }}" @if($division->id == $project->division_id) selected @endif>
                                        {{ $division->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- District -->
                        <div class="col-md-3">
                            <label for="districtSelect" class="form-label">District</label>
                            <select id="districtSelect" class="form-select" name="district_id" required>
                                <option value="">Select District</option>
                                @foreach($districts as $district)
                                    <option value="{{ $district->id }}" @if($district->id == $project->district_id) selected @endif>
                                        {{ $district->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Upazila -->
                        <div class="col-md-3">
                            <label for="upazilaSelect" class="form-label">Upazila</label>
                            <select id="upazilaSelect" class="form-select upazila-select-housing" name="upazila_id"
                                    required>
                                @foreach($upazillas as $upazila)
                                    <option value="{{ $upazila->id }}" @if($upazila->id == $project->upazila_id) selected @endif>
                                        {{ $upazila->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Housing -->
                        <div class="col-md-3">
                            <label for="housingSelect" class="form-label">Housing</label>
                            <select id="housingSelect" class="form-select " name="housing_id" required>
                                @foreach($housings as $housing)
                                    <option value="{{ $housing->id }}" @if($housing->id == $project->housing_id) selected @endif>
                                        {{ $housing->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Road -->
                        <div class="col-md-3">
                            <label class="form-label">Road</label>
                            <input type="number" class="form-control" name="road" value="{{ $project->road }}" onwheel="this.blur()">
                        </div>

                        <!-- Block -->
                        <div class="col-md-3">
                            <label class="form-label">Block</label>
                            <input type="text" class="form-control" name="block" value="{{ $project->block }}">
                        </div>

                        <!-- Plot Number -->
                        <div class="col-md-3">
                            <label class="form-label">Plot Number</label>
                            <input type="text" class="form-control" name="plot" value="{{ $project->plot }}">
                        </div>
                        <!-- Storied -->
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Storied</label>
                            <input type="number" class="form-control" name="storied" value="{{ $project->plot_size}}" onwheel="this.blur()">
                        </div>
                        <!-- No of Units -->
                        <div class="col-md-3 mb-3">
                            <label class="form-label">No of Units</label>
                            <input type="number" class="form-control" name="no_of_units" value="{{ $project->no_of_units }}" onwheel="this.blur()">
                        </div>
                        <!-- Floor Area -->
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Floor Area</label>
                            <input type="number" class="form-control" name="floor_area" value="{{ $project->floor_area }}" onwheel="this.blur()">
                        </div>
                        <!-- Floor No -->
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Floor No</label>
                            <input type="number" class="form-control" name="floor_no" value="{{ $project->floor_no}}" onwheel="this.blur()">
                        </div>
                        <!-- No of Beds -->
                        <div class="col-md-3 mb-3">
                            <label class="form-label">No of Beds</label>
                            <input type="number" class="form-control" name="no_of_beds" value="{{ $project->no_of_beds }}" onwheel="this.blur()">
                        </div>
                        <!-- No of Baths -->
                        <div class="col-md-3 mb-3">
                            <label class="form-label">No of Baths</label>
                            <input type="number" class="form-control" name="no_of_baths" value="{{ $project->no_of_baths }}" onwheel="this.blur()">
                        </div>
                        <!-- No of Balcony -->
                        <div class="col-md-3 mb-3">
                            <label class="form-label">No of Balcony</label>
                            <input type="text" class="form-control" name="no_of_balcony" value="{{ $project->no_of_balcony }}">
                        </div>
                        <!-- Owner Name -->
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Owner Name</label>
                            <input type="text" class="form-control" name="owner_name" value="{{ $project->owner_name }}">
                        </div>
                        <!-- Owner Phone -->
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Owner Phone</label>
                            <input type="text" class="form-control" name="owner_phone" value="{{ $project->owner_phone }}">
                        </div>
                        <!-- Owner Email -->
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Owner Email</label>
                            <input type="text" class="form-control" name="owner_email" value="{{ $project->owner_email }}">
                        </div>
                        <!-- Rate Per sqft -->
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Rate Per sqft</label>
                            <input type="text" class="form-control" name="rate_per_sqft" value="{{ $project->rate_per_sqft }}">
                        </div>
                        <!-- Total Price -->
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Total Price</label>
                            <input type="number" class="form-control" name="total_price" value="{{ $project->total_price }}">
                        </div>
                        <!-- Is Corner -->
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Is Corner</label>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="is_corner" id="is_corner">

                            </div>
                        </div>
                        <!-- Parking Available -->
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Parking Available?</label>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="parking_available"
                                       id="parking_available">
                                <label class="form-check-label" for="parking_available">Yes</label>
                            </div>
                        </div>
                        <!-- Description -->
                        <div class="col-12 mb-3">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" name="description" value="{{ $project->description }}" rows="5"></textarea>
                        </div>

                        <!-- Project Image -->
                        <div class="col-12 mb-3">
                            <label class="form-label">Project Image</label>
                            <input type="file" class="form-control" name="project_image[]" accept="image/*">
                            <button class="btn btn-primary btn-sm mt-2 image_add_btn">Add Image</button>
                        </div>

                        <!-- Enter Address -->
                        <div class="col-12 mb-3">
                            <label class="form-label" for="autocomplete">Enter Address</label>
                            <input type="text" class="form-control" id="autocomplete" placeholder="Enter your address">
                        </div>
                        <label class="form-label card-body">Amenities</label>
                        <div class="row">
                            @foreach($amenities as $amenity)
                                <div class="col-md-4 col-sm-6 mb-3">
                                    <div class="d-flex align-items-center">
                                        <input
                                                class="form-check-input"
                                                type="checkbox"
                                                id="amenity_{{ $amenity->id }}"
                                                name="amenities[]"
                                                value="{{ $amenity->id }}"
                                                checked
                                                style="border-color: #0c4128; background-color: teal;"
                                        >

                                        <label for="amenity_{{ $amenity->id }}" class="form-check-label">
                                            {{ $amenity->name }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                    <button class="btn btn-primary mt-4">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/js/ajax-handlers.js') }}"></script>

@endsection
