<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Housing;
use App\Models\Upazila;
use Illuminate\Http\Request;

class UpazilaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $upazillas = Upazila::with('district', 'district.division')->get();
        return view('upazilas.index', ['upazillas' => $upazillas]);
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
    public function show(Upazila $upazila)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Upazila $upazila)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Upazila $upazila)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Upazila $upazila)
    {
        //
    }

    public function housingsByUpazilaId(Request $request)
    {
        $upazila_id = $request->upazila_id;
        $housings = Housing::where('upazila_id', $upazila_id)->get();
        $options = "<option value='' SELECTED>Select Housing</option>";
        foreach ($housings as $housing) {
            $options .= "<option value='$housing->id'>" . ($housing->name == NULL ? "No housing in this Upazila" : $housing->name) . "</option>";
        }
        return $options;
    }
}
