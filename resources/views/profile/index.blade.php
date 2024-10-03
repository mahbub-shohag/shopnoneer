@extends('layouts.app')

@section('title')
    Profile
@endsection

@section('bread_controller')
    <a href="index.html">Profile</a>
@endsection

@section('bread_action')
    index
@endsection

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Profile
        </div>
        <div class="card-body">
            <!-- Tabs navs -->
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Personal</button>
                    <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Preference</button>
                    <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Planning</button>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">

                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <form action="{{route('profiles.update',$profile->id)}}" method="POST">
                        {{csrf_field()}}
                        {!! @method('PUT') !!}
                        <label class="custom-control-label">Name</label>
                        <input class="form-control" type="text" name="name">
                        <button class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                    <form>

                    </form>
                </div>

                <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                    <form>

                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
