<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewResult extends Model
{
    use HasFactory;
    protected $fillable = [
    'coaching_id',
    'course',
    'exam_year',
    'stream',
    'selected_pt_students',
    'selected_mains_students',
    'selected_final_students',

];
}
