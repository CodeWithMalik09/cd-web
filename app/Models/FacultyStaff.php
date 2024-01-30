<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacultyStaff extends Model
{
    use HasFactory;

    protected $fillable = [
        'coaching_id',
        'name',
        'designation',
        'specialization_on',
        'university',
        'college',
        'experience_in_years',
        'job_type',
        'achivements',
        'remarks',
        'created_at',
        'updated_at'
    ];

    public function coaching(){
        return $this->hasOne(Coaching::class,'id','coaching_id');
    }
}
