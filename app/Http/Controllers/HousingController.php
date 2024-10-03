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
        return view('housings.edit',['housing'=>$housing,'divisions' => $divisions,'districts' => $districts, 'upazillas' => $upazilas]);

    }
    public function show(Housing $housing)
    {
        $housing = Housing::where('id',$housing->id)->with('division','district','upazila')->first();
        return view('housings.show',['housing'=>$housing]);

    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'division_id' => 'required',
            'district_id' => 'required',
            'upazila_id' => 'required',
        ], [
            'name.required' => 'The housing name is required.',
            'division_id.required' => 'Please select a division.',
            'district_id.required' => 'Please select a district.',
            'upazila_id.required' => 'Please select an upazila.',
        ]);

        try {
            // Create a new Housing instance and set its properties
            $housing = new Housing();
            $housing->name = $request->input('name');
            $housing->division_id = $request->input('division_id');
            $housing->district_id = $request->input('district_id');
            $housing->upazila_id = $request->input('upazila_id');
            $housing->save();

            // Flash a success message to the session
            return redirect('/housing')->with('success', 'Housing record created successfully.');
        } catch (\Exception $e) {
            // Flash an error message to the session
            return redirect('/housing/create')->with('error', 'Failed to create housing record. Please try again.');
        }
    }



    public function update(Request $request, Housing $housing)
    {

        $request->validate([
            'name' => 'required',
            'division_id' => 'required',
            'district_id' => 'required',
            'upazila_id' => 'required',
        ],
            [
                'name.required' => 'The housing name is required.',
                'division_id.required' => 'Please select a division.',
                'district_id.required' => 'Please select a district.',
                'upazila_id.required' => 'Please select an upazila.',
            ]);
        try {
            $housing->name = $request->input('name');
            $housing->division_id = $request->input('division_id');
            $housing->district_id = $request->input('district_id');
            $housing->upazila_id = $request->input('upazila_id');

            $housing->save();

            return redirect('/housing');
        }catch (\Exception $e) {
            return redirect('/housing')->with('error', 'Failed to update housing record. Please try again.');
        }

    }
    public function destroy(Housing $housing)
    {
        $housing->delete();

        return redirect('/housing');
    }

}
