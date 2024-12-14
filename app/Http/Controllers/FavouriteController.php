<?php

namespace App\Http\Controllers;

use App\DTOs\ProjectDTO;
use App\Models\Favourite;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavouriteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Favourite $favourite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Favourite $favourite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Favourite $favourite)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Favourite $favourite)
    {
        //
    }

    /*API Start*/
    public function addFavourite(Request $request){

        $existingFavourite = Favourite::where('project_id', $request->project_id)->where('user_id', Auth::id())->first();
        if($existingFavourite && $existingFavourite->is_active==0){
            $existingFavourite->is_active = 1;
            $existingFavourite->save();
            return $this->returnSuccess('Favourite added successfully',$existingFavourite);
        }else if($existingFavourite && $existingFavourite->is_active==1){
            return $this->returnSuccess('Already added to favourite',$existingFavourite);
        }

        $favourite = new Favourite();
        $favourite->user_id = Auth::user()->id;
        $favourite->project_id = $request->project_id;
        $favourite->is_active = 1;
        $favourite->save();
        if($favourite){
            return $this->returnSuccess('Favourite added successfully',$favourite);
        }else{
            return $this->returnError('Something went wrong');
        }
    }

    public function favouriteListByUser(Request $request){
        $projects = \App\Models\User::find(Auth::user()->id)->favouriteProjects;
        $projectDtos = $projects->map(fn($project) => ProjectDTO::fromModel($project))->toArray();
        return $this->returnSuccess("Favourite List",$projectDtos);
    }

    public function removeFavourite(Request $request){
        $project_id = $request->input('project_id');
        $favourite = Favourite::where('project_id',$project_id)->where('user_id',Auth::user()->id)->first();
        $favourite->is_active = 0;
        $favourite->save();
        return $this->returnSuccess('Favourite removed',$favourite);
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

    /*API End*/
}
