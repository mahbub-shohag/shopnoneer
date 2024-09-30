@extends('layouts.app')

@section('title')
    Housing
@endsection

@section('bread_controller')
    <a href="index.html">Housing</a>
@endsection

@section('bread_action')
    create
@endsection

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Housing
        </div>

        <div class="card-body">
            <form action="{{route('housing.store')}}" method="POST">
                {{csrf_field()}}
                {{ method_field('POST') }}
                <div class="mb-3">
                    <label class="custom-control-label">Housing Name</label>
                    <input class="form-control" type="text" name="name">
                </div>

                <div class="mb-3">
                    <label class="custom-control-label">District</label>
                    <select class="form-select" name="district_id">
                        @foreach($districts as $district)
                            <option value="{{$district->id}}">{{$district->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="custom-control-label">Upazilla</label>
                    <select class="form-select" name="upazila_id">
                        @foreach($upazillas as $upazilla)
                            <option value="{{$upazilla->id}}">{{$upazilla->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="custom-control-label">City</label>
                    <select class="form-select" name="city_id">
                        @foreach($cities as $city)
                            <option value="{{$city->id}}">{{$city->area}}</option>
                        @endforeach
                    </select>
                </div>

                <button class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
