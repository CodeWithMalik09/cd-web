<?php

namespace App\Models\etweet;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EtNotification extends Model
{
    use HasFactory;

    protected $fillable = ['to','user_id','title','content','image','updated_at'];

    public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }
}
