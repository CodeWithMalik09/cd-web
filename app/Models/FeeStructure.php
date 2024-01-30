<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeeStructure extends Model
{
    use HasFactory;

    protected $fillable = [
        'coaching_id',
        'course_id',
        'course_name',
        'stream',
        'type',
        'admission_process',
        'batch_starting_date',
        'course_duration',
        'fees',
        'scholarship_discount',
        'remarks',
        'created_at',
        'updated_at'
    ];

    public function coaching(){
        return $this->hasOne(Coaching::class,'id','coaching_id');
    }

    public function course(){
        return $this->hasOne(Course::class,'id','course_id');
    }
}
