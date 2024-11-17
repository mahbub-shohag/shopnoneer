<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amenity extends Model
{
    use HasFactory;
    public function projects()
    {
        return $this->belongsToMany(Project::class, 'amenity_project', 'amenity_id', 'project_id');
    }
}
