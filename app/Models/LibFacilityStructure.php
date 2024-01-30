<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LibFacilityStructure extends Model
{
    use HasFactory;
    protected $fillable = [

        'facility',
        'library_id'

    ];
}
