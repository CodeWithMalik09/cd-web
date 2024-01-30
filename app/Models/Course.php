<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['id','name','slug','description','icon','updated_at'];

    // public function coachings(){
    //     $coachings = array();
    //     return $this->id;
    // }
}
