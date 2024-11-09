@extends('layouts.app')

@section('title')
    Category Details
@endsection

@section('bread_controller')
    <a href="{{ route('category.index') }}">Category</a>
@endsection

@section('bread_action')
    Details
@endsection

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-info-circle me-1"></i>
            Category Details
        </div>

        <div class="card-body">
            <table class="table table-bordered">
                <tbody>
                <tr>
                    <th scope="row"><strong>ID</strong></th>
                    <td>{{ $category->id }}</td>
                </tr>

                <tr>
                    <th scope="row"><strong>Category Name</strong></th>
                    <td>{{ $category->label }}</td>
                </tr>

                <tr>
                    <th scope="row"><strong>Parent ID</strong></th>
                    <td>{{ $category->parent_id }}</td>
                </tr>

                <tr>
                    <th scope="row"><strong>Parent Name</strong></th>
                    <td>{{ $category->parent_id ? $category->parent->label : 'None' }}</td>
                </tr>
                </tbody>
            </table>
        </div>

        <div class="card-footer text-end">
            <a href="{{ route('category.index') }}" class="btn btn-primary">Back to Categories</a>
        </div>
    </div>
@endsection
