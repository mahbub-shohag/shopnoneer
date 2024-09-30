<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\District;
use App\Models\Division;
use App\Models\Housing;
use App\Models\Project;
use App\Models\Upazila;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::with('district','upazila','housing','city')->get();
        return view('projects.index',['projects'=>$projects]);
    }

    public function projectList(Request $request){
        $projects = Project::with('district','upazila','housing','city')->get();
        return view('projects.project-list',['projects'=>$projects]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $divisions = Division::all();
        $districts = District::all();
        $upazillas = Upazila::all();
        $cities = City::all();
        $housings = Housing::all();
        return view('projects.create',['divisions'=>$divisions,'districts'=>$districts,'upazillas'=>$upazillas,'cities'=>$cities,'housings'=>$housings]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $project = new Project();
        $project->title = $request->title;
        $project->district_id = $request->district_id;
        $project->upazila_id = $request->upazilla_id;
        $project->city_id = $request->city_id;
        $project->housing_id = $request->housing_id;
        $project->road = $request->road;
        $project->block = $request->block;
        $project->plot = $request->plot;
        $project->plot_size = $request->plot_size;
        $project->plot_face = $request->plot_face;
        $project->is_corner = isset($request->is_corner) ? 1:0;
        $project->storied = $request->storied;
        $project->no_of_units = $request->no_of_units;
        $project->floor_area = $request->floor_area;
        $project->floor_no = $request->floor_no;
        $project->no_of_beds = $request->no_of_beds;
        $project->no_of_baths = $request->no_of_baths;
        $project->no_of_balcony = $request->no_of_balcony;
        $project->parking_available = isset($request->parking_available) ? 1:0;
        $project->owner_name = $request->owner_name;
        $project->owner_phone = $request->owner_phone;
        $project->owner_email = $request->owner_email;
        $project->rate_per_sqft = $request->rate_per_sqft;
        $project->total_price = $request->total_price;
        $project->description = $request->description;
        $project->google_map = $request->google_map;
        $project->save();
        return redirect('/project');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        return view('projects.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        //
    }
}
