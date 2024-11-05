<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Project extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    public function upazila(){
        return $this->belongsTo(Upazila::class)->select(['id', 'name']);
    }

    public function division()
    {
        return $this->belongsTo(Division::class)->select(['id', 'name']);
    }
    public function district()
    {
        return $this->belongsTo(District::class)->select(['id', 'name']);
    }

    public function housing()
    {
        return $this->belongsTo(Housing::class)->select(['id', 'name']);
    }
}
