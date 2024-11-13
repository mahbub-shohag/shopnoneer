@extends('layouts.app')

@section('title')
    Edit Amenity
@endsection

@section('bread_controller')
    <a href="{{ route('amenity.index') }}">Amenity</a>
@endsection

@section('bread_action')
    Edit
@endsection

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Edit Amenity
        </div>

        <div class="card-body">
            <form action="{{ route('amenity.update', $amenity->id) }}" method="POST">
                @csrf
                @method('PUT')

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
                    <label class="custom-control-label">Amenity Name</label>
                    <input class="form-control" type="text" name="name" value="{{$amenity->name}}" placeholder="Enter the amenity name" required>
                </div>

                <div class="mb-3">
                    <label class="custom-control-label">Amenity Icon</label>
                    <input class="form-control icon-picker" type="text" name="icon" value="{{$amenity->icon}}" placeholder="Select an icon" required>
                </div>

                <button class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
