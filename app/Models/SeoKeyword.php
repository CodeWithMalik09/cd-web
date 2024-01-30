<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeoKeyword extends Model
{
    use HasFactory;
    protected $fillable = [
        "category",
        "course",
        "city",
        "key1",
        "key2",
        "title",
        "meta",
        "ogtitle",
        "ogdesc",
        "ogtype",
        "ogurl",
        "canonical",
        "key3"
    ];
}
