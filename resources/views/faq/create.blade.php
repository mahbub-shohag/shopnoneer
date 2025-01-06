@extends('layouts.app')

@section('title')
    Faq
@endsection

@section('bread_controller')
    <a href="index.html">Faq</a>
@endsection

@section('bread_action')
    create
@endsection

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            New Faq
        </div>

        <div class="card-body">
            <form action="{{ route('faq.store') }}" method="POST">
                {{ csrf_field() }}
                {{ method_field('POST') }}

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
                    <label class="custom-control-label">Faq Question</label>
                    <input class="form-select" type="text" name="question" placeholder="Enter the Faq Question"
                           required>
                </div>


                <div class="mb-3">
                    <label class="custom-control-label">Faq Answer</label>
                    <textarea class="form-select" type="text" name="answer" placeholder="Enter the Faq Answer"
                              required rows="4"></textarea>
                </div>

                <div class="mb-3">
                    <label class="custom-control-label">Faq Active</label>
                    <input class="form-select" type="number" name="active" value="1"
                           placeholder="Active or Inactive" required min="0" max="1" step="1">
                </div>
                <button class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
