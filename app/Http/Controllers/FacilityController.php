<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\District;
use App\Models\Division;
use App\Models\Facility;
use App\Models\Housing;
use App\Models\Upazila;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class FacilityController extends Controller
{
    // Display a listing of the resource.
    public function index()
    {
        $facilities = Facility::with('category', 'division', 'district', 'upazila')->orderByDesc('updated_at')->get();
//        dd($facilities);

        // Return the view with the fetched facilities
        return view('facilities.index', ['facilities' => $facilities]);
    }

    // Show the form for creating a new resource.
    public function create()
    {
        $divisions = Division::all();
        $facility_categories = Category::where('parent_id', 38)->get();
        return view('facilities.create', ['divisions' => $divisions], ['facility_categories' => $facility_categories]);
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        try {
            // Create a new Facility instance and set its properties
            $facility = new Facility();
            $facility->name = $request->name;
            $facility->category_id = $request->category_id;
            $facility->division_id = $request->division_id;
            $facility->district_id = $request->district_id;
            $facility->upazila_id = $request->upazila_id;
            $facility->latitude = $request->input('latitude'); // Store latitude
            $facility->longitude = $request->input('longitude'); // Store longitude
            $facility->google_map_url = $request->google_map_url;
            $facility->save();

            // Redirect with a success message
            return redirect()->route('facility.index')->with('success', 'Facility created successfully.');
        } catch (\Exception $e) {
            // Redirect with an error message
            return redirect()->route('facility.create')->with('error', 'Failed to create facility. Please try again.');
        }
    }


    // Display the specified resource.
    public function show(Facility $facility)
    {
        // Retrieve the facility along with related data (e.g., division, district, upazila)
        $facility = Facility::where('id', $facility->id)
            ->with('category', 'division', 'district', 'upazila') // Assuming the relations are defined in the Facility model
            ->first();

        // Return the view with the facility data
        return view('facilities.show', ['facility' => $facility]);
    }

    // Show the form for editing the specified resource.
    public function edit(Facility $facility)
    {
        // Fetch all divisions, districts, and upazilas
        $divisions = Division::all();
        $districts = District::all();
        $upazilas = Upazila::all();
        $facility_categories = Category::where('parent_id', 38)->get(); // Assuming category id is 38 for the facility categories

        // Return the view with the facility data
        return view('facilities.edit', [
            'facility' => $facility,
            'divisions' => $divisions,
            'districts' => $districts,
            'upazilas' => $upazilas,
            'facility_categories' => $facility_categories
        ])->with('success', 'Facility edited successfully.');
    }


    // Update the specified resource in storage.
    public function update(Request $request, Facility $facility)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'division_id' => 'required',
            'district_id' => 'required',
            'upazila_id' => 'required',
            'google_map_url' => 'nullable|url', // Ensure the Google Map URL is valid if provided
        ], [
            'name.required' => 'The facility name is required.',
            'category_id.required' => 'Please select a category.',
            'division_id.required' => 'Please select a division.',
            'district_id.required' => 'Please select a district.',
            'upazila_id.required' => 'Please select an upazila.',
            'google_map_url.url' => 'Please provide a valid Google Map URL.',
        ]);

        try {
            // Update the facility record with new data
            $facility->name = $request->input('name');
            $facility->category_id = $request->input('category_id');
            $facility->division_id = $request->input('division_id');
            $facility->district_id = $request->input('district_id');
            $facility->upazila_id = $request->input('upazila_id');
            $facility->latitude = $request->input('latitude'); // Store latitude
            $facility->longitude = $request->input('longitude'); // Store longitude

            // Save the updated facility data
            $facility->save();

            // Redirect with success message
            return redirect()->route('facility.index')->with('success', 'Facility updated successfully.');
        } catch (\Exception $e) {
            // Handle any errors and redirect with an error message
            return redirect()->route('facility.edit', $facility->id)->with('error', 'Failed to update facility. Please try again.');
        }
    }


    // Remove the specified resource from storage.
    public function destroy(Facility $facility)
    {
        try {
            $facility->delete();
            return redirect('/facility')->with('error', 'Facility deleted successfully.');
        } catch (\Exception $e) {
            return redirect('/facility')->with('warning', 'Failed to delete Housing');
        }
    }

    public function facilitiesByUpazilaId(Request $request)
    {
        $upazila_id = $request->upazila_id;
        $facilities = Facility::with('category')->where('upazila_id', $upazila_id)->get();
        $facilityGroups = collect($facilities)->groupBy('category_id');

        return $facilityGroups;
    }


}
