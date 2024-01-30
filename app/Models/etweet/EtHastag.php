<?php

namespace App\Models\etweet;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EtHastag extends Model
{
    use HasFactory;

    protected $fillable = ['tag','hits','updated_at'];
}
