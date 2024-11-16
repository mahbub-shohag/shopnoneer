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
                    <label class="form-label">Housing Name</label>
                    <input class="form-select" type="text" name="name" value="{{$housing->name }}">
                </div>
                <div class="d-flex flex-wrap gap-3 mb-4 align-items-start">
                    <div class="form-group">
                        <label for="divisionSelect" class="form-label">Division</label>
                        <select id="divisionSelect" class="form-select" name="division_id" required>
                            <option value="">Select Division</option>
                            @foreach($divisions as $division)
                                <option value="{{ $division->id }}" @if($division->id == $housing->division_id) selected @endif>
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
                                <option value="{{ $district->id }}" @if($district->id == $housing->district_id) selected @endif>
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
                <div class="d-flex flex-wrap gap-3 align-items-start">
                    <div class="form-group">
                        <label for="latitude" class="form-label">Latitude</label>
                        <input value="{{ $housing->latitude }}" id="latitude" type="text" name="latitude" class="form-select" placeholder="Latitude" required>
                    </div>
                    <div class="form-group">
                        <label for="longitude" class="form-label">Longitude</label>
                        <input value="{{ $housing->longitude }}"  id="longitude" type="text" name="longitude" class="form-select" placeholder="Longitude" required>
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
