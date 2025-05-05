<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\District;
use App\Models\Division;
use App\Models\Facility;
use App\Models\Upazila;
use Illuminate\Http\Request;

class FacilityController extends Controller
{
    public function index()
    {
        $facilities = Facility::with('category', 'division', 'district', 'upazila')->orderByDesc('updated_at')->get();
        return view('facilities.index', ['facilities' => $facilities]);
    }

    public function create()
    {
        $divisions = Division::all();
        $facility_categories = Category::where('parent_id', config('constants.cat_facilities'))->get();
        //echo "<pre>";print_r($facility_categories);exit;
        return view('facilities.create', ['divisions' => $divisions], ['facility_categories' => $facility_categories]);
    }

    public function store(Request $request)
    {
        try {
            $facility = new Facility();
            $facility->name = $request->name;
            $facility->category_id = $request->category_id;
            $facility->division_id = $request->division_id;
            $facility->district_id = $request->district_id;
            $facility->upazila_id = $request->upazila_id;
            $facility->latitude = $request->input('latitude'); // Store latitude
            $facility->longitude = $request->input('longitude'); // Store longitude
            $facility->save();

            return redirect('facility')->with('success', 'Facility created successfully.');
        } catch (\Exception $e) {
            return redirect('facility/create')->with('error', $e->getMessage());
        }
    }


    public function show(Facility $facility)
    {
        $facility = Facility::where('id', $facility->id)
            ->with('category', 'division', 'district', 'upazila')
            ->first();
        return view('facilities.show', ['facility' => $facility]);
    }

    public function edit(Facility $facility)
    {
        $divisions = Division::all();
        $districts = District::all();
        $upazilas = Upazila::all();
        $facility_categories = Category::where('parent_id', config('constants.cat_facilities'))->get();
        return view('facilities.edit', [
            'facility' => $facility,
            'divisions' => $divisions,
            'districts' => $districts,
            'upazilas' => $upazilas,
            'facility_categories' => $facility_categories
        ])->with('success', 'Facility edited successfully.');
    }


    public function update(Request $request, Facility $facility)
    {
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
            $facility->name = $request->input('name');
            $facility->category_id = $request->input('category_id');
            $facility->division_id = $request->input('division_id');
            $facility->district_id = $request->input('district_id');
            $facility->upazila_id = $request->input('upazila_id');
            $facility->latitude = $request->input('latitude'); // Store latitude
            $facility->longitude = $request->input('longitude'); // Store longitude

            $facility->save();

            return redirect('/facility')->with('success', 'Facility updated successfully.');
        } catch (\Exception $e) {
            return redirect('/facility/edit', $facility->id)->with('error', 'Failed to update facility. Please try again.');
        }
    }


    public function destroy(Facility $facility)
    {
        try {
            $facility->delete();
            return redirect('/facility')->with('error', 'Facility deleted successfully.');
        } catch (\Exception $e) {
            return redirect('/facility')->with('error', $e->getMessage());
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
