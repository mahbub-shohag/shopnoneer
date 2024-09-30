@extends('layouts.web')
@section('content')

    @foreach($projects as $project)
        <div class="card mb-4">
            <div class="card-body">

                <div class="row">
                    <div class="col-md-4">
                        <div style="background: #0d6efd;height: 100%"></div>
                    </div>
                    <div class="col-md-8">
                        <h1 style="color: #0f5132">{{$project->title}}</h1>
                        <p><i class="fa fa-map-marker" aria-hidden="true" style="color: red"></i> {{$project->housing->name}}, {{$project->upazila->name}}</p>
                        <p>{{$project->description}}</p>
                        <div class="row">
                            <div class="col-md-2">
                                <p>{{$project->total_price}}</p>
                            </div>
                            <div class="col-md-4"></div>
                            <div class="col-md-6">
                                <i class="fa fa-bed"></i>  {{$project->no_of_beds}}      <i class="fa fa-bath"></i>  {{$project->no_of_baths}}  <i class="fa fa-floor"></i>  {{$project->floor_area}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
