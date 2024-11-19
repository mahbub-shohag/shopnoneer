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
                            <div style="display: flex; align-items: center; justify-content: space-around; width:auto;">
                                <a href="{{ route('roles.edit', ['role' => $role]) }}" class="btn-icon btn-edit">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                <a href="{{ route('roles.show', ['role' => $role]) }}" class="btn-icon btn-view">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <form action="{{ route('roles.destroy', ['role' => $role]) }}" method="POST" style="margin: 0;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-icon btn-delete" title="Delete">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>

                    </tr>

                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
@endsection
