@extends('layouts.app')

@section('title')
    Housing
@endsection

@section('bread_controller')
    <a href="index.html">Housing</a>
@endsection

@section('bread_action')
    Edit
@endsection

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Edit Housing
        </div>

        <div class="card-body">
            <form action="{{ route('housing.update', $housing->id) }}" method="POST">
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
                    <label class="custom-control-label">Housing Name</label>
                    <input class="form-control" type="text" name="name" value="{{ old('name', $housing->name) }}">
                </div>


                <div class="d-flex flex-wrap gap-3 align-items-start">
                    <div class="form-group">
                        <label for="divisionSelect" class="form-label">Division</label>
                        <select id="divisionSelect" class="form-select" name="division_id" required>
                            <option value="">Select Division</option>
                            @foreach($divisions as $division)
                                <option value="{{ $division->id }}">{{ $division->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">District</label>
                        <select class="form-select" name="district_id" id="districtSelect">
                            <option value="">Select District</option>
                            @foreach($districts as $district)
                                <option value="{{ $district->id }}" @if($district->id == $housing->district_id) selected @endif>
                                    {{ $district->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Upazila</label>
                        <select class="form-select" name="upazila_id" id="upazilaSelect">
                            <option value="">Select Upazila</option>
                            @foreach($upazillas as $upazila)
                                <option value="{{ $upazila->id }}" @if($upazila->id == $housing->upazila_id) selected @endif>
                                    {{ $upazila->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>


                <!-- Facilities Cards -->
                <div id="facility-cards" class="row">
                    @foreach ($groupedFacilities as $categoryId => $facilities)
                        <div class="col-md-6 mb-4">
                            <div class="card">
                                <div class="card-header bg-teal text-white">
                                    {{ $facilities[0]->category->label }}
                                </div>
                                <div class="card-body">
                                    @foreach ($facilities as $facility)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox"
                                                   name="facilities[{{ $facility->id }}]"
                                                   value="{{ $facility->id }}"
                                                   @if(in_array($facility->id, $selectedFacilities)) checked @endif>
                                            <label class="form-check-label">
                                                {{ $facility->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mb-3 d-flex">
                    <div class="input-group mb-3 d-flex align-items-center">
                        <input value="{{ $housing->latitude }}" type="text" id="latitude" name="latitude" class="form-control flex-grow-1" placeholder="Latitude" aria-label="Latitude" aria-describedby="latitude-addon">
                        <span style="margin-right:50px " class="input-group-text" id="latitude-addon">°</span>
                    </div>

                    <div class="input-group mb-3 d-flex align-items-center">
                        <input value="{{ $housing->longitude }}" type="text" id="longitude" name="longitude" class="form-control flex-grow-1" placeholder="Longitude" aria-label="Longitude" aria-describedby="longitude-addon">
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
                <!-- Passing data-latitude and data-longitude -->
                <div id="map" style="height: 500px; width: 100%;"
                     data-latitude="{{ $housing->latitude }}"
                     data-longitude="{{ $housing->longitude }}">
                </div>
                <button class="btn btn-primary mt-4">Submit</button>
            </form>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('assets/js/ajax-handlers.js') }}"></script>
    <script src="{{ asset('assets/js/google-maps.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyABnAbo9ifTK9aGO-2oBameLdIKPxVKoXI&callback=initAutocomplete&libraries=places" defer></script>
@endsection
