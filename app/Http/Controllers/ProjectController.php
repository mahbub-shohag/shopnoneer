<?php

namespace App\Http\Controllers;

use App\Models\Amenity;
use App\Models\District;
use App\Models\Division;
use App\Models\Housing;
use App\Models\Project;
use App\Models\Upazila;
use App\DTOs\ProjectDTO;
use App\DTOs\ProjectListDTO;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with('district','upazila','housing')->orderByDesc('updated_at')->get();
        return view('projects.index',['projects'=>$projects]);
    }
    public function show(Project $project )
    {
        $project = Project::where('id', $project->id)
            ->with('division', 'district', 'upazila')
            ->first();
        return view('projects.show', ['project' => $project]);
    }
    public function create()
    {
        $divisions = Division::all();
        $housings = Housing::all();
        $amenities = Amenity::all();
        return view('projects.create',['divisions'=>$divisions,'housings'=>$housings,'amenities'=>$amenities]);
    }
    public function edit(Project $project)
    {
        $divisions = Division::all();
        $districts = District::all();
        $upazilas = Upazila::all();
        $housings = Housing::all();
        $amenities = Amenity::all();
        return view('projects.edit',['project' =>$project,'housings'=>$housings,'divisions' => $divisions,'districts' => $districts,'upazillas' => $upazilas,'amenities'=>$amenities]);
    }


    public function store(Request $request)
    {
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
            $project->owner_phone = $request->owner_phone;
            $project->is_corner = isset($request->is_corner) ? 1 : 0;
            $project->parking_available = isset($request->parking_available) ? 1 : 0;
            $project->rate_per_sqft = $request->rate_per_sqft;
            $project->total_price = $request->total_price;
            $project->description = $request->description;
//            $project->project_image = "";
            $amenities = $request->amenities;

                try {
                    if ($request->hasFile('project_image')) {
                        foreach ($request->file('project_image') as $image) {
                            $project->addMedia($image)->toMediaCollection('project_image');
                        }
                    }

                } catch (FileDoesNotExist $e) {
                    return redirect()->back()->with('error', 'The uploaded file does not exist.');
                } catch (FileIsTooBig $e) {
                    return redirect()->back()->with('error', 'The uploaded file is too large.');
                }
            $project->save();
            $project->amenities()->attach($amenities);
            return redirect('/project')->with('success', 'Project created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create project: ' . $e->getMessage());
        }
    }
    public function update(Request $request, Project $project)
    {
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
        $project->is_corner = isset($request->is_corner) ? 1 : 0;
        $project->parking_available = isset($request->parking_available) ? 1 : 0; // null is saving
        $project->owner_name = $request->owner_name;
        $project->owner_phone = $request->owner_phone; // null is saving
        $project->owner_email = $request->owner_email;
        $project->rate_per_sqft = $request->rate_per_sqft;
        $project->total_price = $request->total_price;
        $project->description = $request->description;
        try {
            if ($request->has('delete_images')) {
                foreach ($request->input('delete_images') as $imageId) {
                    $media = $project->media()->find($imageId);
                    if ($media) {
                        $media->delete();
                    }
                }
            }

            if ($request->hasFile('project_image')) {
                foreach ($request->file('project_image') as $image) {
                    $project->addMedia($image)->toMediaCollection('project_image');
                }
            }

        } catch (FileDoesNotExist $e) {
            return redirect()->back()->with('error', 'The uploaded file does not exist.');
        } catch (FileIsTooBig $e) {
            return redirect()->back()->with('error', 'The uploaded file is too large.');
        }
        $project->save();
        if ($request->has('amenities')) {
            $amenities = $request->input('amenities');
            $project->amenities()->sync($amenities);
        } else {
            $project->amenities()->detach();
        }

        return redirect('/project')->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        try {
            $project->delete();
            return redirect('/project')->with('error', 'Project deleted successfully.');

        } catch (\Exception $e) {
            return redirect('/project')->with('error',$e->getMessage());
        }
    }





// ................. Others Operation ...................

    public function projectList(Request $request){
        $projects = Project::with('district','upazila','housing')->get();
        return view('projects.project-list',['projects'=>$projects]);
    }

    public function getProjectList(Request $request){
        $size = $request->size;
        $page = $request->page ? $request->page : 1;
        $skip = ($page - 1) * $size;
        $projects = Project::with('media', 'division', 'district', 'upazila', 'housing')->where('is_active', 1)->skip($skip)->take($size)->orderByDesc('created_at')->get();
        $projectDtos = $projects->map(fn($project) => ProjectListDTO::fromModel($project))->toArray();
        return $this->returnSuccess("Project List", $projectDtos);
    }

    public function getProjectById(Request $request){
        try {
            $project = Project::with('media','division','district','upazila','housing')->find($request->project_id);
            //echo "<pre>"; print_r($project);exit;
            $projectDto = ProjectDTO::fromModel($project);
            //echo "<pre>"; print_r($projectDto->latitude);exit;
            return $this->returnSuccess("Project Detail",$projectDto);
        }catch (\Exception $e) {
            return $this->returnError("Error",$e->getMessage());
        }
    }

    public function getProjectByFilter(Request $request){
        $size = $request->size;
        $page = $request->page ? $request->page : 1;
        $skip = ($page - 1) * $size;
        $filters = $request->filters;
//        print_r($filters);


        $query = Project::query()->with('media','division','district','upazila','housing');

        foreach ($filters as $field => $value) {
            if (!is_null($value)) {
                $query->where($field, $field === 'title' ? 'LIKE' : '=', $field === 'title' ? "%{$value}%" : $value);
            }
        }

        $projects = $query->get();
        $projectDtos = $projects->map(fn($project) => ProjectListDTO::fromModel($project))->toArray();
        return $this->returnSuccess("Project List",$projectDtos);
    }
}
