<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Enigma\ValidatorTrait;
class Division extends Model
{
    use ValidatorTrait;
    use HasFactory;

    public function districts(){
        return $this->hasMany(District::class);
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
        'name.required' => 'Division name is required.',
        'email.required' => 'Division code is required.',
    ];

    public $validationAttributes = [
        'name' => 'Division Name'
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
