@extends('layouts.app')

@section('title')
    Projects
@endsection

@section('bread_controller')
    <a href="/project">Project</a>

@endsection

@section('bread_action')
    create
@endsection

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class=" mb-4">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-table me-1"></i> Project
            </div>
            <div class="card-body">
                <form action="{{ route('project.update',$project->id) }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <div class="row g-4">
                        <div class="">
                            <label class="form-label">Title</label>
                            <input class="form-select" type="text" name="title" value="{{ $project->title }}">
                        </div>

                        <div class="col-md-3">
                            <label for="divisionSelect" class="form-label">Division</label>
                            <select id="divisionSelect" class="form-select" name="division_id" required>
                                <option value="">Select Division</option>
                                @foreach($divisions as $division)
                                    <option value="{{ $division->id }}"
                                            @if($division->id == $project->division_id) selected @endif>
                                        {{ $division->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="districtSelect" class="form-label">District</label>
                            <select id="districtSelect" class="form-select" name="district_id" required>
                                <option value="">Select District</option>
                                @foreach($districts as $district)
                                    <option value="{{ $district->id }}"
                                            @if($district->id == $project->district_id) selected @endif>
                                        {{ $district->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="upazilaSelect" class="form-label">Upazila</label>
                            <select id="upazilaSelect" class="form-select upazila-select-housing" name="upazila_id"
                                    required>
                                @foreach($upazillas as $upazila)
                                    <option value="{{ $upazila->id }}"
                                            @if($upazila->id == $project->upazila_id) selected @endif>
                                        {{ $upazila->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="housingSelect" class="form-label">Housing</label>
                            <select id="housingSelect" class="form-select " name="housing_id" required>
                                @foreach($housings as $housing)
                                    <option value="{{ $housing->id }}"
                                            @if($housing->id == $project->housing_id) selected @endif>
                                        {{ $housing->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Road</label>
                            <input type="number" class="form-select" name="road" value="{{ $project->road }}"
                                   onwheel="this.blur()">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Block</label>
                            <input type="text" class="form-select" name="block" value="{{ $project->block }}">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Plot Number</label>
                            <input type="text" class="form-select" name="plot" value="{{ $project->plot }}">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Plot Size</label>
                            <input type="text" class="form-select" name="plot_size" value="{{ $project->plot_size }}">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Plot Face</label>
                            <select class="form-select" name="plot_face">
                                <option value="North" {{ $project->plot_face == 'North' ? 'selected' : '' }}>North
                                </option>
                                <option value="South" {{ $project->plot_face == 'South' ? 'selected' : '' }}>South
                                </option>
                                <option value="East" {{ $project->plot_face == 'East' ? 'selected' : '' }}>East</option>
                                <option value="West" {{ $project->plot_face == 'West' ? 'selected' : '' }}>West</option>
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Storied</label>
                            <input type="number" class="form-select" name="storied" value="{{ $project->storied}}"
                                   onwheel="this.blur()">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">No of Units</label>
                            <input type="number" class="form-select" name="no_of_units"
                                   value="{{ $project->no_of_units }}" onwheel="this.blur()">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Floor Area</label>
                            <input type="number" class="form-select" name="floor_area"
                                   value="{{ $project->floor_area }}" onwheel="this.blur()">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Floor No</label>
                            <input type="number" class="form-select" name="floor_no" value="{{ $project->floor_no}}"
                                   onwheel="this.blur()">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">No of Beds</label>
                            <input type="number" class="form-select" name="no_of_beds"
                                   value="{{ $project->no_of_beds }}" onwheel="this.blur()">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">No of Baths</label>
                            <input type="number" class="form-select" name="no_of_baths"
                                   value="{{ $project->no_of_baths }}" onwheel="this.blur()">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">No of Balcony</label>
                            <input type="text" class="form-select" name="no_of_balcony"
                                   value="{{ $project->no_of_balcony }}">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Owner Name</label>
                            <input type="text" class="form-select" name="owner_name"
                                   value="{{ $project->owner_name }}">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Owner Phone</label>
                            <input type="text" class="form-select" name="owner_phone"
                                   value="{{ $project->owner_phone }}">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Owner Email</label>
                            <input type="text" class="form-select" name="owner_email"
                                   value="{{ $project->owner_email }}">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Rate Per sqft</label>
                            <input type="text" class="form-select" name="rate_per_sqft"
                                   value="{{ $project->rate_per_sqft }}">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Total Price</label>
                            <input type="number" class="form-select" name="total_price"
                                   value="{{ $project->total_price }}">
                        </div>
                        <div class="col-md-12mb-3">
                            <label class="custom-control-label">Is Corner?</label>
                            <input type="checkbox" class="form-checkbox" name="is_corner"
                                   value="{{ $project->is_corner}}"
                                    {{$project->is_corner == 1  ? 'checked' : ''}}
                            >
                        </div>
                        <div class="mb-3">
                            <label class="custom-control-label">Parking Available?</label>
                            <input type="checkbox" class="form-checkbox" name="parking_available"
                                   value="{{ $project->parking_available}}"
                                    {{$project->parking_available == 1  ? 'checked' : ''}}
                            >
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">Description</label>
                            <textarea class="form-select" name="description"
                                      rows="5">{{ $project->description }}</textarea>
                            <button type="button" class="btn btn-primary mt-3" id="add-image-btn">Add Image</button>

                        </div>
                        <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
                            @foreach($project->getMedia('project_image') as $image)
                                <label style="position: relative; width: auto; height: 60px; border-radius: 8px; overflow: hidden; display: flex; justify-content: center; align-items: center; cursor: pointer;">
                                    <img style="max-width: 100%; max-height: 100%; object-fit: cover; opacity: 0.6; transition: opacity 0.3s;" src="{{ $image->getUrl() }}" alt="Image">
                                    <input
                                            type="checkbox"
                                            name="delete_images[]"
                                            value="{{ $image->id }}"
                                            style="display: none;"
                                            checked
                                            onclick="this.previousElementSibling.style.opacity = this.checked ? '0.5' : '1';">
                                </label>
                            @endforeach
                        </div>





                        <div class="image-input-container">
                            <div class="col-12 mb-3">
                                <label class="form-label">Project Image</label>
                                <input type="file" class="form-select" name="project_image[]" accept="image/*">
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label" for="autocomplete">Enter Address</label>
                            <input type="text" class="form-select" id="autocomplete" placeholder="Enter your address">
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
                                                onchange="toggleCheckboxBackground(this)"
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
