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
    <meta name="csrf-token" content="{{ csrf_token() }}">
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

                <div class="d-flex flex-wrap gap-3 mb-4 align-items-start">
                    <div class="form-group">
                        <label for="divisionSelect" class="form-label">Division</label>
                        <select id="divisionSelect" class="form-select" name="division_id" required>
                            <option value="">Select Division</option>
                            @foreach($divisions as $division)
                                <option value="{{ $division->id }}" @if($division->id == $facility->division_id) selected @endif>
                                    {{ $division->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="districtSelect" class="form-label">District</label>
                        <select id="districtSelect" class="form-select" name="district_id" required>
                            <option value="">Select District</option>
                            @foreach($districts as $district)
                                <option value="{{ $district->id }}" @if($district->id == $facility->district_id) selected @endif>
                                    {{ $district->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="upazilaSelect" class="form-label">Upazila</label>
                        <select id="upazilaSelect" class="form-select upazila-select-housing" name="upazila_id" required>
                            <option value="">Select Upazila</option>
                            @foreach($upazilas as $upazila)
                                <option value="{{ $upazila->id }}" @if($upazila->id == $facility->upazila_id) selected @endif>
                                    {{ $upazila->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="d-flex flex-wrap gap-3 align-items-start">
                    <div class="form-group">
                        <label for="latitude" class="form-label">Latitude</label>
                        <input value="{{ $facility->latitude }}" id="latitude" type="text" name="latitude" class="form-control" placeholder="Latitude" required>
                    </div>
                    <div class="form-group">
                        <label for="longitude" class="form-label">Longitude</label>
                        <input value="{{ $facility->longitude }}"  id="longitude" type="text" name="longitude" class="form-control" placeholder="Longitude" required>
                    </div>
                </div>


                <input
                        style="margin-bottom: 30px;margin-top: 10px;width: 15%"
                        id="pac-input"
                        class="controls"
                        type="text"
                        placeholder="Search Box"
                />
                <div id="map" style="height: 500px; width: 100%;"
                     data-latitude="{{ $facility->latitude }}"
                     data-longitude="{{ $facility->longitude }}">
                </div>
                <button class="btn btn-primary mt-4">Update Facility</button>
            </form>
        </div>
    </div>
    <script src="{{ asset('assets/js/ajax-handlers.js') }}"></script>
    <script src="{{ asset('assets/js/google-maps.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyABnAbo9ifTK9aGO-2oBameLdIKPxVKoXI&callback=initAutocomplete&libraries=places" defer></script>


@endsection
