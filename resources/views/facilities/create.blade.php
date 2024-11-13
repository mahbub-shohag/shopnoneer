@extends('layouts.app')

@section('title')
    Facility
@endsection

@section('bread_controller')
    <a href="{{ route('facility.index') }}">Facility</a>
@endsection

@section('bread_action')
    Create
@endsection

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Create Facility
        </div>

        <div class="card-body">
            <form action="{{ route('facility.store') }}" method="POST">
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
                    <label class="custom-control-label">Facility Name</label>
                    <input class="form-control" type="text" name="name">
                </div>

                <div class="mb-3">
                    <label class="custom-control-label">Select A Facilities</label>
                    <select class="form-select" name="category_id">
                        <option value="">Select Category</option>
                        @foreach($facility_categories as $facility_category)
                            <option value="{{ $facility_category->id }}">{{ $facility_category->label }}</option>
                        @endforeach
                    </select>
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

                <div class="mb-3">
                    <label for="districtSelect" class="form-label">District</label>
                    <select id="districtSelect" class="form-select" name="district_id" required>
                        <option value="">Select District</option>
                    </select>
                </div>

                <!-- Upazila Dropdown -->
                <div class="mb-3">
                    <label for="upazilaSelect" class="form-label">Upazila</label>
                    <select id="upazilaSelect" class="form-select upazila-select-facilities" name="upazila_id" required>
                        <option value="">Select Upazila</option>
                    </select>
                </div>
                <div class="mb-3 d-flex">
                    <div class="input-group mb-3 d-flex align-items-center">
                        <input type="text" id="latitude" name="latitude" class="form-control flex-grow-1" placeholder="Latitude" aria-label="Latitude" aria-describedby="latitude-addon">
                        <span style="margin-right:50px " class="input-group-text" id="latitude-addon">°</span>
                    </div>
                    <div class="input-group mb-3 d-flex align-items-center">
                        <input type="text" id="longitude" name="longitude" class="form-control flex-grow-1" placeholder="Longitude" aria-label="Longitude" aria-describedby="longitude-addon">
                        <span class="input-group-text" id="longitude-addon">°</span>
                    </div>
                </div>


                <div class="mb-3">
                    <label class="custom-control-label">Google Map URL</label>
                    <input class="form-control" type="text" name="google_map_url">
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
    <!-- Include External Scripts -->
    <script src="{{ asset('assets/js/ajax-handlers.js') }}"></script>
    <script src="{{ asset('assets/js/google-maps.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyABnAbo9ifTK9aGO-2oBameLdIKPxVKoXI&callback=initAutocomplete&libraries=places" defer></script>

@endsection
