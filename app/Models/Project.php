<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory;

    public function medias(): HasMany
    {
        return $this->hasMany(Media::class);
    }

    public function upazila(){
        return $this->belongsTo(Upazila::class);
    }

    public function division()
    {
        return $this->belongsTo(Division::class);
    }
    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function housing()
    {
        return $this->belongsTo(Housing::class);
    }
}
