<?php

namespace App\Models\etweet;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EtPostReply extends Model
{
    use HasFactory;

    protected $fillable = ['post_id','user_id','content','likes','dislikes','updated_at'];

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function post(){
        return $this->belongsTo(EtPost::class,'post_id','id');
    }
}
