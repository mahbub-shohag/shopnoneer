@extends('layouts.app')

@section('title')
    Roles
@endsection

@section('bread_controller')
    <a href="index.html">Roles</a>
@endsection

@section('bread_action')
    edit
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="/roles/{{ $role->id }}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label >Name</label>
                    <input type="hidden" name="id" value="{{$role->id}}">
                    <input type="text" name="name" value="{{$role->name}}" class="form-control" placeholder="Enter Role Name">
                </div>

                <div>
                    <?php
                        $controller = "";
                    ?>
                    @foreach($permissions as $permission)
                        @if($permission->controller!=$controller)
                            <h3>{{$permission->controller}}</h3>
                        @endif

                        <input type="checkbox" name="permissions[]" value="{{$permission->id}}" {{(in_array($permission->id,$rolePermissions))? 'checked="checked"' : ''  }}> {{$permission->name}}

                        @if($permission->controller!=$controller)
                            <?php $controller = $permission->controller;?>
                            <hr>
                        @endif
                    @endforeach
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

@endsection
