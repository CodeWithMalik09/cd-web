<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewFeeStructure extends Model
{
    use HasFactory;

    protected $fillable = [
        'coaching_id',
        'course',
        'course_name',
        'stream',
        'admission_process',
        'batch_starting_date',
        'course_duration',
        'fees',
        'scholarship_discount',

        'created_at',
        'updated_at'
    ];

    public function newcoaching(){
        return $this->hasOne(Coaching::class,'id','coaching_id');
    }

    public function newcourse(){
        return $this->hasOne(Course::class,'id','course_id');
    }
}
