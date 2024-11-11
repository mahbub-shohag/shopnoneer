@extends('layouts.app')

@section('title')
    Housing
@endsection

@section('bread_controller')
    <a href="index.html">Housing</a>
@endsection

@section('bread_action')
    Edit
@endsection

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Edit Housing
        </div>

        <div class="card-body">
            <form action="{{ route('housing.update', $housing->id) }}" method="POST">
                {{ csrf_field() }}
                {{ method_field('PUT') }}

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ol>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ol>
                    </div>
                @endif

                <div class="mb-3">
                    <label class="custom-control-label">Housing Name</label>
                    <input class="form-control" type="text" name="name" value="{{ $housing->name }}">
                </div>

                <div class="mb-3">
                    <label class="custom-control-label">Division</label>
                    <select class="form-select" name="division_id">
                        <option value="">Select Division</option>
                        @foreach($divisions as $division)
                            <option value="{{ $division->id }}" @if($division->id == $housing->division_id) selected @endif>
                                {{ $division->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="custom-control-label">District</label>
                    <select class="form-select" name="district_id">
                        <option value="">Select District</option>
                        @foreach($districts as $district)
                            <option value="{{ $district->id }}" @if($district->id == $housing->district_id) selected @endif>
                                {{ $district->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="custom-control-label">Upazila</label>
                    <select class="form-select" name="upazila_id">
                        <option value="">Select Upazila</option>
                        @foreach($upazillas as $upazila)
                            <option value="{{ $upazila->id }}" @if($upazila->id == $housing->upazila_id) selected @endif>
                                {{ $upazila->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Facilities Cards -->
                <div id="facility-cards" class="row">
                    @foreach ($groupedFacilities as $categoryId => $facilities)
                        <div class="col-md-6 mb-4">
                            <div class="card">
                                <div class="card-header bg-teal text-white">
                                    {{ $facilities[0]->category->label }}
                                </div>
                                <div class="card-body">
                                    @foreach ($facilities as $facility)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox"
                                                   name="facilities[{{ $facility->id }}]"
                                                   value="{{ $facility->id }}"
                                                   data-id="{{ $facility->id }}"
                                                   @if(in_array($facility->id, $selectedFacilities)) checked @endif>
                                            <label class="form-check-label">
                                                {{ $facility->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <button class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

    <script>
        $('select[name="division_id"]').change(function () {
            let division_id = $(this).val();
            $.ajax({
                url: "{{ route('districts_by_division_id') }}",
                data: { "_token": "{{ csrf_token() }}", 'division_id': division_id },
                type: 'POST',
                dataType: 'html',
                success: function (result) {
                    $('select[name="district_id"]').html('');
                    $('select[name="district_id"]').append(result);
                }
            });
        });

        $('select[name="district_id"]').change(function () {
            let district_id = $(this).val();
            $.ajax({
                url: "{{ route('upazillas_by_district_id') }}",
                data: { "_token": "{{ csrf_token() }}", 'district_id': district_id },
                type: 'POST',
                dataType: 'html',
                success: function (result) {
                    $('select[name="upazila_id"]').html('');
                    $('select[name="upazila_id"]').append(result);
                }
            });
        });
        $('select[name="upazila_id"]').change(function () {
            let upazila_id = $(this).val();
            $.ajax({
                url: "{{ route('facilities_by_upazila_id') }}",
                data: { "_token": "{{ csrf_token() }}", 'upazila_id': upazila_id },
                type: 'POST',
                dataType: 'json',
                success: function (groupedFacilities) {
                    $('#facility-cards').html('');

                    for (let categoryId in groupedFacilities) {
                        if (groupedFacilities.hasOwnProperty(categoryId)) {
                            let category = groupedFacilities[categoryId];
                            let categoryLabel = category[0].category.label;

                            let cardHTML =
                                `<div class="col-md-6 mb-4">
                                    <div class="card">
                                        <div class="card-header bg-teal text-white">
                                            ${categoryLabel}
                                        </div>
                                        <div class="card-body">`;

                            category.forEach(facility => {
                                cardHTML +=
                                    `<div class="form-check">
                                        <input class="form-check-input" type="checkbox"
                                               name="facilities[${facility.id}]"
                                               value="${facility.id}"
                                               data-id="${facility.id}">
                                        <label class="form-check-label">
                                            ${facility.name}
                                        </label>
                                    </div>`;
                            });

                            cardHTML += `</div></div></div>`;
                            $('#facility-cards').append(cardHTML);
                        }
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error:', xhr.responseText);
                }
            });
        });

    </script>
@endsection
