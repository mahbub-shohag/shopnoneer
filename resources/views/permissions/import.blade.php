@extends('layouts.app')

@section('title', 'Permissions & Create Role')

@section('bread_controller')

@endsection

@section('bread_action', 'Index & Create Role')

@section('content')
    <!-- Permissions Table -->
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Permission Management
            <form action="{{ route('permission_import') }}" method="GET" style="display: inline;">
                <button type="submit" class="btn btn-primary btn-sm add-btn">
                    <i class="fas fa-plus"></i> Import All Permission
                </button>
            </form>

        </div>

        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Controller</th>
                    <th>Method</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Controller</th>
                    <th>Method</th>
                </tr>
                </tfoot>
                <tbody>
                @php
                    // Define typical CRUD operations
                    $crudMethods = [
                                         'middleware',
                                         'getMiddleware',
                                         'callAction',
                                         '__call',
                                         'authorize',
                                         'authorizeForUser',
                                         'parseAbilityAndArguments',
                                         'normalizeGuessedAbilityName',
                                         'authorizeResource',
                                         'resourceAbilityMap',
                                         'resourceMethodsWithoutModels',
                                         'validateWith',
                                         'validate',
                                         'validateWithBag',
                                         'getValidationFactory'
                                    ];

                @endphp

                @foreach($controllerData as $controller)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td> <!-- Generate a unique ID using the loop index -->
                        <td>{{ $controllerName = class_basename($controller['controller']) }}</td> <!-- Display controller name -->
                        <td>
                            @php
                                // Filter the controller methods to only show CRUD operations
                                $crudControllerMethods = array_filter($controller['methods'], function($method) use ($crudMethods) {
                                    return !in_array($method, $crudMethods);
                                });
                            @endphp
                            {{ implode(', ', $crudControllerMethods) }} <!-- Show only CRUD methods separated by commas -->
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection
