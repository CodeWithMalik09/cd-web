<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoachingWorkingHours extends Model
{
    use HasFactory;
    protected $fillable = [
        'coaching_id',
        'weekdays',
        'from',
        'to'
    ];
}
