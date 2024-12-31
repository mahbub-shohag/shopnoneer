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
        $profile = Profile::where('user_id', $user->id)->first();

        $profile->fullName = $request->fullName ?? $profile->fullName;
//        $profile->number = $request->number ?? $profile->number;
        $profile->religion = $request->religion ?? $profile->religion;
        $profile->education = $request->education ?? $profile->education;
        $profile->occupation = $request->occupation ?? $profile->occupation;
        $profile->presentDivision = $request->presentDivision ?? $profile->presentDivision;
        $profile->presentDistrict = $request->presentDistrict ?? $profile->presentDistrict;
        $profile->presentUpazilla = $request->presentUpazilla ?? $profile->presentUpazilla;
        $profile->presentCity = $request->presentCity ?? $profile->presentCity;
        $profile->permanentDivision = $request->permanentDivision ?? $profile->permanentDivision;
        $profile->permanentDistrict = $request->permanentDistrict ?? $profile->permanentDistrict;
        $profile->permanentUpazilla = $request->permanentUpazilla ?? $profile->permanentUpazilla;
        $profile->permanentCity = $request->permanentCity ?? $profile->permanentCity;
        $profile->preferableDivision = $request->preferableDivision ?? $profile->preferableDivision;
        $profile->preferableDistrict = $request->preferableDistrict ?? $profile->preferableDistrict;
        $profile->preferableUpazilla = $request->preferableUpazilla ?? $profile->preferableUpazilla;
        $profile->preferableCity = $request->preferableCity ?? $profile->preferableCity;
        $profile->estimatedBudget = $request->estimatedBudget ?? $profile->estimatedBudget;
        $profile->preferableFlatSize = $request->preferableFlatSize ?? $profile->preferableFlatSize;
        $profile->monthlyIncome = $request->monthlyIncome ?? $profile->monthlyIncome;
        $profile->currentCapital = $request->currentCapital ?? $profile->currentCapital;
        $profile->totalFamilyMembers = $request->totalFamilyMembers ?? $profile->totalFamilyMembers;
        $profile->sourceOfIncome = $request->sourceOfIncome ?? $profile->sourceOfIncome;
        $profile->user_id = $user->id; // Assuming the user ID is always set.
        $profile->age = $request->age ?? $profile->age;
        $profile->save();

        return $profile;
    }


    /*API End*/
}
