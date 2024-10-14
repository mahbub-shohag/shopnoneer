@extends('layouts.app')

@section('title', 'Create Role')

@section('bread_controller')
    <a href="{{ route('roles.index') }}" class="text-teal-600 hover:text-teal-800">Roles</a>
@endsection

@section('bread_action', 'Create')

@section('content')

    <div class="auth-card shadow-lg rounded-lg">
        <div class="auth-card-header bg-teal text-white">
            <h4 class="text-center font-semibold">Create a New Role</h4>
        </div>
        <div class="auth-card-body p-4">
            <form method="POST" action="{{ route('roles.store') }}">
                @csrf

                <!-- Role Name Input -->
                <div class="form-group mb-4">
                    <label for="name" class="font-medium text-teal">Role Name</label>
                    <input type="text" id="name" name="name" class="form-control focus:ring-teal-500 focus:border-teal-500 hover:border-teal-400" placeholder="Enter Role Name" required>
                </div>

                <!-- Permissions for Controllers and Methods -->
                <div class="form-group">
                    <h5 class="font-semibold text-teal mb-3">Select Permissions for Controllers and Methods</h5>
                    <div class="row">
                        @php
                            $currentController = null;
                            $UnUsedMethods = [
                                'middleware', 'getMiddleware', 'callAction', '__call',
                                'authorize', 'authorizeForUser', 'parseAbilityAndArguments',
                                'normalizeGuessedAbilityName', 'authorizeResource', 'resourceAbilityMap',
                                'resourceMethodsWithoutModels', 'validateWith', 'validate',
                                'validateWithBag', 'getValidationFactory'
                            ];

                            // Convert $permissions to an array
                            $permissionsArray = $permissions->toArray();

                            $permissionsCount = count($permissionsArray);
                            $columnCount = 3; // Number of columns
                            $permissionsPerColumn = ceil($permissionsCount / $columnCount);

                            // Chunk the permissions into groups for the columns
                            $permissionGroups = array_chunk($permissionsArray, $permissionsPerColumn);
                        @endphp

                        @foreach($permissionGroups as $group)
                            <div class="col-md-4">
                                @foreach($group as $permission)
                                    @if(!in_array($permission['action'], $UnUsedMethods))
                                        <!-- Display controller heading if it changes -->
                                        @if($permission['controller'] != $currentController)
                                            <h3 class="mt-3">{{ $permission['controller'] }}</h3>
                                            @php $currentController = $permission['controller']; @endphp
                                        @endif
                                        <div class="form-check hover-checkbox">
                                            <input class="form-check-input" type="checkbox" name="permissions[]"
                                                   value="{{ $permission['controller'] . '@' . $permission['action'] }}"
                                                   id="permission-{{ $permission['id'] }}">
                                            <label class="form-check-label" for="permission-{{ $permission['id'] }}">
                                                {{ ucfirst($permission['action']) }}
                                            </label>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="text-center mt-5">
                    <button type="submit" class="btn btn-teal px-4 py-2 rounded-md shadow-sm transition duration-300"> <!-- Custom Teal Button -->
                        Submit Role
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection
