<?php

namespace App\Models\etweet;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EtPostLike extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','post_id'];

    public function post(){
        return $this->belongsTo(EtPost::class,'post_id','id');
    }

    public function user(){
        return $this->belongsTo(User::class,'id','user_id');
    }

}
