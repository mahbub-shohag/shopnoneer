@extends('layouts.app')

@section('title')
    Housing Details
@endsection

@section('bread_controller')
    <a href="{{ url('housing') }}" class="text-teal">Housing</a> <!-- Link color is teal -->
@endsection

@section('bread_action')
    Details
@endsection

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-lg border-0">
                    <div class="card-header bg-teal text-white text-center"> <!-- Changed background to teal -->
                        <h1 class="mb-0">Housing Details</h1> <!-- Larger title -->
                    </div>
                    <div class="card-body p-5"> <!-- Spacious content -->
                        <div class="table-responsive"> <!-- Make table responsive -->
                            <table class="table table-hover table-striped table-bordered text-center" style="font-size: 1.5rem;"> <!-- Increased font size for table content -->
                                <tbody>
                                <tr>
                                    <td class="bg-dark text-white" style="width: 25%; padding: 1rem;">Name</td> <!-- Indigo background -->
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
                                </tr>
                                </tbody>
                            </table>
                        </div> <!-- End of table responsive -->
                    </div>
                </div>
            </div>
        </div>
    </div>

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