<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Division;
use App\Models\Facility;
use App\Models\Housing;
use App\Models\Project;
use App\Models\Upazila;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function Laravel\Prompts\table;

class HousingController extends Controller
{
    public function index()
    {
        $housings = Housing::with('district', 'upazila')->orderByDesc('updated_at')->get();
        return view('housings.index',['housings' => $housings])->with('housings', $housings);
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
        $groupedFacilities = Facility::where('upazila_id',$housing->upazila_id)->get()->groupBy('category_id');
        $selectedFacilities = $housing->facilities->pluck('id')->toArray();

        return view('housings.edit', [
            'housing' => $housing,
            'divisions' => $divisions,
            'districts' => $districts,
            'upazilas' => $upazilas,
            'groupedFacilities' => $groupedFacilities,
            'selectedFacilities' => $selectedFacilities,
        ]);
    }

    public function show(Housing $housing)
    {
        $housing = Housing::where('id', $housing->id)
            ->with(['division', 'district', 'upazila', 'facilities.category'])
            ->first();

        return view('housings.show', ['housing' => $housing]);
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
            $housing = new Housing();
            $housing->name = $request->name;
            $housing->division_id = $request->division_id;
            $housing->district_id = $request->district_id;
            $housing->upazila_id = $request->upazila_id;
            $housing->latitude = $request->latitude;
            $housing->longitude = $request->longitude;
            $facilities = $request->facilities;

            $formattedFacilities = [];
            foreach ($facilities as $facilityId => $distance) {
                $facility = Facility::find($facilityId);
                $formattedFacilities[$facilityId] = ['distance' => $this->haversineDistanceMeters($housing->latitude, $housing->longitude, $facility->latitude,$facility->longitude)];
            }
            $housing->save();
            $housing->facilities()->attach($formattedFacilities);
            //$housing->facilities()->attach($facilities);
            return redirect('/housing')->with('success', 'Housing record created successfully.');
        } catch (\Exception $e) {
            return redirect('/housing/create')->with('error',$e->getMessage());
        }
    }

    function haversineDistanceMeters($lat1, $lon1, $lat2, $lon2) {
        $earthRadius = 6371000; // Radius of Earth in meters

        $latDelta = deg2rad($lat2 - $lat1);
        $lonDelta = deg2rad($lon2 - $lon1);

        $a = sin($latDelta / 2) * sin($latDelta / 2) +
            cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
            sin($lonDelta / 2) * sin($lonDelta / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return round($earthRadius * $c, 2); // Distance in meters
    }

    public function update(Request $request, Housing $housing)
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

            $housing->name = $request->input('name');
            $housing->division_id = $request->input('division_id');
            $housing->district_id = $request->input('district_id');
            $housing->upazila_id = $request->input('upazila_id');
            $housing->latitude = $request->input('latitude');
            $housing->longitude = $request->input('longitude');
            $housing->save();

            if ($request->has('facilities')) {
                $facilities = $request->input('facilities');
                $formattedFacilities = [];
                foreach ($facilities as $facilityId => $distance) {
                    $facility = Facility::find($facilityId);
                    $formattedFacilities[$facilityId] = ['distance' => $this->haversineDistanceMeters($housing->latitude, $housing->longitude, $facility->latitude,$facility->longitude)];
                }
                $housing->facilities()->sync($formattedFacilities);
            } else {
                $housing->facilities()->detach();
            }
            return redirect('/housing')->with('success', 'Housing updated successfully.');
        } catch (\Exception $e) {
            return redirect('/housing/edit')->with($e->getMessage());
        }
    }


    public function destroy(Housing $housing)
    {
        try {
            $housing->delete();
            return redirect('/housing')->with('error', 'Housing deleted successfully.');
        } catch (\Exception $e) {
            return redirect('/housing')->with($e->getMessage());
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


    /*Housing API*/
    public function getHousingList(Request $request){
        $housings = DB::table('projects')
            ->leftJoin('housings', 'projects.housing_id', '=', 'housings.id')
            ->select('housings.id', 'housings.name', DB::raw('COUNT(projects.id) as total_projects'))
            ->groupBy('housings.id', 'housings.name') // Add housings.name here
            ->orderBy('total_projects', 'DESC')
            ->get();
        return response()->json($housings);

    }
    /*Housing API*/


}