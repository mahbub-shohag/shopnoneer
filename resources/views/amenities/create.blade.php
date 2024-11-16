@extends('layouts.app')

@section('title')
    Amenity
@endsection

@section('bread_controller')
    <a href="index.html">Amenity</a>
@endsection

@section('bread_action')
    create
@endsection

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            New Amenity
        </div>

        <div class="card-body">
            <form action="{{ route('amenity.store') }}" method="POST">
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
                    <label class="custom-control-label">Amenity Name</label>
                    <input class="form-control" type="text" name="name" placeholder="Enter the amenity name" required>
                </div>


                <div class="mb-3">
                    <label class="custom-control-label">App Icon</label>
                    <input class="form-control icon-picker" type="text" name="android_icon" placeholder="Select an icon"
                           required>
                </div>
                <div class="mb-3">
                    <label class="custom-control-label">IOS Icon</label>
                    <input class="form-control icon-picker" type="text" name="ios_icon" placeholder="Select an icon"
                           required>
                </div>
                <div class="mb-3">
                    <label class="custom-control-label">Web Icon</label>
                    <input class="form-control icon-picker" type="text" name="web_icon" placeholder="Select an icon"
                           required>
                </div>
                <button class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
