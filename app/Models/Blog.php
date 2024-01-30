<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category',
        'course',
        'slug',
        'heading',
        'content',
        'thumbnail',
        'views',
        'job_last_date',
         'short_description',
         'blog_url',
          'title',
          'meta',
         'keywords',
        'updated_at',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
