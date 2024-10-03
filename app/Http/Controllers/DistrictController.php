<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Upazila;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $districts = District::with('division')->orderBy('division_id')->get();
        //echo "<pre>";print_r($districts);exit;
        return view('districts.index',['districts'=>$districts]);
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
    public function show(District $district)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(District $district)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, District $district)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(District $district)
    {
        //
    }

    public function upazillasByDistrictId(Request $request)
    {
        $district_id = $request->district_id;
        $upazillas = Upazila::where('district_id', $district_id)->get();
        $options = "<option value='' SELECTED>Select Upazila</option>";

        foreach ($upazillas as $upazila) {
            $options = $options . "<option value='$upazila->id'>$upazila->name</option>";
        }
        return $options;
    }
}
