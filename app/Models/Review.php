<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'coaching_id',
        'section',
        'review',
        'stars_faculties',
        'stars_fees', 
        'stars_study_materials', 
        'stars_results',
        'overall_rating', 
        'image', 
        'likes', 
        'dislikes'
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
