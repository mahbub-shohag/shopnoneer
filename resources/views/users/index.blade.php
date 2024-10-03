@extends('layouts.app')

@section('title')
    Users
@endsection

@section('bread_controller')
    <a href="index.html">Users</a>
@endsection

@section('bread_action')
    index
@endsection

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Users
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Controllers</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php foreach ($users as $key => $user) {?>

                    <tr>
                        <td><?php echo $user->id; ?></td>
                        <td><?php echo $user->name; ?></td>
                        <td><?php echo $user->email; ?></td>
                        <td><?php echo $user->role?->name; ?></td>
                        <td>
                            <?php foreach ($user->role->permissions as $permission) {
                                echo $permission->permission->controller ."-". $permission->permission->action.",";
                            } ?>

                        </td>
                        <td><a href="{{ route('user.edit',['id'=>$user->id]) }}"><i class="fas fa-pencil"></i></a></td>
                    </tr>

                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
@endsection
