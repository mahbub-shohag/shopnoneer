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
        try {
            // Manually assign each field directly from the request
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

            // Save the updated profile
            $profile->save();

            return redirect()->route('profile.index')->with('success', 'Profile updated successfully.');
        } catch (\Exception $e) {
            return redirect()->route('profile.edit', $profile)->with('error', 'Error updating profile: ' . $e->getMessage());
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profile $profile)
    {
        try {
            $profile->delete();
            return redirect('/profile.index')->with('success', 'Profile deleted successfully.');
        } catch (\Exception $e) {
            return redirect('/profile.index')->with('error', 'Error deleting profile: ' . $e->getMessage());
        }
    }

//    API start

    public function userProfile()
    {
        $user = Auth::user();
//        $profile = Profile::where('id', $user->id)->first();
        return response()->json([
            'profile' => $user,
            'message' => 'Alhamdulillah API is working',
            'code' => 200,
            'success' => true
        ], 200);
    }

}
