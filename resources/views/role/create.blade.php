@extends('layouts.app')

@section('title', 'Create Role')

@section('bread_controller')
    <a href="{{ route('roles.index') }}" class="text-teal-600 hover:text-teal-800">Roles</a>
@endsection

@section('bread_action', 'Create')

@section('content')

    <!-- Updated Blade Template with Custom CSS Classes -->
    <div class="card shadow-lg rounded-lg">
        <div class="card-header bg-teal text-white"> <!-- Custom Teal Header -->
            <h4 class="text-center font-semibold">Create a New Role</h4>
        </div>
        <div class="card-body p-4">
            <form method="POST" action="{{ route('roles.store') }}">
                @csrf

                <!-- Role Name Input -->
                <div class="form-group mb-4">
                    <label for="name" class="font-medium text-teal">Role Name</label> <!-- Custom Teal Text -->
                    <input type="text" id="name" name="name" class="form-control  focus:ring-teal-500 focus:border-teal-500 hover:border-teal-400" placeholder="Enter Role Name" required>
                </div>

                <!-- Permissions for Controllers and Methods -->
                <div class="form-group">
                    <h5 class="font-semibold text-teal mb-3">Select Permissions for Controllers and Methods</h5>
                    <div class="accordion" id="controllersAccordion">
                        @foreach($controllerData as $controller)
                            @php
                                $controllerName = class_basename($controller['controller']);
                            @endphp

                                    <!-- Each Controller Accordion Item -->
                            <div class="accordion-item mb-3">
                                <h2 class="accordion-header" id="heading{{ $loop->index }}">
                                    <button  class=" accordion-button bg-light-teal text-white hover:bg-dark-teal" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $loop->index }}" aria-expanded="false" aria-controls="collapse{{ $loop->index }}">
                                        {{ $controllerName }}
                                    </button>
                                </h2>
                                <div id="collapse{{ $loop->index }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $loop->index }}" data-bs-parent="#controllersAccordion">
                                    <div class="accordion-body bg-gray-50 p-3">
                                        <ul class="list-group">
                                            @foreach(array_unique($controller['methods']) as $method)
                                                @if(!in_array($method, [
                                                    'middleware', 'getMiddleware', 'callAction', '__call',
                                                    'authorize', 'authorizeForUser', 'parseAbilityAndArguments',
                                                    'normalizeGuessedAbilityName', 'authorizeResource', 'resourceAbilityMap',
                                                    'resourceMethodsWithoutModels', 'validateWith', 'validate',
                                                    'validateWithBag', 'getValidationFactory'
                                                ]) || str_contains($method, 'custom'))
                                                    <li class="list-group-item d-flex justify-content-between align-items-center hover:bg-teal-50">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="permissions[]" value="{{ $controllerName . '@' . $method }}" id="{{ $controllerName . '@' . $method }}" class="form-check-input">
                                                            <label for="{{ $controllerName . '@' . $method }}" class="form-check-label">
                                                                {{ ucfirst($method) }}
                                                            </label>
                                                        </div>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
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
