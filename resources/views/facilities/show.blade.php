@extends('layouts.app')

@section('title')
    Facility Details
@endsection

@section('bread_controller')
    <a href="{{ url('facility') }}" class="text-teal">Facility</a>
@endsection

@section('bread_action')
    Details
@endsection

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-lg border-0">

                    <div class="card-header bg-teal text-white text-center">
                        <h1 class="mb-0">Facility Details</h1>
                    </div>
                    <div id="map" style="height: 500px; width: 100%;"
                         data-latitude="{{ $facility->latitude }}"
                         data-longitude="{{ $facility->longitude }}">
                    </div>
                    <div class="card-body p-5">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped table-bordered text-center" style="font-size: 1.5rem;">
                                <tbody>
                                <tr>
                                    <td class="bg-dark text-white" style="width: 25%; padding: 1rem;">Name</td>
                                    <td style="padding: 1rem;">{{ $facility->name }}</td>
                                </tr>
                                <tr>
                                    <td class="bg-dark text-white" style="padding: 1rem;">Category</td>
                                    <td style="padding: 1rem;">{{ $facility->category->label }}</td>
                                </tr>
                                <tr>
                                    <td class="bg-dark text-white" style="padding: 1rem;">Division</td>
                                    <td style="padding: 1rem;">{{ $facility->division->name }}</td>
                                </tr>
                                <tr>
                                    <td class="bg-dark text-white" style="padding: 1rem;">District</td>
                                    <td style="padding: 1rem;">{{ $facility->district->name }}</td>
                                </tr>
                                <tr>
                                    <td class="bg-dark text-white" style="padding: 1rem;">Upazila</td>
                                    <td style="padding: 1rem;">{{ $facility->upazila->name }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/js/google-maps.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyABnAbo9ifTK9aGO-2oBameLdIKPxVKoXI&callback=initAutocomplete&libraries=places" defer></script>

@endsection
