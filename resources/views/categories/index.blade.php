@extends('layouts.app')

@section('title')
    Category
@endsection

@section('bread_controller')
    <a href="index.html">Category</a>
@endsection

@section('bread_action')
    Index
@endsection

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Categories
            <a href="{{ route('category.create') }}">
                <button class="btn btn-sm btn-primary" style="float: right"><i class="fas fa-plus"></i> Add New</button>
            </a>
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                <tr>
                    <th>SL</th>
                    <th>Label</th>
                    <th>Parent</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>SL</th>
                    <th>Label</th>
                    <th>Parent</th>
                    <th>Action</th>
                </tr>
                </tfoot>
                <tbody>
                @foreach ($categories as $key => $category)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $category->label }}</td>
                        <td>{{ $category->parent?->label ?? 'Root' }}</td>
                        <td>
                            <!-- Flex Container for Edit, View, and Delete Actions -->
                            <div style="display: flex; align-items: center; justify-content: space-around; width: 40%;">
                                <!-- Edit Link -->
                                <a href="{{ route('category.edit', ['category' => $category]) }}" class="btn-icon btn-edit">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                <!-- View Link -->
                                <a href="{{ route('category.show', ['category' => $category]) }}" class="btn-icon btn-view">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <!-- Delete Form -->
                                <form action="{{ route('category.destroy', ['category' => $category]) }}" method="POST" style="margin: 0;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-icon btn-delete" title="Delete">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
