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

    /*API Start*/
    public function updateUserProfile(Request $request)
    {
        $user = Auth::user();
        $profile = Profile::where('userId', $user->id)->first();

        $profile->fullName = $request->fullName;
        $profile->religion = $request->religion;
        $profile->education = $request->education;
        $profile->occupation = $request->occupation;
        $profile->presentDivision = $request->presentDivision;
        $profile->presentDistrict = $request->presentDistrict;
        $profile->presentUpazilla = $request->presentUpazilla;
        $profile->presentCity = $request->presentCity;
        $profile->permanentDivision = $request->permanentDivision;
        $profile->permanentDistrict = $request->permanentDistrict;
        $profile->permanentUpazilla = $request->permanentUpazilla;
        $profile->permanentCity = $request->permanentCity;
        $profile->preferableDivision = $request->preferableDivision;
        $profile->preferableDistrict = $request->preferableDistrict;
        $profile->preferableUpazilla = $request->preferableUpazilla;
        $profile->preferableCity = $request->preferableCity;
        $profile->estimatedBudget = $request->estimatedBudget;
        $profile->preferableFlatSize = $request->preferableFlatSize;
        $profile->monthlyIncome = $request->monthlyIncome;
        $profile->currentCapital = $request->currentCapital;
        $profile->totalFamilyMembers = $request->totalFamilyMembers;
        $profile->sourceOfIncome = $request->sourceOfIncome;
        $profile->userId = $request->userId;
        $profile->age = $request->age;

        $profile->save();

        return $profile;
    }


    /*API End*/
}
