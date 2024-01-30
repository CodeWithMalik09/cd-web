<?php

namespace App\Models\etweet;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EtPostStats extends Model
{
    use HasFactory;

    protected $fillable = ['post_id','views','shares','updated_at'];

    public function post(){
        return $this->belongsTo(EtPost::class,'id','post_id');
    }
}
