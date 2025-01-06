<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Division;
use Illuminate\Http\Request;

class DivisionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $divisions = Division::with('districts')->get();
        return view('divisions.index',['divisions'=>$divisions]);
    }

    /*API Start*/
    public function getDivisions(Request $request){
        $divisions = Division::with([
            'districts' => function ($query) {
                $query->select('id', 'name','name_bn', 'division_id')->with([
                    'upazilas' => function ($subQuery) {
                        $subQuery->select('id', 'name','name_bn', 'district_id');
                    }
                ]);
            }
        ])->select('id', 'name','name_bn')->get();
        return $this->returnSuccess('List of Divisions',$divisions);
    }
    /*API End*/

}
