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
    public function show(Division $division)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Division $division)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Division $division)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Division $division)
    {
        //
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
