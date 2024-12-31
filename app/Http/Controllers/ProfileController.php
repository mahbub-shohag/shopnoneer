<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\District;
use App\Models\Division;
use App\Models\Profile;
use App\Models\Upazila;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $profile = Profile::where('user_id', $user->id)->first();
        $divisions = Division::all();
        $districts = District::all();
        $upazillas = Upazila::all();
        $cities = City::all();
        $religions = ['Islam', 'Hinduism', 'Christianism', 'Buddhism'];
        $occupations = ['Doctor', 'Engineer', 'Teacher', 'Lawyer', 'Business', 'Other'];
        $educations = ['Masters', 'Bachelor', 'HSC', 'SSC'];
        $sourceOfIncomes = ['Business', 'Job', 'Others'];
        return view('profile.edit', ['profile' => $profile, 'divisions' => $divisions,
            'districts' => $districts, 'upazillas' => $upazillas, 'cities' => $cities, 'religions' => $religions, 'occupations' => $occupations, 'educations' => $educations, 'sourceOfIncomes' => $sourceOfIncomes]);
    }

    public function profile_list()
    {
        $profiles = Profile::all();
        return view('profile.profile_list', ['profiles' => $profiles]);
    }

    public function show(Profile $profile)
    {
        return view('profile.show', ['profile' => $profile]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profile $profile)
    {
        return view('profile.edit', ['profile' => $profile]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Profile $profile)
    {
        $user = Auth::user();
        $profile = Profile::where('user_id', $user->id)->first();
        $profile->fullName = $request->fullName ?? $profile->fullName;
        $profile->phone_number = $request->phone_number ?? $profile->phone_number;
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

        return Redirect::route('profile.index');
    }


    /*API Start*/

    public function updateProfileAPI(Request $request)
    {
        $user = Auth::user();
        $profile = Profile::where('user_id', $user->id)->first();
//        print_r($request->data);exit;
        $info = json_decode($request->data);
//        print_r($info->fullName);exit;
        $profile->fullName = $info->fullName ?? $profile->fullName;
        $profile->phoneNumber = $info->phoneNumber ?? $profile->phoneNumber;
        $profile->religion = $info->religion ?? $profile->religion;
        $profile->education = $info->education ?? $profile->education;
        $profile->occupation = $info->occupation ?? $profile->occupation;
        $profile->presentDivision = $info->presentDivision ?? $profile->presentDivision;
        $profile->presentDistrict = $info->presentDistrict ?? $profile->presentDistrict;
        $profile->presentUpazilla = $info->presentUpazilla ?? $profile->presentUpazilla;
        $profile->presentCity = $info->presentCity ?? $profile->presentCity;
        $profile->permanentDivision = $info->permanentDivision ?? $profile->permanentDivision;
        $profile->permanentDistrict = $info->permanentDistrict ?? $profile->permanentDistrict;
        $profile->permanentUpazilla = $info->permanentUpazilla ?? $profile->permanentUpazilla;
        $profile->permanentCity = $info->permanentCity ?? $profile->permanentCity;
        $profile->preferableDivision = $info->preferableDivision ?? $profile->preferableDivision;
        $profile->preferableDistrict = $info->preferableDistrict ?? $profile->preferableDistrict;
        $profile->preferableUpazilla = $info->preferableUpazilla ?? $profile->preferableUpazilla;
        $profile->preferableCity = $info->preferableCity ?? $profile->preferableCity;
        $profile->estimatedBudget = $info->estimatedBudget ?? $profile->estimatedBudget;
        $profile->preferableFlatSize = $info->preferableFlatSize ?? $profile->preferableFlatSize;
        $profile->monthlyIncome = $info->monthlyIncome ?? $profile->monthlyIncome;
        $profile->currentCapital = $info->currentCapital ?? $profile->currentCapital;
        $profile->totalFamilyMembers = $info->totalFamilyMembers ?? $profile->totalFamilyMembers;
        $profile->sourceOfIncome = $info->sourceOfIncome ?? $profile->sourceOfIncome;
        $profile->user_id = $user->id; // Assuming the user ID is always set.
        $profile->age = $info->age ?? $profile->age;


        if ($request->hasFile('profilePhoto') && $request->file('profilePhoto')->isValid()) {
            $profilePhoto_path = $request->file('profilePhoto')->store('profilePhotos', 'public');
            print_r($profilePhoto_path);

            $profile->profilePhoto = $profilePhoto_path;
        } else {
            $profile->profilePhoto = $profile->profilePhoto ?? $profile->profilePhoto;
        }
        $profile->save();


        return $profile;
    }


    public function userProfile()
    {
        $user = User::where('id', Auth::user()->id)->with('profile')->first();
        return $this->returnSuccess('User Profile', $user);
    }
    /*API End*/
}
