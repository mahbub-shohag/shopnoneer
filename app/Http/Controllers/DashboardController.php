<?php

namespace App\Http\Controllers;

use App\Models\Amenity;
use App\Models\Category;
use App\Models\Facility;
use App\Models\Housing;
use App\Models\Project;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalHousingCovered = Housing::count();
        $totalFacility = Facility::count();
        $totalProject = Project::count();
        $totalAmenity = Amenity::count();

        return view('dashboard', compact('totalHousingCovered', 'totalFacility', 'totalProject', 'totalAmenity'));
    }
}
