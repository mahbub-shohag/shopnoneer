@extends('layouts.app')

@section('title')
    Facility
@endsection

@section('bread_controller')
    <a href="{{ route('facility.index') }}">Facility</a>
@endsection

@section('bread_action')
    Index
@endsection

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Facilities
            <a href="{{ route('facility.create') }}">
                <button class="btn btn-sm btn-primary" style="float: right"><i class="fas fa-plus"></i> Add New</button>
            </a>
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                <tr>
                    <th>SL</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Location</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>SL</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Location</th>
                    <th>Action</th>
                </tr>
                </tfoot>
                <tbody>
                @foreach ($facilities as $key => $facility)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $facility->name }}</td>
                        <td>{{ $facility->category->label ?? 'N/A' }}</td>
                        <td>{{ $facility->division->name ?? 'N/A' }}, {{ $facility->district->name ?? 'N/A' }}, {{ $facility->upazila->name ?? 'N/A' }}</td>
                        <td>
                            <!-- Flex Container for Edit, View, and Delete Actions -->
                            <div style="display: flex; align-items: center; justify-content: space-around; width: 40%;">
                                <!-- Edit Link -->
                                <a href="{{ route('facility.edit', ['facility' => $facility]) }}" class="btn-icon btn-edit">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                <!-- View Link -->
                                <a href="{{ route('facility.show', ['facility' => $facility]) }}" class="btn-icon btn-view">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <!-- Delete Form -->
                                <form action="{{ route('facility.destroy', ['facility' => $facility]) }}" method="POST" style="margin: 0;">
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
