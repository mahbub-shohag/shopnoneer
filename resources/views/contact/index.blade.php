@extends('layouts.app')

@section('title')
    Contact
@endsection

@section('bread_controller')
    <a href="{{ route('contact.index') }}">Contact</a>
@endsection

@section('bread_action')
    Index
@endsection

@section('content')
    <div class="card mb-4 ">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5>Contacts</h5>
            @if ($unreadCount > 0)
                <span class="badge bg-teal">
                    {{ $unreadCount }} Unread Message(s)
                 </span>
            @else
                <span class="badge bg-teal">
            All Read
        </span>
            @endif
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                <tr>
                    <th>SL</th>
                    <th>Email</th>
                    <th>Is Read</th>
                    <th>Action</th>

                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>SL</th>
                    <th>Email</th>
                    <th>Is Read</th>
                    <th>Action</th>

                </tr>
                </tfoot>
                <tbody>
                @foreach ($contacts as $key => $contact)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{$contact->name }}</td>
                        <td>{{$contact->is_read }}</td>
                        <td>
                            <div style="display: flex; align-items: center; justify-content: space-around; width: 50%;">
                                <a href="{{ route('contact.show', ['contact' => $contact]) }}"
                                   class="btn-icon btn-view">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <form action="{{ route('contact.destroy', ['contact' => $contact]) }}" method="POST"
                                      style="margin: 0;">
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
