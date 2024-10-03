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
            Divisions
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>SL</th>
                        <th>Name</th>
                        <th>Number of Districts</th>
                        <th>Code</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>SL</th>
                        <th>Name</th>
                        <th>Number of Districts</th>
                        <th>Code</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php foreach ($divisions as $key => $division) {?>

                    <tr>
                        <td><?php echo $key+1; ?></td>
                        <td><?php echo $division->name; ?></td>
                        <td><?php echo sizeof($division->districts); ?></td>
                        <td><?php echo $division->code; ?></td>
                    </tr>

                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
@endsection
