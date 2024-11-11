<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function district()
    {
        return $this->belongsTo(District::class);
    }
    public function division()
    {
        return $this->belongsTo(Division::class);
    }
    public function upazila(){
        return $this->belongsTo(Upazila::class);
    }

    public function housings()
    {
        return $this->belongsToMany(Housing::class, 'facility_housing', 'facility_id', 'housing_id');
    }

}
