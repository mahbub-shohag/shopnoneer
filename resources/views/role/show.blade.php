@extends('layouts.app')

@section('title')
    Roles
@endsection

@section('bread_controller')
    <a href="{{ route('roles.index') }}" class="text-decoration-none">Roles</a>
@endsection

@section('bread_action')
    Edit
@endsection

@section('content')
    <div class="card mb-4">
        <div class="card-body">
            <h4 class="card-title text-teal"> {{ ucfirst($role->name) }}</h4>
            <h6 class="card-subtitle mb-4 text-muted">Permissions</h6>
            <div class="list-group">
                <?php $controller = ""; ?>
                @foreach($role->permissions as $permissionRole)
                    @if($permissionRole->permission->controller != $controller)
                            <?php $controller = $permissionRole->permission->controller; ?>

                        <h3 style="width: 15%" class="list-group-item list-group-item-action bg-light-teal inline-header text-white  mt-5">
                            {{ $permissionRole->permission->controller }}
                        </h3>
                    @endif

                    <div class="list-group-item d-flex justify-content-between align-items-center hover-item">
                        <span class="text-dark">{{ $permissionRole->permission->action }}</span>
                        <span class="badge bg-teal text-white">{{ $permissionRole->permission->action }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
