<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\District;
use App\Models\Division;
use App\Models\Profile;
use App\Models\Upazila;
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
        $profile = Profile::where('userId', $user->id)->first();
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
        $user = Auth::user();
        $profile = Profile::where('userId', $user->id)->first();
        $profiles = Profile::all();
        return view('profile.profile_list', ['profiles' => $profiles]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
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
        $profile->fullName = isset($request->fullName)?$request->fullName:$profile->fullName;
        $profile->age = isset($request->age)?$request->age:$profile->age;
        $profile->education = isset($request->education)?$request->education:$profile->education;
        $profile->occupation = isset($request->occupation)?$request->occupation:$profile->occupation;
        $profile->presentDivision = isset($request->presentDivision)?$request->presentDivision:$profile->presentDivision;
        $profile->presentDistrict = isset($request->presentDistrict)?$request->presentDistrict:$profile->presentDistrict;
        $profile->presentUpazilla = isset($request->presentUpazilla)?$request->presentUpazilla:$profile->presentUpazilla;
        $profile->presentCity = isset($request->presentCity)?$request->presentCity:$profile->dateOfBirth;
        $profile->permanentDivision = isset($request->permanentDivision)?$request->permanentDivision:$profile->permanentDivision;
        $profile->permanentDistrict = isset($request->permanentDistrict)?$request->permanentDistrict:$profile->permanentDistrict;
        $profile->permanentUpazilla = isset($request->permanentUpazilla)?$request->permanentUpazilla:$profile->permanentUpazilla;
        $profile->permanentCity = isset($request->permanentCity)?$request->permanentCity:$profile->permanentCity;
        $profile->preferableDivision = isset($request->preferableDivision)?$request->preferableDivision:$profile->preferableDivision;
        $profile->preferableDistrict = isset($request->preferableDistrict)?$request->preferableDistrict:$profile->preferableDistrict;
        $profile->preferableUpazilla = isset($request->preferableUpazilla)?$request->preferableUpazilla:$profile->preferableUpazilla;
        $profile->preferableCity = isset($request->preferableCity)?$request->preferableCity:$profile->preferableCity;
        $profile->estimatedBudget = isset($request->estimatedBudget)?$request->estimatedBudget:$profile->estimatedBudget;
        $profile->preferableFlatSize = isset($request->preferableFlatSize)?$request->preferableFlatSize:$profile->preferableFlatSize;
        $profile->monthlyIncome = isset($request->monthlyIncome)?$request->monthlyIncome:$profile->monthlyIncome;
        $profile->currentCapital = isset($request->currentCapital)?$request->currentCapital:$profile->currentCapital;
        $profile->totalFamilyMembers = isset($request->totalFamilyMembers)?$request->totalFamilyMembers:$profile->totalFamilyMembers;
        $profile->sourceOfIncome = isset($request->sourceOfIncome)?$request->sourceOfIncome:$profile->sourceOfIncome;
        $profile->preferableDivision = isset($request->preferableDivision)?$request->preferableDivision:$profile->preferableDivision;
        $profile->save();
        return Redirect::route('profile.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profile $profile)
    {
        //
    }

    /*API Start*/
    public function updateProfileAPI(Request $request)
    {

    }
    /*API End*/
}
