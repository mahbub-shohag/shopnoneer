@extends('layouts.app')

@section('title')
    Roles
@endsection

@section('bread_controller')
    <a href="index.html">Roles</a>
@endsection

@section('bread_action')
    create
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <form method="POST" action="{{route('roles.store')}}">
            @csrf
          <div class="form-group">
            <label >Name</label>
            <input type="text" name="name" class="form-control" placeholder="Enter Role Name">
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>        
    </div>
</div>

@endsection