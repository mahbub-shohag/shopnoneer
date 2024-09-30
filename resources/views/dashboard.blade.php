@extends('layouts.app')

@section('title')
    Dashboard
@endsection

@section('bread_controller')
    <a href="#">Dashboard</a>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="card text-white bg-info mb-3">
                <div class="card-header">Total User</div>
                <div class="card-body bg-blue-700">
                    143
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-header">Total Properties</div>
                <div class="card-body">
                    462
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-warning mb-3">
                <div class="card-header">Total Group</div>
                <div class="card-body">
                    56
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-danger mb-3">
                <div class="card-header">Total Housing Covered</div>
                <div class="card-body">
                    15
                </div>
            </div>
        </div>
    </div>

@endsection
