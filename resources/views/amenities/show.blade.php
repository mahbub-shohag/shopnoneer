@extends('layouts.app')

@section('title')
    Amenity Details
@endsection

@section('bread_controller')
    <a href="{{ route('amenity.index') }}">Amenity</a>
@endsection

@section('bread_action')
    Details
@endsection

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-info-circle me-1"></i>
            Amenity Details
        </div>

        <div class="card-body">
            <table class="table table-bordered">
                <tbody>
                <tr>
                    <th scope="row"><strong>ID</strong></th>
                    <td>{{ $amenity->id }}</td>
                </tr>

                <tr>
                    <th scope="row"><strong>Amenity Name</strong></th>
                    <td>{{ $amenity->name }}</td>
                </tr>

                <tr>
                    <th scope="row"><strong>Amenity Icon</strong></th>
                    <td>{{$amenity->icon }}</td>
                </tr>
                </tbody>
            </table>
        </div>

        <div class="card-footer text-end">
            <a href="{{ route('amenity.index') }}" class="btn btn-primary">Back to Amenities</a>
        </div>
    </div>
@endsection
