<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Division;
use App\Models\Facility;
use App\Models\Housing;
use App\Models\Upazila;
use Illuminate\Http\Request;

class HousingController extends Controller
{
    public function index()
    {
        $housings = Housing::with('district', 'upazila')->orderByDesc('id')->get();
        return view('housings.index', ['housings' => $housings]);
    }

    public function create()
    {
        $divisions = Division::all();
        return view('housings.create', ['divisions' => $divisions])->with('success', 'Housings created successfully.');
    }

    public function edit(Housing $housing)
    {
        $divisions = Division::all();
        $districts = District::all();
        $upazilas = Upazila::all();

        // Group facilities by their category_id
        $groupedFacilities = Facility::all()->groupBy('category_id');

        $selectedFacilities = $housing->facilities->pluck('id')->toArray(); // Get IDs of attached facilities

        return view('housings.edit', [
            'housing' => $housing,
            'divisions' => $divisions,
            'districts' => $districts,
            'upazillas' => $upazilas,
            'groupedFacilities' => $groupedFacilities, // Pass grouped facilities
            'selectedFacilities' => $selectedFacilities,
        ]);
    }

    public function show(Housing $housing)
    {
        $housing = Housing::where('id', $housing->id)
            ->with(['division', 'district', 'upazila', 'facilities.category']) // Load related facilities and their categories
            ->first();

        return view('housings.show_1', ['housing' => $housing]);
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
            $housing->latitude = $request->input('latitude'); // Store latitude
            $housing->longitude = $request->input('longitude'); // Store longitude
            $facilities = $request->input('facilities'); // Extract keys as facility IDs
            $housing->save();
            $housing->facilities()->attach($facilities);
            return redirect('/housing')->with('success', 'Housing record created successfully.');
//           print_r($facilities);exit;
        } catch (\Exception $e) {
//            print_r($e->getMessage());exit;
            return redirect('/housing/create')->with('error',$e->getMessage());
        }
    }

    public function update(Request $request, Housing $housing)
    {
        // Validation
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
            // Update housing record
            $housing->name = $request->input('name');
            $housing->division_id = $request->input('division_id');
            $housing->district_id = $request->input('district_id');
            $housing->upazila_id = $request->input('upazila_id');
            $housing->latitude = $request->input('latitude');  // Update latitude
            $housing->longitude = $request->input('longitude'); // Update longitude
            $housing->save();

            // Update facilities
            if ($request->has('facilities')) {
                $facilities = $request->input('facilities'); // Get selected facility IDs
                $housing->facilities()->sync($facilities); // Sync the selected facilities
            } else {
                $housing->facilities()->detach(); // Detach all facilities if none are selected
            }
            return redirect('/housing')->with('success', 'Housing updated successfully.');
        } catch (\Exception $e) {
            return redirect('/housing')->with('error', 'Failed to update housing record. Please try again.');
        }
    }


    public function destroy(Housing $housing)
    {
        try {
            $housing->delete();
            return redirect('/housing')->with('error', 'Housing deleted successfully.');
        } catch (\Exception $e) {
            return redirect('/housing')->with('warning', 'Failed to delete Housing');
        }
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