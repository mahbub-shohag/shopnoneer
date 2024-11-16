<?php

namespace App\Http\Controllers;

use App\Models\Amenity;
use Illuminate\Http\Request;

class AmenityController extends Controller
{
    public function index()
    {
        $amenities = Amenity::orderByDesc('updated_at')->get();
        return view('amenities.index', ['amenities' => $amenities]);
    }
    public function show(Amenity $amenity)
    {
        return view('amenities.show', ['amenity' => $amenity]);
    }


    public function create()
    {
        return view('amenities.create');
    }

    public function store(Request $request)
    {
        try {
            $amenity = new Amenity();
            $amenity->name = $request->name;
            $amenity->android_icon = $request->android_icon;
            $amenity->ios_icon = $request->ios_icon;
            $amenity->web_icon = $request->web_icon;
            $amenity->save();

            return redirect('/amenity')->with('success', 'Amenity created successfully.');
        } catch (\Exception $e) {
            return redirect('/amenity/create')->with($e->getMessage());

        }
    }


    public function edit(Amenity $amenity)
    {
        return view('amenities.edit', ['amenity' => $amenity]);
    }

    public function update(Request $request, Amenity $amenity)
    {
        try {
            $amenity->name = $request->name;
            $amenity->android_icon = $request->android_icon;
            $amenity->ios_icon = $request->ios_icon;
            $amenity->web_icon = $request->web_icon;
            $amenity->save();

            return redirect('/amenity')->with('success', 'Amenity updated successfully.');
        } catch (\Exception $e) {
            return redirect('/amenity/edit', $amenity->id)->with('error', $e->getMessage());
        }
    }

    public function destroy(Amenity $amenity)
    {
        try {
            $amenity->delete(); // Delete the amenity from the database
            return redirect('amenity')->with('error', 'Amenity deleted successfully.');
        } catch (\Exception $e) {
            return redirect('amenity')->with('warning', $e->getMessage());
        }


    }
}
