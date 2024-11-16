
@extends('layouts.app')

@section('title')
    Category
@endsection

@section('bread_controller')
    <a href="index.html">Category</a>
@endsection

@section('bread_action')
    create
@endsection

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            New Category
        </div>

        <div class="card-body">
            <form action="{{ route('category.store') }}" method="POST">
                {{ csrf_field() }}
                {{ method_field('POST') }}

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
{{--                        <option value="1">Root</option>--}}
                        @foreach($category_types as $category_type)
                            <option value="{{ $category_type->id }}" >{{ $category_type->label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="custom-control-label">Category Option</label>
                    <input class="form-select" type="text" name="label">
                </div>



                <button class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
