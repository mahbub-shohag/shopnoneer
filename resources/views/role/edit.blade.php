@extends('layouts.app')

@section('title')
    Edit Role
@endsection

@section('bread_controller')
    <a href="{{ route('roles.index') }}">Roles</a>
@endsection

@section('bread_action')
    Edit
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('roles.update', $role->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Role Name Input -->
                <div class="form-group">
                    <label for="roleName">Role Name</label>
                    <input type="text" id="roleName" name="name"
                           value="{{ old('name', $role->name) }}"
                           class="form-control"
                           placeholder="Enter Role Name"
                           required>
                </div>

                <!-- Permissions Checkboxes -->
                <div class="row mt-4">
                    @php
                        $currentController = null;
                        $UnUsedMethods = [
                            'middleware', 'getMiddleware', 'callAction', '__call',
                            'authorize', 'authorizeForUser', 'parseAbilityAndArguments',
                            'normalizeGuessedAbilityName', 'authorizeResource',
                            'resourceAbilityMap', 'resourceMethodsWithoutModels',
                            'validateWith', 'validate', 'validateWithBag',
                            'getValidationFactory'
                        ];
                        $permissionsCount = count($permissions);
                        $columnCount = 3; // Number of columns
                        $permissionsPerColumn = ceil($permissionsCount / $columnCount);
                        $permissionGroups = array_chunk($permissions->toArray(), $permissionsPerColumn);
                    @endphp

                    @foreach($permissionGroups as $group)
                        <div class="col-md-4">
                            @foreach($group as $permission)
                                @if(!in_array($permission['action'], $UnUsedMethods))
                                    <!-- Display controller heading if it changes -->
                                    @if($permission['controller'] != $currentController)
                                        <h3 class="mt-3">{{ $permission['controller'] }}</h3>
                                        @php
                                            $currentController = $permission['controller'];
                                        @endphp
                                    @endif

                                    <!-- Permission Action Checkbox -->
                                    <div class="form-check hover-checkbox">
                                        <input class="form-check-input" type="checkbox" name="permissions[]"
                                               value="{{ $permission['controller'] . '@' . $permission['action'] }}"
                                               {{ in_array($permission['controller'] . '@' . $permission['action'], $rolePermissions) ? 'checked' : '' }}
                                               id="permission-{{ $permission['id'] }}">
                                        <label class="form-check-label" for="permission-{{ $permission['id'] }}">
                                            {{ $permission['action'] }}
                                        </label>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endforeach
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary mt-3">Update Role</button>
            </form>
        </div>
    </div>
@endsection
