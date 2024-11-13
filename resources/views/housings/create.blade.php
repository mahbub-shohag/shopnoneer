@extends('layouts.app')

@section('title', 'Housing')

@section('bread_controller')
    <a href="index.html">Housing</a>
@endsection

@section('bread_action', 'Create')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Housing
        </div>

        <div class="card-body">
            <form id="housingForm" action="{{ route('housing.store') }}" method="POST">
                @csrf

                <!-- Display Validation Errors -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ol>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ol>
                    </div>
                @endif

                <!-- Housing Name -->
                <div class="mb-3">
                    <label for="housingName" class="form-label">Housing Name</label>
                    <input id="housingName" class="form-control" type="text" name="name" required>
                </div>

                <!-- Division Dropdown -->
                <div class="d-flex flex-wrap gap-3 align-items-start">
                    <!-- Division Dropdown -->
                    <div class="form-group">
                        <label for="divisionSelect" class="form-label">Division</label>
                        <select id="divisionSelect" class="form-select" name="division_id" required>
                            <option value="">Select Division</option>
                            @foreach($divisions as $division)
                                <option value="{{ $division->id }}">{{ $division->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- District Dropdown -->
                    <div class="form-group">
                        <label for="districtSelect" class="form-label">District</label>
                        <select id="districtSelect" class="form-select" name="district_id" required>
                            <option value="">Select District</option>
                        </select>
                    </div>

                    <!-- Upazila Dropdown -->
                    <div class="form-group">
                        <label for="upazilaSelect" class="form-label">Upazila</label>
                        <select id="upazilaSelect" class="form-select upazila-select-facilities" name="upazila_id" required>
                            <option value="">Select Upazila</option>
                        </select>
                    </div>
                </div>



                <!-- Upazila Dropdown -->


                <!-- Facility Cards -->
                <div id="facility-cards" class="row">
                    <!-- Dynamically loaded facility cards -->
                </div>
                <!-- Latitude and Longitude -->
                <div class="d-flex flex-wrap gap-3 align-items-start">
                    <!-- Latitude Input -->
                    <div class="form-group">
                        <label for="latitude" class="form-label">Latitude</label>
                        <input id="latitude" type="text" name="latitude" class="form-control" placeholder="Latitude" required>
                    </div>

                    <!-- Longitude Input -->
                    <div class="form-group">
                        <label for="longitude" class="form-label">Longitude</label>
                        <input id="longitude" type="text" name="longitude" class="form-control" placeholder="Longitude" required>
                    </div>
                </div>


                <!-- Google Maps Search Box -->
                <input id="pac-input" class="controls mb-3" type="text" placeholder="Search Box">
                <div id="map" style="height: 500px; width: 100%;"></div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary mt-4">Submit</button>
            </form>
        </div>
    </div>

    <!-- Include External Scripts -->
    <script src="{{ asset('assets/js/ajax-handlers.js') }}"></script>
    <script src="{{ asset('assets/js/google-maps.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyABnAbo9ifTK9aGO-2oBameLdIKPxVKoXI&callback=initAutocomplete&libraries=places" defer></script>
@endsection
