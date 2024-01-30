<?php

namespace App\Models\etweet;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EtFollower extends Model
{
    use HasFactory;

    protected $fillable = ['follower_id','following_id'];

    public function followingUser(){
        return $this->hasOne(User::class,'id','following_id');
    }

    public function followerUser(){
        return $this->hasOne(User::class,'id','following_id');
    }
}
