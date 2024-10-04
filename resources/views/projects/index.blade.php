@extends('layouts.app')

@section('title')
    Projects
@endsection

@section('bread_controller')
    <a href="index.html">Project</a>
@endsection

@section('bread_action')
    index
@endsection

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Project
        </div>

        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>SL</th>
                    <th>Title</th>
                    <th>District</th>
                    <th>Upazila</th>
                    <th>Housing</th>
                </tr>
                </thead>
                <tbody>
                @foreach($projects as $project)
                    <tr>
                        <td>{{$loop->index+1}}</td>
                        <td>{{$project->title}}</td>
                        <td>{{$project->district->name}}</td>
                        <td>{{$project->upazila->name}}</td>
                        <td>{{$project->housing->name}}</td>

                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection
