<?php

namespace App\Http\Controllers;

use App\DTOs\ProjectDTO;
use App\Models\Favourite;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function Laravel\Prompts\error;

class FavouriteController extends Controller
{
    /*API Start*/
    public function addFavourite(Request $request)
    {

        $existingFavourite = Favourite::where('project_id', $request->project_id)->where('user_id', Auth::id())->first();
        if ($existingFavourite && $existingFavourite->is_active == 0) {
            $existingFavourite->is_active = 1;
            $existingFavourite->save();
            return $this->returnSuccess('Favourite added successfully', $existingFavourite);
        } else if ($existingFavourite && $existingFavourite->is_active == 1) {
            return $this->returnSuccess('Already added to favourite', $existingFavourite);
        }

        $favourite = new Favourite();
        $favourite->user_id = Auth::user()->id;
        $favourite->project_id = $request->project_id;
        $favourite->is_active = 1;
        $favourite->save();
        if ($favourite) {
            return $this->returnSuccess('Favourite added successfully', $favourite);
        } else {
            return $this->returnError('Something went wrong', 404);
        }
    }

    public function favouriteListByUser(Request $request)
    {
        $favourites = Favourite::with('project')
            ->where('is_active', 1)
            ->where('user_id', Auth::user()->id)->get();
        return $this->returnSuccess('Favourite List', $favourites);
    }

    // এই কোডগুলাই অনেক সমস্যা আছে যেমন যখন একটা নির্দিষ্ট প্রজেক্ট থেকে ফেভারেট সরাতে চাই তখন এই কোডগুলো কাজ করবে না
    /*
            public function removeFavourite(Request $request){
            $favourite_id = $request->input('favourite_id');
            $favourite = Favourite::where('id',$favourite_id)->first();
            $favourite->is_active = 0;
            $favourite->save();
            return $this->returnSuccess('Favourite removed',$favourite);
        }
      */


    public function removeFavourite(Request $request)
    {
        $favourite = Favourite::where('project_id', $request->project_id)
            ->where('user_id', Auth::id())
            ->first();

        if ($favourite && $favourite->is_active == 1) {
            $favourite->is_active = 0;
            $favourite->save();
            return $this->returnSuccess('Favourite removed successfully', $favourite);
        }

        if ($favourite && $favourite->is_active == 0) {
            return $this->returnSuccess('Favourite already removed', $favourite);
        }

        return $this->returnError('Favourite not found', 404);
    }

    /*API End*/
}
