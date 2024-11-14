@extends('layouts.app')

@section('title')
    Housing Details
@endsection

@section('bread_controller')
    <a href="{{ url('housing') }}" class="text-teal">Housing</a>
@endsection

@section('bread_action')
    Details
@endsection

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <!-- Housing Details Card -->
                <div class="card shadow-lg border-0">
                    <div class="card-header bg-teal text-white text-center">
                        <h1 class="mb-0">Housing Details</h1>
                    </div>
                    <div id="map" style="height: 500px; width: 100%;"
                         data-latitude="{{ $housing->latitude }}"
                         data-longitude="{{ $housing->longitude }}">
                    </div>
                    <div class="card-body p-5">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped table-bordered text-center" style="font-size: 1.5rem;">
                                <tbody>
                                <tr>
                                    <td class="bg-dark text-white" style="width: 25%; padding: 1rem;">Name</td>
                                    <td style="padding: 1rem;">{{ $housing->name }}</td>
                                </tr>
                                <tr>
                                    <td class="bg-dark text-white" style="padding: 1rem;">Division</td>
                                    <td style="padding: 1rem;">{{ $housing->division->name }}</td>
                                </tr>
                                <tr>
                                    <td class="bg-dark text-white" style="padding: 1rem;">District</td>
                                    <td style="padding: 1rem;">{{ $housing->district->name }}</td>
                                </tr>
                                <tr>
                                    <td class="bg-dark text-white" style="padding: 1rem;">Upazila</td>
                                    <td style="padding: 1rem;">{{ $housing->upazila->name }}</td>
                                </tr> <tr>
                                    <td class="bg-dark text-white" style="padding: 1rem;">Latitude</td>
                                    <td style="padding: 1rem;">{{ $housing->latitude}}</td>
                                </tr> <tr>
                                    <td class="bg-dark text-white" style="padding: 1rem;">Longitude</td>
                                    <td style="padding: 1rem;">{{ $housing->longitude }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Divider for Facilities Section -->
                <div class="card shadow-lg border-0 mt-4">
                    <div class="card-header bg-teal text-white text-center">
                        <h1 class="mb-0">Facilities</h1>
                    </div>
                    <div class="card-body p-5">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped table-bordered text-center" style="font-size: 1.5rem;">
                                <tbody>
                                @if ($housing->facilities->isNotEmpty())
                                    @foreach ($housing->facilities->groupBy('category.label') as $categoryLabel => $facilities)
                                        <tr>
                                            <td class="bg-dark text-white" style="width: 25%; padding: 1rem;">{{ $categoryLabel }}</td>
                                            <td style="padding: 1rem;">
                                                {{ $facilities->pluck('name')->join(', ') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="bg-dark text-white" style="padding: 1rem;">Facilities</td>
                                        <td style="padding: 1rem;">No facilities assigned</td>
                                    </tr>
                                @endif
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

    <!-- Custom CSS for Teal and Indigo 200 theme -->
    <style>
        .bg-teal {
            background-color: #008080; /* Teal */
        }

        .text-teal {
            color: #008080; /* Teal */
        }

        .bg-dark {
            background-color: #000000; /* Indigo 200 */
        }
    </style>
@endsection