@extends('layouts.app')

@section('title')
    Housing
@endsection

@section('bread_controller')
    <a href="index.html">Housing</a>
@endsection

@section('bread_action')
    index
@endsection

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Housing

            <a href="housing/create">
                <button class="btn btn-sm btn-primary" style="float: right"><i class="fas fa-plus"></i> Add New</button>
            </a>
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                <tr>
                    <th>SL</th>
                    <th>Name</th>
                    <th>City</th>
                    <th>Upazila</th>
                    <th>District</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>SL</th>
                    <th>Name</th>
                    <th>City</th>
                    <th>Upazila</th>
                    <th>District</th>
                </tr>
                </tfoot>
                <tbody>
                <?php foreach ($housings as $key => $housing) {?>

                <tr>
                    <td><?php echo $key+1; ?></td>
                    <td><?php echo $housing->name; ?></td>
                    <td><?php echo $housing->city->area; ?></td>
                    <td><?php echo $housing->upazila->name; ?></td>
                    <td><?php echo $housing->district->name; ?></td>
                </tr>

                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
@endsection
