@extends('layouts.app')

@section('title')
    Edit Category
@endsection

@section('bread_controller')
    <a href="{{ route('category.index') }}">Category</a>
@endsection

@section('bread_action')
    Edit
@endsection

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Edit Category
        </div>

        <div class="card-body">
            <form action="{{ route('category.update', $category->id) }}" method="POST">
                {{ csrf_field() }}
                {{ method_field('PUT') }}

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ol>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ol>
                    </div>
                @endif

                <div class="mb-3">
                    <label class="custom-control-label">Category Type</label>
                    <select class="form-select" name="parent_id">
                        @foreach($category_types as $category_type)
                            <option value="{{ $category_type->id }}" {{ $category->parent_id == $category_type->id ? 'selected' : '' }}>
                                {{ $category_type->label }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="custom-control-label">Category Option</label>
                    <input class="form-select" type="text" name="label" value="{{ old('label', $category->label) }}">
                </div>

                <button class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
