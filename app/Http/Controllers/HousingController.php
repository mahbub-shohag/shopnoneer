<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Division;
use App\Models\Housing;
use App\Models\Upazila;
use Illuminate\Http\Request;

class HousingController extends Controller
{
    public function index(){
        $housings = Housing::with('district','upazila')->get();
        return  view('housings.index', ['housings' => $housings]);
    }

    public function create(){
        $divisions = Division::all();
        $districts = District::all();
        $upazilas = Upazila::all();
        return view('housings.create',['divisions' => $divisions,'districts' => $districts, 'upazillas' => $upazilas]);
    }

    public function edit(Housing $housing)
    {
        $divisions = Division::all();
        $districts = District::all();
        $upazilas = Upazila::all();
        return view('housings.edit',['divisions' => $divisions,'districts' => $districts, 'upazillas' => $upazilas]);


    }


    public function store(Request $request){
        $housing = new Housing();
        $housing->name = $request->input('name');
        $housing->division_id = $request->input('division_id');
        $housing->district_id = $request->input('district_id');
        $housing->upazila_id = $request->input('upazila_id');
        $housing->save();
        return redirect('/housing');
    }    public function update(Request $request, Housing $housing){

        $housing->name = $request->input('name');
        $housing->division_id = $request->input('division_id');
        $housing->district_id = $request->input('district_id');
        $housing->upazila_id = $request->input('upazila_id');
        $housing->save();
        return redirect('/housing');
    }
}
