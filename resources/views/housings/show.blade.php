@extends('layouts.app')

@section('title')
    Housing Details
@endsection

@section('bread_controller')
    <a href="index.html">Housing</a>
@endsection

@section('bread_action')
    Details
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6">
            <table class="table table-bordered">
                <tbody>
                <tr>
                    <td>Names</td>
                    <td>{{$housing->name}}</td>
                </tr>
                <tr>
                    <td>Division </td>
                    <td>{{$housing->division->name}}</td>
                </tr>
                <tr>
                    <td>District </td>
                    <td>{{$housing->district->name}}</td>
                </tr>
                <tr>
                    <td>Upazila</td>
                    <td>{{$housing->upazila->name}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection