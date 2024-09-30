@extends('layouts.app')

@section('title')
    Permissions
@endsection

@section('bread_controller')
    <a href="index.html">Permissions</a>
@endsection

@section('bread_action')
    index
@endsection

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Permission
            <a href="permissions/create"><button class="btn btn-primary btn-sm add-btn"><i class="fas fa-plus"></i> New Permission</button></a>
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Controller</th>
                    <th>Action</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Controller</th>
                    <th>Action</th>
                </tr>
                </tfoot>
                <tbody>
                <?php foreach ($permissions as $key => $permission) {?>

                <tr>
                    <td><?php echo $permission->id; ?></td>
                    <td><?php echo $permission->name; ?></td>
                    <td><?php echo $permission->controller; ?></td>
                    <td><?php echo $permission->action; ?></td>
                    <td>
                        <a href="{{ route('permissions.show',['permission'=>$permission]) }}"><i class="fas fa-eye"></i></a>
                        <a href="{{ route('permissions.edit',['permission'=>$permission]) }}"><i class="fas fa-pencil"></i></a>
                        <a href="{{ route('permissions.destroy',['permission'=>$permission]) }}"><i class="fas fa-trash"></i></a>
                    </td>

                </tr>

                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
@endsection
