@extends('layouts.app', ['customStyles' => 'assets/css/custom-styles.css'])

@section('title')
    Dashboard
@endsection

@section('bread_controller')
    <a href="#">Dashboard</a>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="card text-white bg-teal mb-3 dash_board_card">
                <div class="card-header">Total Facility</div>
                <div class="card-header">
                    {{ $totalFacility }}
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-dark-teal mb-3 dash_board_card">
                <div class="card-header">
                    Total Project
                </div>
                <div class="card-header">
                    {{ $totalProject }}
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-light-teal mb-3 dash_board_card">
                <div class="card-header">Total Amenity</div>
                <div class="card-header">
                    {{ $totalAmenity }}
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-danger mb-3 dash_board_card">
                <div class="card-header">Total Housing Covered</div>
                <div class="card-header">
                    {{ $totalHousingCovered }}
                </div>
            </div>
        </div>
    </div>
@endsection
