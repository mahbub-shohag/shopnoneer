@extends('layouts.app')

@section('title')
    Division
@endsection

@section('bread_controller')
    <a href="index.html">Division</a>
@endsection

@section('bread_action')
    index
@endsection

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            City
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Area</th>
                    <th>Thana</th>
                    <th>City Corporation</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Area</th>
                    <th>Thana</th>
                    <th>City Corporation</th>
                </tr>
                </tfoot>
                <tbody>
                <?php foreach ($cities as $key => $city) {?>

                <tr>
                    <td><?php echo $city->id; ?></td>
                    <td><?php echo $city->area; ?></td>
                    <td><?php echo $city->thana; ?></td>
                    <td><?php echo $city->city; ?></td>
                </tr>

                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
@endsection
