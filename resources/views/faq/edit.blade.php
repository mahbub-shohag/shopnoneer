@extends('layouts.app')

@section('title')
    Edit Faq
@endsection

@section('bread_controller')
    <a href="{{ route('faq.index') }}">Faq</a>
@endsection

@section('bread_action')
    Edit
@endsection

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Edit Faq
        </div>

        <div class="card-body">
            <form action="{{ route('faq.update', $faq->id) }}" method="POST">
                @csrf
                @method('PUT')

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
                    <label class="custom-control-label">Faq question</label>
                    <input class="form-select" type="text" name="question" value="{{$faq->question}}"
                           placeholder="Update the question name" required>
                </div>

                <div class="mb-3">
                    <label class="custom-control-label">Faq answer</label>
                    <textarea class="form-select icon-picker" type="text" name="answer"
                              required rows="4" placeholder="Update the Answer name" required>{{$faq->answer}}
                    </textarea>
                </div>

                <div class="mb-3">
                    <label class="custom-control-label">Faq active</label>
                    <input class="form-select icon-picker" type="number" name="active" value="{{$faq->active}}"
                           placeholder="Active or Inactive" required min="0" max="1" step="1">

                </div>

                <button class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
