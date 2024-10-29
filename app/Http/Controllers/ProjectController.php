<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Division;
use App\Models\Housing;
use App\Models\Project;
use App\Models\Upazila;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::with('district','upazila','housing')->get();
        return view('projects.index',['projects'=>$projects]);
    }

    public function projectList(Request $request){
        $projects = Project::with('district','upazila','housing')->get();
        return view('projects.project-list',['projects'=>$projects]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $divisions = Division::all();
        $housings = Housing::all();
        return view('projects.create',['divisions'=>$divisions,'housings'=>$housings])->with('success', 'Project created successfully.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request
        /*$request->validate([
            'title' => 'required|string|min:3|max:255',
            'division_id' => 'required',
            'district_id' => 'required',
            'upazila_id' => 'required',
            'housing_id' => 'required',
            'road' => 'nullable|string|max:255',
            'block' => 'nullable|string|max:255',
            'plot' => 'nullable|string|max:255',
            'plot_size' => 'nullable|numeric',
            'plot_face' => 'nullable|string|max:255',
            'storied' => 'nullable|integer|min:1',
            'no_of_units' => 'nullable|integer|min:1',
            'floor_area' => 'nullable|numeric',
            'floor_no' => 'nullable|integer',
            'no_of_beds' => 'nullable|integer|min:0',
            'no_of_baths' => 'nullable|integer|min:0',
            'no_of_balcony' => 'nullable|integer|min:0',
            'owner_name' => 'nullable|string|max:255',
            'owner_email' => 'nullable|email|max:255',
            'rate_per_sqft' => 'nullable|numeric|min:0',
            'total_price' => 'nullable|numeric|min:0',
            'description' => 'nullable|string',
            'google_map' => 'nullable|url',
        ], [
            'title.required' => 'The project title is required.',
            'division_id.required' => 'Please select a division.',
            'district_id.required' => 'Please select a district.',
            'upazila_id.required' => 'Please select an upazila.',
            'housing_id.required' => 'Please select a housing.',
        ]);
*/
        try {
            $project = new Project();
            $project->title = $request->title;
            $project->division_id = $request->division_id;
            $project->district_id = $request->district_id;
            $project->upazila_id = $request->upazila_id;
            $project->housing_id = $request->housing_id;
            $project->road = $request->road;
            $project->block = $request->block;
            $project->plot = $request->plot;
            $project->plot_size = $request->plot_size;
            $project->plot_face = $request->plot_face;
            $project->storied = $request->storied;
            $project->no_of_units = $request->no_of_units;
            $project->floor_area = $request->floor_area;
            $project->floor_no = $request->floor_no;
            $project->no_of_beds = $request->no_of_beds;
            $project->no_of_baths = $request->no_of_baths;
            $project->no_of_balcony = $request->no_of_balcony;
            $project->owner_name = $request->owner_name;
            $project->owner_email = $request->owner_email;
            $project->rate_per_sqft = $request->rate_per_sqft;
            $project->total_price = $request->total_price;
            $project->description = $request->description;
            $project->google_map = $request->google_map;
//            if ($request->hasFile('project_image') && $request->file('project_image')->isValid()) {
//                $project->addMediaFromRequest('project_image')->toMediaCollection('project_image');
//            }
            $project->project_image = "";
            $result = $project->save();
            //echo "Project Save Status ".$result;
            //$url = $project->getFirstMediaUrl('project_image', 'thumb');


            if ($request->hasFile('project_image') && $request->file('project_image')->isValid()) {
                // Add the image to the media collection
                try {
                    $project->addMediaFromRequest('project_image')->toMediaCollection('project_image');
                    $url = $project->getFirstMediaUrl('project_image', 'thumb');
                    $project->project_image = $url;
                    $project->save();
                } catch (FileDoesNotExist $e) {
                    return redirect()->back()->with('error', 'The uploaded file does not exist.');
                } catch (FileIsTooBig $e) {
                    return redirect()->back()->with('error', 'The uploaded file is too large.');
                }
            }

            // If everything is successful, redirect with success message
            return redirect('/project')->with('success', 'Project created successfully!');
        } catch (\Exception $e) {
            // If something goes wrong, return back with an error message
            return redirect()->back()->with('error', 'Failed to create project: ' . $e->getMessage());
        }
    }




    /**
     * Display the specified resource.
     */
    public function show(Project $project )
    {
        $project = Project::where('id', $project->id)
            ->with('division', 'district', 'upazila')
            ->first();
        return view('projects.show', ['project' => $project]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $divisions = Division::all();
        $districts = District::all();
        $upazilas = Upazila::all();
        $housings = Housing::all();

        return view('projects.edit',['project' =>$project,'housings'=>$housings,'divisions' => $divisions,'districts' => $districts,'upazillas' => $upazilas]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'title' => 'required',
            'division_id' => 'required',
            'district_id' => 'required',
            'upazila_id' => 'required',
            'housing_id' => 'required',
        ], [
            'title.required' => 'The Project name is required.',
            'division_id.required' => 'Please select a division.',
            'district_id.required' => 'Please select a district.',
            'upazila_id.required' => 'Please select an upazila.',
            'housing_id.required' => 'Please select a housing option.',
        ]);

        // Update project record
        $project->title = $request->title;
        $project->division_id = $request->division_id;
        $project->district_id = $request->district_id;
        $project->upazila_id = $request->upazila_id;
        $project->housing_id = $request->housing_id;
        $project->road = $request->road;
        $project->block = $request->block;
        $project->plot = $request->plot;
        $project->plot_size = $request->plot_size;
        $project->plot_face = $request->plot_face;
        $project->is_corner = isset($request->is_corner) ? 1 : 0;
        $project->storied = $request->storied;
        $project->no_of_units = $request->no_of_units;
        $project->floor_area = $request->floor_area;
        $project->floor_no = $request->floor_no;
        $project->no_of_beds = $request->no_of_beds;
        $project->no_of_baths = $request->no_of_baths;
        $project->no_of_balcony = $request->no_of_balcony;
        $project->parking_available = isset($request->parking_available) ? 1 : 0;
        $project->owner_name = $request->owner_name;
        $project->owner_phone = $request->owner_phone;
        $project->owner_email = $request->owner_email;
        $project->rate_per_sqft = $request->rate_per_sqft;
        $project->total_price = $request->total_price;
        $project->description = $request->description;
        $project->google_map = $request->google_map;

        if ($request->hasFile('project_image') && $request->file('project_image')->isValid()) {
            $project->media()->delete();
            $project->addMediaFromRequest('project_image')->toMediaCollection('project_image');
        }

        $project->save();
        if ($request->hasFile('project_image') && $request->file('project_image')->isValid()) {
            $url = $project->getFirstMediaUrl('project_image', 'thumb');
            $project->project_image = $url;
            $project->save();
        }


        // Flash success message
        return redirect('/project')->with('success', 'Project updated successfully.');
    }


    public function destroy(Project $project)
    {
        try {
            $project->delete();
            return redirect('/project')->with('error', 'Project deleted successfully.');
        } catch (\Exception $e) {
            return redirect('/project')->with('warning', 'Failed to delete Project');
        }
    }


    /*API*/

    public function getProjectList(Request $request){
        $size = 5;
        $page = $request->page?$request->page:1;
        $skip = ($page - 1) * $size;
        //$projects = Project::where('is_active',1)
        //    ->skip($skip)->take($size)->get();
        $projects = DB::table('projects')
            ->leftJoin('districts', 'projects.district_id', '=', 'districts.id')
            ->leftJoin('upazilas', 'projects.upazila_id', '=', 'upazilas.id')
            ->leftJoin('housings', 'projects.housing_id', '=', 'housings.id')
            ->leftJoin('divisions', 'projects.division_id', '=', 'divisions.id')
            ->select('projects.*','divisions.name as division','districts.name as district','upazilas.name as upazila','housings.name as housing')
            ->get();
        return $this->returnSuccess("Project List",$projects);
    }

    public function returnError($message,$code): \Illuminate\Http\JsonResponse
    {
        $message = [
            "error"=>$message,
            "code"=>$code
        ];
        return response()->json($message);
    }

    public function returnSuccess($message,$data): \Illuminate\Http\JsonResponse
    {
        $message = [
            "message"=>$message,
            "code"=>200,
            "success"=>true,
            "data"=>$data
        ];
        return response()->json($message);
    }
}
