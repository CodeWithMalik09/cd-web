<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LibraryStatistics extends Model
{
    use HasFactory;

    protected $fillable = [
        'library_id',
        'views',
        'likes',
        'dislikes',
        'enrollments',
        'shares',
        'compares',
        'average_rating',
        'updated_at'
    ];

    public function library()
    {
        return $this->belongsTo(Library::class, 'id', 'library_id');
    }
}

?>