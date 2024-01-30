<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewAchievement extends Model
{
    use HasFactory;
    protected $fillable = [
        'coaching_id',
        'course',
        'type',
        'exam_year',
        'stream',
        'student_name',
        'Rank',
        'Score',

    ];
}
