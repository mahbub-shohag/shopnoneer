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
//        echo "<pre>";print_r($housing);exit;
        $divisions = Division::all();
        $districts = District::all();
        $upazilas = Upazila::all();
        return view('housings.edit',['housing'=>$housing,'divisions' => $divisions,'districts' => $districts, 'upazillas' => $upazilas]);
//        return view('housings.edit',['housing'=>$housing]);
//        print_r($housing);
    }


    public function store(Request $request){
        $housing = new Housing();
        $housing->name = $request->input('name');
        $housing->division_id = $request->input('division_id');
        $housing->district_id = $request->input('district_id');
        $housing->upazila_id = $request->input('upazila_id');
        $housing->save();
        return redirect('/housing');
    }

    public function update(Request $request, Housing $housing)
    {
        // Update the housing fields
        $housing->name = $request->input('name');
        $housing->division_id = $request->input('division_id');
        $housing->district_id = $request->input('district_id');
        $housing->upazila_id = $request->input('upazila_id');

        // Save the updated record to the database
        $housing->save();

        // Redirect to the housing index or any preferred route
        return redirect('/housing');
    }


}
