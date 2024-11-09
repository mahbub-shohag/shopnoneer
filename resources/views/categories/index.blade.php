
@extends('layouts.app')

@section('title')
    Category
@endsection

@section('bread_controller')
    <a href="index.html">Category List</a>
@endsection

@section('bread_action')
    List
@endsection

@section('content')

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Category
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
                    <th>Type</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>SL</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Action</th>
                </tr>
                </tfoot>
                <tbody>
                <?php foreach ($categories as $key => $category) { ?>
                <tr>
                    <td><?php echo $key + 1; ?></td>
                    <td><?php echo $category->name; ?></td>
                    <td><?php echo $category->name; ?></td>
                    <td>
                        <!-- Flex Container for Edit, View, and Delete Actions -->
                        <div style="display: flex; align-items: center; justify-content: space-around; width: 100%;">
                            <!-- Edit Link -->
                            <a href="{{ route('housing.edit', ['housing' => $housing]) }}" class="btn-icon btn-edit">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                            <!-- View Link -->
                            <a href="{{ route('housing.show', ['housing' => $housing]) }}" class="btn-icon btn-view">
                                <i class="fas fa-eye"></i>
                            </a>
                            <!-- Delete Form -->
                            <form action="{{ route('housing.destroy', ['housing' => $housing]) }}" method="POST" style="margin: 0;">
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



