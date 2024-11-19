@extends('layouts.app')

@section('title')
    Amenity
@endsection

@section('bread_controller')
    <a href="{{ route('amenity.index') }}">Amenity</a>
@endsection

@section('bread_action')
    Index
@endsection

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Amenities
            <a href="{{ route('amenity.create') }}">
                <button class="btn btn-sm btn-primary" style="float: right"><i class="fas fa-plus"></i> Add New</button>
            </a>
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                <tr>
                    <th>SL</th>
                    <th>Amenity Name</th>
                    <th>Amenity app</th>
                    <th>Amenity ios</th>
                    <th>Amenity web</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>SL</th>
                    <th>Amenity Name</th>
                    <th>Amenity app</th>
                    <th>Amenity ios</th>
                    <th>Amenity web</th>
                    <th>Action</th>
                </tr>
                </tfoot>
                <tbody>
                @foreach ($amenities as $key => $amenity)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{$amenity->name }}</td>
                        <td>{{$amenity->android_icon }}</td>
                        <td>{{$amenity->ios_icon }}</td>
                        <td>{{$amenity->web_icon }}</td>
                        <td>
                            <div style="display: flex; align-items: center; justify-content: space-around; width: auto;">
                                <a href="{{ route('amenity.edit', ['amenity' => $amenity]) }}"
                                   class="btn-icon btn-edit">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                <a href="{{ route('amenity.show', ['amenity' => $amenity]) }}"
                                   class="btn-icon btn-view">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <form action="{{ route('amenity.destroy', ['amenity' => $amenity]) }}" method="POST" style="margin: 0;">
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
