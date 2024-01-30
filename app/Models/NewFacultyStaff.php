<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewFacultyStaff extends Model
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
        'created_at',
        'updated_at'
    ];

    public function newcoaching(){
        return $this->hasOne(Coaching::class,'id','coaching_id');
    }
}
