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
                    <button class="nav-link" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-address" type="button" role="tab" aria-controls="nav-address" aria-selected="true">Address</button>
                    <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Preference</button>
                    <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Planning</button>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">

                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <form action="{{route('profiles.update',$profile->id)}}" method="POST">
                        {{csrf_field()}}
                        {{ method_field('PUT') }}
                        <div class="mb-3">
                            <label class="custom-control-label">Name</label>
                            <input class="form-control" type="text" name="fullName" value="{{ $profile->fullName }}">
                        </div>

                        <div class="mb-3">
                            <label class="custom-control-label">Age</label>
                            <input class="form-control" type="number" name="age" value="{{ $profile->age }}">
                        </div>

                        <div class="mb-3">
                            <label class="custom-control-label">Religion</label>
                            <select class="form-select" name="religion">
                                @foreach($religions as $religion)
                                    <option @if($profile->religion==$religion) selected @endif>{{$religion}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="custom-control-label">Occupation</label>
                            <select class="form-select" name="occupation">
                                @foreach($occupations as $occupation)
                                    <option @if($profile->occupation==$occupation) selected @endif>{{$occupation}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="custom-control-label">Education</label>
                            <select class="form-select" name="education">
                                @foreach($educations as $education)
                                    <option @if($profile->education==$education) selected @endif>{{$education}}</option>
                                @endforeach
                            </select>
                        </div>
                        <button class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <div class="tab-pane fade show" id="nav-address" role="tabpanel" aria-labelledby="nav-address-tab">
                    <form action="{{route('profiles.update',$profile->id)}}" method="POST">
                        {{csrf_field()}}
                        {{ method_field('PUT') }}
                        <div class="mb-3">
                            <label class="custom-control-label">Present Division</label>
                            <select class="form-select" name="presentDivision">
                                @foreach($divisions as $division)
                                    <option @if($profile->presentDivision==$division->name) selected @endif>{{$division->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="custom-control-label">Present District</label>
                            <select class="form-select" name="presentDistrict">
                                @foreach($districts as $district)
                                    <option @if($profile->presentDistrict==$district->name) selected @endif>{{$district->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="custom-control-label">Present Upazila</label>
                            <select class="form-select" name="presentUpazilla">
                                @foreach($upazillas as $upazilla)
                                    <option @if($profile->presentUpazilla==$upazilla->name) selected @endif>{{$upazilla->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="custom-control-label">Present City</label>
                            <select class="form-select" name="presentCity">
                                @foreach($cities as $city)
                                    <option @if($profile->presentCity==$city->area) selected @endif>{{$city->area}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="custom-control-label">Permanent Division</label>
                            <select class="form-select" name="permanentDivision">
                                @foreach($divisions as $division)
                                    <option @if($profile->permanentDivision==$division->name) selected @endif>{{$division->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="custom-control-label">Permanent District</label>
                            <select class="form-select" name="permanentDistrict">
                                @foreach($districts as $district)
                                    <option @if($profile->permanentDistrict==$district->name) selected @endif>{{$district->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="custom-control-label">Permanent Upazila</label>
                            <select class="form-select" name="permanentUpazilla">
                                @foreach($upazillas as $upazilla)
                                    <option @if($profile->permanentUpazilla==$upazilla->name) selected @endif>{{$upazilla->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="custom-control-label">Permanent City</label>
                            <select class="form-select" name="permanentCity">
                                @foreach($cities as $city)
                                    <option @if($profile->permanentCity==$city->area) selected @endif>{{$city->area}}</option>
                                @endforeach
                            </select>
                        </div>

                        <button class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                    <form action="{{route('profiles.update',$profile->id)}}" method="POST">
                        {{csrf_field()}}
                        {{ method_field('PUT') }}
                        <div class="mb-3">
                            <label class="custom-control-label">Preferable Division</label>
                            <select class="form-select" name="preferableDivision">
                                @foreach($divisions as $division)
                                    <option @if($profile->preferableDivision==$division->name) selected @endif>{{$division->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="custom-control-label">Preferable District</label>
                            <select class="form-select" name="preferableDistrict">
                                @foreach($districts as $district)
                                    <option @if($profile->preferableDistrict==$district->name) selected @endif>{{$district->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="custom-control-label">Preferable Upazilla</label>
                            <select class="form-select" name="preferableUpazilla">
                                @foreach($upazillas as $upazilla)
                                    <option @if($profile->preferableUpazilla==$upazilla->name) selected @endif>{{$upazilla->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="custom-control-label">Preferable City</label>
                            <select class="form-select" name="preferableCity">
                                @foreach($cities as $city)
                                    <option @if($profile->preferableCity==$city->area) selected @endif>{{$city->area}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="custom-control-label">Preferable Flat Size (sqft)</label>
                            <input type="number" name="preferableFlatSize" value="{{$profile->preferableFlatSize}}" class="form-control">
                        </div>
                        <button class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                    <form action="{{route('profiles.update',$profile->id)}}" method="POST">
                        {{csrf_field()}}
                        {{ method_field('PUT') }}
                        <div class="mb-3">
                            <label class="custom-control-label">Estimated Budget</label>
                            <input type="number" name="estimatedBudget" value="{{$profile->estimatedBudget}}" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="custom-control-label">Current Capital</label>
                            <input type="number" name="currentCapital" value="{{$profile->currentCapital}}" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="custom-control-label">Family Members</label>
                            <input type="number" name="totalFamilyMembers" value="{{$profile->totalFamilyMembers}}" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="custom-control-label">Source of Income</label>
                            <select class="form-select" name="sourceOfIncome">
                                @foreach($sourceOfIncomes as $sourceOfIncome)
                                    <option @if($profile->sourceOfIncome==$sourceOfIncome) selected @endif>{{$sourceOfIncome}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="custom-control-label">Monthly Income</label>
                            <input type="number" name="monthlyIncome" value="{{$profile->monthlyIncome}}" class="form-control">
                        </div>
                        <button class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
