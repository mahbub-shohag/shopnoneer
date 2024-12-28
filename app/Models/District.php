<?php

namespace App\Models;

use Enigma\ValidatorTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use ValidatorTrait;
    use HasFactory;

    public function upazilas()
    {
        return $this->hasMany(Upazila::class); // Ensure the correct model is referenced
    }

    public function division()
    {
        return $this->belongsTo(Division::class); // Ensure the correct foreign key
    }

    public static function boot()
    {
        parent::boot();

        // Add this method for validating the current model on model saving event
        static::validateOnSaving();
    }

    public $validationRules = [
        'name' => 'required|max:250',
        'code' => 'required|max:250',
    ];

    public $validationMessages = [
        'name.required' => 'District name is required.',
        'email.required' => 'District code is required.',
    ];

    public $validationAttributes = [
        'name' => 'District Name'
    ];

    /**
     * Code to be executed before the validation goes here.
     */
    public function beforeValidation()
    {
        // Some code goes here..
    }

    /**
     * Code to be executed after the validation goes here.
     */
    public function afterValidation()
    {
        // Some code goes here..
    }
}
