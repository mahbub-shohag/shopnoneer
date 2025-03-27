<?php

namespace App\Http\Controllers;

use App\DTOs\ProjectListDTO;
use App\Models\Project;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function getNotificationList(Request $request){
        $oneWeekAgo = Carbon::now()->subWeek();
        $projects = Project::with('media', 'division', 'district', 'upazila', 'housing')
            ->where('is_active', 1)
            ->whereBetween('created_at', [$oneWeekAgo, Carbon::now()]) // Filter projects within the last week
            ->orderByDesc('created_at')
            ->get();
        $projectDtos = $projects->map(fn($project) => ProjectListDTO::fromModel($project))->toArray();
        return $this->returnSuccess("Notification List", $projectDtos);
    }
}
