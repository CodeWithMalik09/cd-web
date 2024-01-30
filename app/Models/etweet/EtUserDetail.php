<?php

namespace App\Models\etweet;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EtUserDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'dob',
        'bio',
        'image',
        'thumbnail',
        'location',
        'website_link',
        'updated_at',
    ];
}
