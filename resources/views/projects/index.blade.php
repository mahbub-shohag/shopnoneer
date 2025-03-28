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
            <a href="project/create">
                <button class="btn btn-sm btn-primary" style="float: right"><i class="fas fa-plus"></i> Add New</button>
            </a>
            Project
        </div>

        <div class="card-body">
            <table id="datatablesSimple" class="table table-bordered">
                <thead>
                <tr>
                    <th>SL</th>
                    <th>Title</th>
                    <th>District</th>
                    <th>Upazila</th>
                    <th>Housing</th>
                    <th>Image</th>
                    <th>Action</th>
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
                        <td>
                            @foreach($project->getMedia('project_image') as $image)
                                <img style="width: auto;height: 20px" src="{{$image->getUrl()}}" alt="Image"/>
                            @endforeach
                        </td>
                        <td>
                            <div style="display: flex; align-items: center; justify-content: space-around;">
                                <a href="{{ route('project.edit', ['project' => $project]) }}" class="btn-icon btn-edit">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                <a href="{{ route('project.show', ['project' => $project]) }}" class="btn-icon btn-view">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <form action="{{ route('project.destroy', ['project' => $project]) }}" method="POST" style="margin: 0;">
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



