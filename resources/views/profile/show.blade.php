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
            <div class="col-md-4">
                <table class="table table-bordered">
                    <tbody>
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
    </div>
@endsection