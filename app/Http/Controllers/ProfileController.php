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
        $profile->fullName = $request->fullName;
        $profile->age = $request->age;
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
