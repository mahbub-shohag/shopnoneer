@extends('layouts.app')

@section('title')
    Profile
@endsection

@section('bread_controller')
    <a href="index.html">Profile</a>
@endsection

@section('bread_action')
    list
@endsection

@section('content')
    <div class="row">
    @foreach($profiles as $profile)
                <div class="col-md-4">
                    <table class="table table-bordered">
                        <tbody>
                        <tr>
                            <td colspan="2" class="text-center" style="background: #d2e6ff;color: #0d6efd;font-weight: 500;">

                                <a href="{{route('profiles.show',['profile'=>$profile])}}">{{$profile->fullName}}</a>
                            </td>
                        </tr>
                        <tr>
                            <td>Division </td>
                            <td>{{$profile->presentDivision}}</td>
                        </tr>
                        <tr>
                            <td>District </td>
                            <td>{{$profile->presentDistrict}}</td>
                        </tr>
                        <tr>
                            <td>Upazilla </td>
                            <td>{{$profile->presentUpazilla}}</td>
                        </tr>
                        <tr>
                            <td>City </td>
                            <td>{{$profile->presentCity}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
        @endforeach
    </div>
@endsection