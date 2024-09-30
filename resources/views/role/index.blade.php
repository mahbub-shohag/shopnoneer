@extends('layouts.app')

@section('title')
    Roles
@endsection

@section('bread_controller')
    <a href="index.html">Roles</a>
@endsection

@section('bread_action')
    index
@endsection

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Divisions
            <a href="roles/create"><button class="btn btn-primary btn-sm add-btn"><i class="fas fa-plus"></i> New Role</button></a>
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php foreach ($roles as $key => $role) {?>

                    <tr>
                        <td><?php echo $role->id; ?></td>
                        <td><?php echo $role->name; ?></td>
                        <td>
                            <a href="{{ route('roles.show',['role'=>$role]) }}"><i class="fas fa-eye"></i></a>
                            <a href="{{ route('roles.edit',['role'=>$role]) }}"><i class="fas fa-pencil"></i></a>
                            <a href="{{ route('roles.destroy',['role'=>$role]) }}"><i class="fas fa-trash"></i></a>
                        </td>

                    </tr>

                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
@endsection
