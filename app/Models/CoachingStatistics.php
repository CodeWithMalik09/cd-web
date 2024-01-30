<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoachingStatistics extends Model
{
    use HasFactory;

    protected $fillable = [
        'coaching_id',
        'views',
        'likes',
        'dislikes',
        'enrollments',
        'shares',
        'compares',
        'average_rating',
        'updated_at'
    ];

    public function coaching()
    {
        return $this->belongsTo(Coaching::class, 'id', 'coaching_id');
    }
}

?>