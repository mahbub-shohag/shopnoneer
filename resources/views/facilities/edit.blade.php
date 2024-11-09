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

                <div class="mb-3">
                    <label class="custom-control-label">Division</label>
                    <select class="form-select" name="division_id">
                        @foreach($divisions as $division)
                            <option value="{{ $division->id }}" {{ $facility->division_id == $division->id ? 'selected' : '' }}>
                                {{ $division->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="custom-control-label">District</label>
                    <input class="form-control" type="text" name="district_id" value="{{ old('district_id', $facility->district_id) }}">
                </div>

                <div class="mb-3">
                    <label class="custom-control-label">Upazila</label>
                    <input class="form-control" type="text" name="upazila_id" value="{{ old('upazila_id', $facility->upazila_id) }}">
                </div>

                <div class="mb-3">
                    <label class="custom-control-label">Google Map URL</label>
                    <input class="form-control" type="text" name="google_map_url" value="{{ old('google_map_url', $facility->google_map_url) }}">
                </div>

                <button class="btn btn-primary">Update Facility</button>
            </form>
        </div>
    </div>
@endsection
