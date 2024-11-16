<?php

namespace App\Http\Controllers;

use App\Models\Favourite;
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
        $favourite = new Favourite();
        $favourite->project_id;
        $favourite->user_id = Auth::user()->id;
        $favourite->save();
        if($favourite){
            return $this->returnSuccess('Favourite addedd successfully',$favourite);
        }else{
            return $this->returnError('Something went wrong');
        }
    }

    public function favouriteListByUser(Request $request){
        $favourites = Favourite::with('project')
            ->where('is_active',1)
            ->where('user_id',Auth::user()->id);
        return $this->returnSuccess('Favourite List',$favourites);
    }

    public function removeFavourite(Request $request){
        $favourite_id = $request->input('favourite_id');
        $favourite = Favourite::where('id',$favourite_id)->first()->id;
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
