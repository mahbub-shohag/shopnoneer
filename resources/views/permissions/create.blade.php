@extends('layouts.app')

@section('title')
    Permissions
@endsection

@section('bread_controller')
    <a href="index.html">Permissions</a>
@endsection

@section('bread_action')
    create
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{route('permissions.store')}}">
                @csrf
                <div class="form-group">
                    <label >Controller</label>
                    <input type="text" name="controller" class="form-control" placeholder="Enter Controller Name">
                </div>
                <div class="form-group">
                    <label >Action</label>
                    <input type="text" name="action" class="form-control" placeholder="Enter Action Name">
                </div>
                <div class="form-group">
                    <label >Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Enter Name">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

@endsection
