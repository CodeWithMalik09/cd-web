<?php

namespace App\Models\etweet;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EtPost extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','stats_id','content','image','video','visibility','enabled','updated_at'];

    public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }

    public function stats(){
        return $this->hasOne(EtPostStats::class,'id','stats_id');
    }

    public function likes(){
        return $this->hasMany(EtPostLike::class,'post_id','id');
    }

    public function reports(){
        return $this->hasMany(EtPostReport::class,'post_id','id');
    }

    public function reposts(){
        return $this->hasMany(EtPostRepost::class,'post_id','id');
    }

    public function comments(){
        return $this->hasMany(EtPostReply::class,'post_id','id');
    }
}
