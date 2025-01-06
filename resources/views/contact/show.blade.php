@extends('layouts.app')

@section('title')
    contact Details
@endsection

@section('bread_controller')
    <a href="{{ route('contact.index') }}">contact</a>
@endsection

@section('bread_action')
    Details
@endsection

@section('content')
    <div class="card mb-4">


        <div class="card-header">
            <i class="fas fa-info-circle me-1"></i>
            contact Details
            <a href="{{ route('contact.index') }}" class="btn btn-primary" style="float: right">Back to contact</a>
        </div>

        <div class="card-body">
            <form action="{{ route('contact.update', $contact->id) }}" method="POST">
                @csrf
                @method('PUT')
                <table class="table table-bordered">
                    <tbody>
                    <tr>
                        <th scope="row"><strong>ID</strong></th>
                        <td>{{ $contact->id }}</td>
                    </tr>

                    <tr>
                        <th scope="row"><strong>Name</strong></th>
                        <td>{{ $contact->name }}</td>
                    </tr>

                    <tr>
                        <th scope="row"><strong>Email</strong></th>
                        <td>{{$contact->email }}</td>
                    </tr>

                    <tr>
                        <th scope="row"><strong>Number</strong></th>
                        <td>{{$contact->phone }}</td>
                    </tr>

                    <tr>
                        <th scope="row"><strong>Message</strong></th>
                        <td>{{$contact->message }}</td>
                    </tr>

                    <tr>
                        <th scope="row"><strong>Is Read</strong></th>
                        <td>
                            <select class="form-select icon-picker" name="is_read" required>
                                <option value="1" {{ $contact->is_read == 1 ? 'selected' : '' }}>Yes</option>
                                <option value="0" {{ $contact->is_read == 0 ? 'selected' : '' }}>No</option>
                            </select>
                        </td>

                    </tr>
                    </tbody>
                </table>
                <button class="btn btn-primary right" style="float: right">Update</button>

            </form>
        </div>

    </div>
@endsection

