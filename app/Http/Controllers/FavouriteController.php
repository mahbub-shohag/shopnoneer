<?php

namespace App\Http\Controllers;

use App\DTOs\ProjectDTO;
use App\DTOs\ProjectListDTO;
use App\Models\Favourite;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavouriteController extends Controller
{
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
        $projects = Auth::user()
            ->favouriteProjects()
            ->with(['media','division','district','upazila','housing'])
            ->get();
        $projectDtos = $projects->map(fn($project) => ProjectListDTO::fromModel($project))->toArray();
        return $this->returnSuccess('Favourite List',$projectDtos);
    }
    public function removeFavourite(Request $request){
        $project_id = $request->input('project_id');
        $favourite = Favourite::where('project_id',$project_id)->where('user_id',Auth::user()->id)->first();
        $favourite->is_active = 0;
        $favourite->save();
        return $this->returnSuccess('Favourite removed',$favourite);
    }


    /*API End*/
}
