<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

     protected $fillable = [
        
        'first_name',
        'last_name',
        'date_of_birth',
        'gender',
        'email',
        'phone_number',
        'address',
        'registration_id',
        'date_of_joining',
        'membership_status',
        'rank_grade',
        'notes',
        'photo',
    ];

    public function emergencyContacts()
    {
        return $this->hasMany(EmergencyContact::class);
    }
}
