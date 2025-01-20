@extends('layouts.app')

@section('title')
    FAQ
@endsection

@section('bread_controller')
    <a href="{{ route('faq.index') }}">FAQ</a>
@endsection

@section('bread_action')
    Index
@endsection

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Amenities
            <a href="{{ route('faq.create') }}">
                <button class="btn btn-sm btn-primary" style="float: right"><i class="fas fa-plus"></i> Add New</button>
            </a>
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                <tr>
                    <th>SL</th>
                    <th>FAQ question</th>
                    <th>Active</th>
                    <th>Action</th>
                    
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>SL</th>
                    <th>FAQ question</th>
                    <th>Active</th>
                    <th>Action</th>

                </tr>
                </tfoot>
                <tbody>
                @foreach ($faqs as $key => $faq)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{$faq->question }}</td>
                        <td>{{$faq->active }}</td>
                        <td>
                            <div style="display: flex; align-items: center; justify-content: space-around; width: auto;">
                                <a href="{{ route('faq.edit', ['faq' => $faq]) }}"
                                   class="btn-icon btn-edit">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                <a href="{{ route('faq.show', ['faq' => $faq]) }}"
                                   class="btn-icon btn-view">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <form action="{{ route('faq.destroy', ['faq' => $faq]) }}" method="POST" style="margin: 0;">
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
