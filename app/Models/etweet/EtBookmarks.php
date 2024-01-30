<?php

namespace App\Models\etweet;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EtBookmarks extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','post_id'];
}
