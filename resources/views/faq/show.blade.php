@extends('layouts.app')

@section('title')
    faq Details
@endsection

@section('bread_controller')
    <a href="{{ route('faq.index') }}">faq</a>
@endsection

@section('bread_action')
    Details
@endsection

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-info-circle me-1"></i>
            faq Details
        </div>

        <div class="card-body">
            <table class="table table-bordered">
                <tbody>
                <tr>
                    <th scope="row"><strong>ID</strong></th>
                    <td>{{ $faq->id }}</td>
                </tr>

                <tr>
                    <th scope="row"><strong>Faq question</strong></th>
                    <td>{{ $faq->question }}</td>
                </tr>

                <tr>
                    <th scope="row"><strong>Faq answer</strong></th>
                    <td>{{$faq->answer }}</td>
                </tr>

                <tr>
                    <th scope="row"><strong>Faq active</strong></th>
                    <td>{{$faq->active }}</td>
                </tr>
                </tbody>
            </table>
        </div>

        <div class="card-footer text-end">
            <a href="{{ route('faq.index') }}" class="btn btn-primary">Back to faqs</a>
        </div>
    </div>
@endsection

