@extends('layouts.app')

@section('title')
    Projects
@endsection

@section('bread_controller')
    <a href="index.html">Project</a>
@endsection

@section('bread_action')
    create
@endsection

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Project
        </div>

        <div class="card-body">
            <form action="{{route('project.store')}}" method="POST">
                {{csrf_field()}}
                {{ method_field('POST') }}
                <div class="mb-3">
                    <label class="custom-control-label">Title</label>
                    <input class="form-control" type="text" name="title">
                </div>
                <div class="mb-3">
                    <label class="custom-control-label">Division</label>
                    <select class="form-select" name="division_id">
                        @foreach($divisions as $division)
                            <option value="">Select Division</option>
                            <option value="{{$division->id}}">{{$division->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="custom-control-label">District</label>
                    <select class="form-select" name="district_id">
                        <option value="">Select District</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="custom-control-label">Upazilla</label>
                    <select class="form-select" name="upazila_id">
                        @foreach($upazillas as $upazila)
                            <option value="{{$upazila->id}}">{{$upazila->name}}</option>
                        @endforeach
                    </select>
                </div>
{{--                <div class="mb-3">--}}
{{--                    <label class="custom-control-label">City</label>--}}
{{--                    <select class="form-select" name="city_id">--}}
{{--                        @foreach($cities as $city)--}}
{{--                            <option value="{{$city->id}}">{{$city->area}}</option>--}}
{{--                        @endforeach--}}
{{--                    </select>--}}
{{--                </div>--}}

                <div class="mb-3">
                    <label class="custom-control-label">Housing</label>
                    <select class="form-select" name="housing_id">
                        @foreach($housings as $housing)
                            <option value="{{$housing->id}}">{{$housing->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="custom-control-label">Road</label>
                    <input type="number" class="form-control" name="road">
                </div>

                <div class="mb-3">
                    <label class="custom-control-label">Block</label>
                    <input type="text" class="form-control" name="block">
                </div>

                <div class="mb-3">
                    <label class="custom-control-label">Plot Number</label>
                    <input type="text" class="form-control" name="plot">
                </div>

                <div class="mb-3">
                    <label class="custom-control-label">Plot Size</label>
                    <input type="number" class="form-control" name="plot_size">
                </div>

                <div class="mb-3">
                    <label class="custom-control-label">Plot Face</label>
                    <select class="form-control" name="plot_face">
                        <option>North</option>
                        <option>South</option>
                        <option>East</option>
                        <option>South</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="custom-control-label">Is Corner</label>
                    <input type="checkbox" class="form-checkbox" name="is_corner">
                </div>

                <div class="mb-3">
                    <label class="custom-control-label">Storied</label>
                    <input type="number" class="form-control" name="storied">
                </div>

                <div class="mb-3">
                    <label class="custom-control-label">No of Units</label>
                    <input type="number" class="form-control" name="no_of_units">
                </div>

                <div class="mb-3">
                    <label class="custom-control-label">Floor Area</label>
                    <input type="number" class="form-control" name="floor_area">
                </div>

                <div class="mb-3">
                    <label class="custom-control-label">floor_no</label>
                    <input type="number" class="form-control" name="floor_no">
                </div>

                <div class="mb-3">
                    <label class="custom-control-label">No of Beds</label>
                    <input type="number" class="form-control" name="no_of_beds">
                </div>

                <div class="mb-3">
                    <label class="custom-control-label">No of Baths</label>
                    <input type="number" class="form-control" name="no_of_baths">
                </div>

                <div class="mb-3">
                    <label class="custom-control-label">No of Balcony</label>
                    <input type="number" class="form-control" name="no_of_balcony">
                </div>

                <div class="mb-3">
                    <label class="custom-control-label">Parking Available?</label>
                    <input type="checkbox" class="form-checkbox" name="parking_available">
                </div>

                <div class="mb-3">
                    <label class="custom-control-label">Owner Name</label>
                    <input type="text" class="form-control" name="owner_name">
                </div>

                <div class="mb-3">
                    <label class="custom-control-label">Owner Phone</label>
                    <input type="text" class="form-control" name="owner_phone">
                </div>

                <div class="mb-3">
                    <label class="custom-control-label">Owner Email</label>
                    <input type="text" class="form-control" name="owner_email">
                </div>

                <div class="mb-3">
                    <label class="custom-control-label">Rate Per sqft</label>
                    <input type="text" class="form-control" name="rate_per_sqft">
                </div>

                <div class="mb-3">
                    <label class="custom-control-label">Total Price</label>
                    <input type="number" class="form-control" name="total_price">
                </div>

                <div class="mb-3">
                    <label class="custom-control-label">Description</label>
                    <input type="text" class="form-control" name="description">
                </div>

                <div class="mb-3">
                    <label class="custom-control-label">Google Map</label>
                    <input type="text" class="form-control" name="google_map">
                </div>

                <button class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

    <script>
        $('select[name="division_id"]').change(function(){
            var division_id = $(this).val();
            $.ajax({
                headers: {

                },
                url : "{{route('districts_by_division_id')}}",
                data : {
                    "_token": "{{ csrf_token() }}",
                    'division_id' : division_id
                },
                type : 'POST',
                dataType : 'html',
                success : function(result){
                    $('select[name="district_id"]').html('');
                    $('select[name="district_id"]').append(result);
                }
            });
        });


        $('select[name="district_id"]').change(function(){
            var district_id = $(this).val();
            $.ajax({
                headers: {

                },
                url : "{{route('upazillas_by_district_id')}}",
                data : {
                    "_token": "{{ csrf_token() }}",
                    'district_id' : district_id
                },
                type : 'POST',
                dataType : 'html',
                success : function(result){
                    $('select[name="upazila_id"]').html('');
                    $('select[name="upazila_id"]').append(result);
                }
            });
        });


        $('select[name="upazila_id"]').change(function(){
            var upazila_id = $(this).val();
            $.ajax({
                headers: {

                },
                url : "{{route('cities_by_upazila_id')}}",
                data : {
                    "_token": "{{ csrf_token() }}",
                    'upazila_id' : upazila_id
                },
                type : 'POST',
                dataType : 'html',
                success : function(result){
                    $('select[name="city_id"]').html('');
                    $('select[name="city_id"]').append(result);
                }
            });
        });
    </script>

@endsection
