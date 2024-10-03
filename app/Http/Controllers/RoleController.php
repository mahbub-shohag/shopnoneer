<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use App\Models\RolePermission;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::with('permissions.permission')->get();
        return view('role.index',['roles'=>$roles]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('role.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $role = new Role();
        $role->name = $request->name;
        if($role->save()){
            return redirect()->route('roles.index')->with('message', 'Role created successfully');
        }else{
            return redirect()->route('roles.create')->with('message', 'Role could not created');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        //echo $role;exit;
        $role = Role::where('id',$role->id)->with('permissions.permission')->get();
        //echo "<pre>";print_r($role);exit;
        return view('role.show',['role'=>$role[0]]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $permissions = Permission::orderBy('controller')->get();
        $rolePermissions = $role->permissions->pluck('permission_id')->toArray();
        //print_r($rolePermissions);exit;
        return view('role.edit',['role'=>$role,'permissions'=>$permissions,'rolePermissions'=>$rolePermissions]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $rolePermissions = [];
        foreach ($request->permissions as $obj){
            $rolePermission = new RolePermission();
            $rolePermission->permission_id=$obj;
            array_push($rolePermissions,$rolePermission);
        }
        $role->permissions()->delete();
        $role->permissions()->saveMany($rolePermissions);
        $roles = Role::with('permissions.permission')->get();
        return view('role.index',['roles'=>$roles]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        //
    }
}
