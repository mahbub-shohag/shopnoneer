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
            Upazillas
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                <tr>
                    <th>SL</th>
                    <th>Division</th>
                    <th>District</th>
                    <th>Upazila</th>
                    <th>Code</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>SL</th>
                    <th>Division</th>
                    <th>District</th>
                    <th>Upazila</th>
                    <th>Code</th>
                </tr>
                </tfoot>
                <tbody>
                <?php foreach ($upazillas as $key => $upazilla) {?>

                <tr>
                    <td><?php echo $key+1; ?></td>
                    <td><?php echo $upazilla->district->division->name; ?></td>
                    <td><?php echo $upazilla->district->name; ?></td>
                    <td><?php echo $upazilla->name; ?></td>
                    <td><?php echo $upazilla->code; ?></td>
                </tr>

                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
@endsection
