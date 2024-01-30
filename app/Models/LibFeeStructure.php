<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LibFeeStructure extends Model
{
    use HasFactory;
    protected $fillable = [

        'library_id',
        'lib_shift',
        'lib_timing',
        'lib_monthly_fee',
        'created_at',
        'updated_at'
    ];
    public function library(){
        return $this->hasOne(Library::class,'id','library_id');
    }
}
