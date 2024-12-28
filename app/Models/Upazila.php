<?php

namespace App\Models;

use Enigma\ValidatorTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upazila extends Model
{
    use ValidatorTrait;
    use HasFactory;

    public function district(){
        return $this->belongsTo(District::class, 'district_id');
    }

    public function unions(){
        return $this->hasMany(Union::class);
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
        'name.required' => 'Upazilla name is required.',
        'email.required' => 'Upazilla code is required.',
    ];

    public $validationAttributes = [
        'name' => 'Upazilla Name'
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
