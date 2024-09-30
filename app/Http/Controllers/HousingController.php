<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\District;
use App\Models\Housing;
use App\Models\Upazila;
use Illuminate\Http\Request;

class HousingController extends Controller
{
    public function index(){
        $housings = Housing::with('district','upazila','city')->get();
        return  view('housings.index', ['housings' => $housings]);
    }

    public function create(){
        $districts = District::all();
        $upazilas = Upazila::all();
        $cities = City::all();
        return view('housings.create',['districts' => $districts, 'upazillas' => $upazilas,'cities' => $cities]);
    }

    public function store(Request $request){
        $housing = new Housing();
        $housing->name = $request->input('name');
        $housing->district_id = $request->input('district_id');
        $housing->upazila_id = $request->input('upazila_id');
        $housing->city_id = $request->input('city_id');
        $housing->save();
        return redirect('/housing');
    }
}
