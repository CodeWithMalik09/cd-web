<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Locality extends Model
{
    use HasFactory;

    protected $fillable = ['name','city','updated_at'];
    protected $table = 'localities';

    public function cityName()
    {
        return $this->hasOne(OperationArea::class, 'id', 'city');
    }
}
