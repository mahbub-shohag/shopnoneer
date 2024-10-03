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
                    <th>Upazila</th>
                    <th>District</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>SL</th>
                    <th>Name</th>
                    <th>Upazila</th>
                    <th>District</th>
                    <th>Action</th>
                </tr>
                </tfoot>
                <tbody>
                <?php foreach ($housings as $key => $housing) { ?>
                <tr>
                    <td><?php echo $key + 1; ?></td>
                    <td><?php echo $housing->name; ?></td>
                    <td><?php echo $housing->upazila->name; ?></td>
                    <td><?php echo $housing->district->name; ?></td>
                    <td>
                        <!-- Flex Container for Edit, View, and Delete Actions -->
                        <div style="display: flex; align-items: center; justify-content: space-around; width: 100%;">
                            <!-- Edit Link -->
                            <a href="{{ route('housing.edit', ['housing' => $housing]) }}">
                                <i class="fas fa-pencil-alt"></i> <!-- Use a more specific pencil icon -->
                            </a>
                            <!-- View Link -->
                            <a href="{{ route('housing.show', ['housing' => $housing]) }}">
                                <i class="fas fa-eye"></i> <!-- Eye icon for view action -->
                            </a>
                            <!-- Delete Form -->
                            <form action="{{ route('housing.destroy', ['housing' => $housing]) }}" method="POST" style="margin: 0;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-link" title="Delete" style="padding: 0; color: red;">
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
