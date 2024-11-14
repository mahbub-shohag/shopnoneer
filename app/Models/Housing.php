<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Housing extends Model
{
    use HasFactory;

//    public mixed $facilities;



    public function division()
    {
        return $this->belongsTo(Division::class);
    }
    public function district()
    {
        return $this->belongsTo(District::class);
    }
    public function upazila(){
        return $this->belongsTo(Upazila::class);
    }

    public function facilities()
    {
        return $this->belongsToMany(Facility::class, 'facility_housing', 'housing_id', 'facility_id');
    }
}
