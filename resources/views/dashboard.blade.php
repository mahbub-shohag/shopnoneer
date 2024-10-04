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
                <div class="card-header">Total Users</div>
                <div class="card-body ">
                    143
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-dark-teal mb-3 dash_board_card">
                <div class="card-header">Total Properties</div>
                <div class="card-body">
                    462
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-light-teal mb-3 dash_board_card">
                <div class="card-header">Total Groups</div>
                <div class="card-body">
                    56
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-danger mb-3 dash_board_card">
                <div class="card-header">Total Housing Covered</div>
                <div class="card-body">
                    15
                </div>
            </div>
        </div>
    </div>
@endsection
