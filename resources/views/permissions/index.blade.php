@extends('layouts.app')

@section('title', 'Permissions & Create Role')

@section('bread_controller')
    <a href="{{ route('permissions.index') }}">Permissions</a>
@endsection

@section('bread_action', 'Index & Create Role')

@section('content')
    <!-- Permissions Table -->
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Permission
            <a href="{{ route('import') }}" class="mr-5">
                <button class="btn btn-primary btn-sm add-btn"><i class="fas fa-plus"></i> Import Permission</button>
            </a>
        </div>

        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Controller</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Controller</th>
                    <th>Action</th>
                </tr>
                </tfoot>
                <tbody>
                @foreach($permissions as $permission)
                    <tr>
                        <td>{{ $permission->id }}</td>
                        <td>{{ $permission->name }}</td>
                        <td>{{ $permission->controller }}</td>
                        <td>{{ $permission->action }}</td>

                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
