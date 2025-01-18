<?php

namespace App\Http\Controllers;
use App\Models\Profile;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(){
        $users = User::all();
        //dd($users);
        return view ('users.index',['users'=>$users]);
    }

    public function edit($id){
        $user = User::where('id',$id)->with('role.permissions.permission')->get();
        $roles = Role::all();
        return view('users.edit',['user'=>$user[0],'roles'=>$roles]);
    }

    public function update(Request $request){
        $user = User::find($request->id);
        $user->role_id = $request->role;
        $user->save();
    }


}
