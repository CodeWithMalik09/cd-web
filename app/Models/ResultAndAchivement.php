<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResultAndAchivement extends Model
{
    use HasFactory;

    protected $fillable = [
        'coaching_id',
        'course_id',
        'data_type',
        'exam_year',
        'type',
        'stream',
        'student_name',
        'rank',
        'percentage',
        'selected_in_pt',
        'selected_in_mains',
        'selected_in_final',
        'selected_in_top_ten',
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
