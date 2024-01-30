<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tutor extends Model
{
    use HasFactory;

    protected $fillable = [
        'course',
        'name',
        'slug',
        'dob',
        'gender',
        'email',
        'phone',
        'alternate_phone',
        'present_address',
        'qualification_details',
        'city',
        'teaching_experience',
        'tandc',
        'thumbnail',
        'gallery',
        'aadhaar_front',
        'aadhaar_back',
        'fee_per_month',
        'fee_per_hour',
        'board',
        'specialization',
        'subjects',
        'free_demo_class',
        'password',
        'about',
        'updated_at',
        'status'
    ];

    public function courseName(){
        return $this->hasOne(TutorCourse::class,'id','course');
    }

    public function cityrel(){
        return $this->hasOne(OperationArea::class,'id','city');
    }
}
