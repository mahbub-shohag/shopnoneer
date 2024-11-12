@extends('layouts.app')

@section('title')
    Project Details
@endsection

@section('bread_controller')
    <a href="{{ url('Project') }}" class="text-teal">Project</a> <!-- Link color is teal -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@endsection

@section('bread_action')
    Details
@endsection

@section('content')
    <style>
        .banner-image {
            width: 100%; /* Full width of the parent container */
            height: auto; /* Maintain aspect ratio */
            max-height: 400px; /* Optional: Limit the height to prevent excessive size */
            object-fit: cover; /* Ensure the image fills the space proportionally */
            margin-bottom: 15px;;
        }
    </style>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-14">
                <div class="card shadow-lg border-0">
                    <div class="card-header bg-teal text-white text-center"> <!-- Changed background to teal -->
                        <h1 class="mb-0">Project Details</h1> <!-- Larger title -->
                    </div>
                    <div class="card-body p-5"> <!-- Spacious content -->
                        <div class="row">
                            <div class="col-md-12">
                                <!-- Bootstrap Carousel -->
                                <div id="projectImageCarousel" class="carousel slide" data-bs-ride="carousel">
                                    <!-- Indicators -->
                                    <div class="carousel-indicators">
                                        @foreach($project->getMedia('project_image') as $index => $image)
                                            <button type="button" data-bs-target="#projectImageCarousel" data-bs-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}" aria-current="true" aria-label="Slide {{ $index + 1 }}"></button>
                                        @endforeach
                                    </div>

                                    <!-- Carousel Items -->
                                    <div class="carousel-inner">
                                        @foreach($project->getMedia('project_image') as $index => $image)
                                            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                                <img src="{{ $image->getUrl() }}" class="d-block w-100" alt="Project Image {{ $index + 1 }}" style="height: 500px; object-fit: cover;">
                                            </div>
                                        @endforeach
                                    </div>

                                    <!-- Controls -->
                                    <button class="carousel-control-prev" type="button" data-bs-target="#projectImageCarousel" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#projectImageCarousel" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Custom Styles for Carousel -->
                        <style>
                            .carousel-inner img {
                                border-radius: 10px;
                            }
                        </style>







                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-hover table-striped table-bordered text-center" style="font-size: 1.5rem;"> <!-- Increased font size for table content -->
                                    <tbody>
                                    <tr>
                                        <td class="bg-dark text-white" style="width: 25%; padding: 1rem;">Name</td> <!-- Indigo background -->
                                        <td style="padding: 1rem;">{{ $project->title }}</td>
                                    </tr>
                                    <tr>
                                        <td class="bg-dark text-white" style="padding: 1rem;">Division</td>
                                        <td style="padding: 1rem;">{{ $project->division->name }}</td>
                                    </tr>
                                    <tr>
                                        <td class="bg-dark text-white" style="padding: 1rem;">District</td>
                                        <td style="padding: 1rem;">{{ $project->district->name }}</td>
                                    </tr>
                                    <tr>
                                        <td class="bg-dark text-white" style="padding: 1rem;">Upazila</td>
                                        <td style="padding: 1rem;">{{ $project->upazila->name }}</td>
                                    </tr>   <tr>
                                        <td class="bg-dark text-white" style="width: 25%; padding: 1rem;">Housing</td> <!-- Indigo background -->
                                        <td style="padding: 1rem;">{{ $project->housing->name }}</td>
                                    </tr>
                                    <tr>
                                        <td class="bg-dark text-white" style="padding: 1rem;">Road</td>
                                        <td style="padding: 1rem;">{{ $project->road }}</td>
                                    </tr>
                                    <tr>
                                        <td class="bg-dark text-white" style="padding: 1rem;">Block</td>
                                        <td style="padding: 1rem;">{{ $project->block }}</td>
                                    </tr>
                                    <tr>
                                        <td class="bg-dark text-white" style="padding: 1rem;">Plot</td>
                                        <td style="padding: 1rem;">{{ $project->plot }}</td>
                                    </tr>   <tr>
                                        <td class="bg-dark text-white" style="width: 25%; padding: 1rem;">Plot Size</td> <!-- Indigo background -->
                                        <td style="padding: 1rem;">{{ $project->plot_size }}</td>
                                    </tr>
                                    <tr>
                                        <td class="bg-dark text-white" style="padding: 1rem;">Plot Face</td>
                                        <td style="padding: 1rem;">{{ $project->plot_face }}</td>
                                    </tr>
                                    <tr>
                                        <td class="bg-dark text-white" style="padding: 1rem;">Is Corner</td>
                                        <td style="padding: 1rem;">{{ $project->is_corner }}</td>
                                    </tr>
                                    <tr>
                                        <td class="bg-dark text-white" style="width: 25%; padding: 1rem;">No of Units</td> <!-- Indigo background -->
                                        <td style="padding: 1rem;">{{ $project->no_of_units }}</td>
                                    </tr>
                                    <tr>
                                        <td class="bg-dark text-white" style="padding: 1rem;">Storied</td>
                                        <td style="padding: 1rem;">{{ $project->storied }}</td>
                                    </tr>

                                    <tr>
                                        <td class="bg-dark text-white" style="padding: 1rem;">Floor Area</td>
                                        <td style="padding: 1rem;">{{ $project->floor_area }}</td>
                                    </tr>
                                    <tr>
                                        <td class="bg-dark text-white" style="padding: 1rem;">Floor No</td>
                                        <td style="padding: 1rem;">{{ $project->floor_no }}</td>
                                    </tr>
                                    <tr>
                                        <td class="bg-dark text-white" style="padding: 1rem;">Google Map</td>
                                        <td style="padding: 1rem;">{{ $project->google_map }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-hover table-striped table-bordered text-center" style="font-size: 1.5rem;"> <!-- Increased font size for table content -->
                                    <tbody>
                                    <tr>
                                        <td class="bg-dark text-white" style="padding: 1rem;">No of Beds</td>
                                        <td style="padding: 1rem;">{{ $project->no_of_beds }}</td>
                                    </tr>  <tr>
                                        <td class="bg-dark text-white" style="padding: 1rem;">No of Baths</td>
                                        <td style="padding: 1rem;">{{ $project->no_of_baths }}</td>
                                    </tr>  <tr>
                                        <td class="bg-dark text-white" style="padding: 1rem;">No of Balcony</td>
                                        <td style="padding: 1rem;">{{ $project->no_of_balcony }}</td>
                                    </tr>  <tr>
                                        <td class="bg-dark text-white" style="padding: 1rem;">Parking Available</td>
                                        <td style="padding: 1rem;">{{ $project->parking_available }}</td>
                                    </tr>
                                    <tr>
                                        <td class="bg-dark text-white" style="padding: 1rem;">Owner Name</td>
                                        <td style="padding: 1rem;">{{ $project->owner_name }}</td>
                                    </tr>
                                    <tr>
                                        <td class="bg-dark text-white" style="padding: 1rem;">Owner Phone</td>
                                        <td style="padding: 1rem;">{{ $project->owner_phone }}</td>
                                    </tr> <tr>
                                        <td class="bg-dark text-white" style="padding: 1rem;">Owner Email</td>
                                        <td style="padding: 1rem;">{{ $project->owner_email }}</td>
                                    </tr> <tr>
                                        <td class="bg-dark text-white" style="padding: 1rem;">Rate Per sqft</td>
                                        <td style="padding: 1rem;">{{ $project->rate_per_sqft }}</td>
                                    </tr> <tr>
                                        <td class="bg-dark text-white" style="padding: 1rem;">Total Price</td>
                                        <td style="padding: 1rem;">{{ $project->total_price }}</td>
                                    </tr>
                                    <tr>
                                        <td class="bg-dark text-white" style="padding: 1rem;">Description</td>
                                        <td style="padding: 1rem;">{{ $project->description }}</td>
                                    </tr>
                                    <tr>
                                        <td class="bg-dark text-white" style="padding: 1rem;">Project Image</td>
                                        <td style="padding: 1rem;">
                                            @foreach($project->getMedia('project_image') as $image)
                                                <img style="width: auto;height: 40px" src="{{$image->getUrl()}}" alt="Image"/>
                                            @endforeach
                                        </td>

                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="table-responsive"> <!-- Make table responsive -->

                        </div> <!-- End of table responsive -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Custom CSS for Teal and Indigo 200 theme -->
@endsection
