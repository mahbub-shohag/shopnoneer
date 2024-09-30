@extends('layouts.app')

@section('title')
    Roles
@endsection

@section('bread_controller')
    <a href="index.html">Roles</a>
@endsection

@section('bread_action')
    edit
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <h5>{{ $role->name }}</h5>
            <h6>Permissions</h6>
            <?php
            $controller = "";
            ?>
            @foreach($role->permissions as $permissionRole)
                @if($permissionRole->permission->controller!=$controller)
                        <?php $controller = $permissionRole->permission->controller;?>
                    <h3>{{$permissionRole->permission->controller}}</h3>
                @endif

                <input type="checkbox" checked> {{$permissionRole->permission->name}}
            @endforeach
        </div>
    </div>

@endsection
