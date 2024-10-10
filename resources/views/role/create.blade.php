@extends('layouts.app')

@section('title', 'Create Role')

@section('bread_controller')
    <a href="{{ route('roles.index') }}">Roles</a>
@endsection

@section('bread_action', 'Create')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Create a New Role</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('roles.store') }}">
                @csrf

                <!-- Role Name Input -->
                <div class="form-group">
                    <label for="name">Role Name</label>
                    <input type="text" id="name" name="name" class="form-control" placeholder="Enter Role Name" required>
                </div>

                <!-- Displaying Controllers and Methods with Checkboxes -->
                <div class="form-group mt-4">
                    <h5>Select Permissions for Controllers and Methods</h5>
                    <div class="accordion" id="controllersAccordion">
                        @foreach($controllerData as $controller)
                            @php
                                // Extract the controller name without the full namespace
                                $controllerName = class_basename($controller['controller']);
                            @endphp

                                    <!-- Each Controller Accordion Item -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading{{ $loop->index }}">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $loop->index }}" aria-expanded="false" aria-controls="collapse{{ $loop->index }}">
                                        {{ $controllerName }}
                                    </button>
                                </h2>
                                <div id="collapse{{ $loop->index }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $loop->index }}" data-bs-parent="#controllersAccordion">
                                    <div class="accordion-body">
                                        <ul class="list-group">
                                            @foreach(array_unique($controller['methods']) as $method)
                                                <!-- Show only CRUD and custom methods -->
                                                @if(!in_array($method,  [
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
                                                                        ]) || str_contains($method, 'custom'))
                                                    <li class="list-group-item">
                                                        <input type="checkbox" name="permissions[]" value="{{ $controllerName . '@' . $method }}" id="{{ $controllerName . '@' . $method }}">
                                                        <label for="{{ $controllerName . '@' . $method }}">{{ $method }}</label>
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
                <button type="submit" class="btn btn-primary mt-3">Submit</button>
            </form>
        </div>
    </div>
@endsection
