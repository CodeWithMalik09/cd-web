<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentRegistrationDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'coaching_id',
        'category_id',
        'course_id',
        'user_id',

        'name',
        'dob',
        'gender',
        'category',
        'email',
        'mobile',

        'father_name',
        'occupation',
        'father_mobile',

        'address',
        'city',
        'state',
        'district',
        'pincode',

        'session',
        'centre',
        'batch_type',
        'exam',
        'stream',
        'batch',

        'qualification',
        'qualification_stream',
        'college_name',
        'passing_year',
        'marks',

        'photo',
        'signature',
        'id_proof',
        'verification_status'
    ];

    public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }

    public function coaching(){
        return $this->hasOne(Coaching::class,'id','coaching_id');
    }

    public function courseCategory(){
        return $this->hasOne(Category::class,'id','category_id');
    }

    public function course(){
        return $this->hasOne(Course::class,'id','course_id');
    }
}
