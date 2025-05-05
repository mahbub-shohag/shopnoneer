<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserVerification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'email',
        'verification_code',
        'expired_at',
    ];

    // Define relation with User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
