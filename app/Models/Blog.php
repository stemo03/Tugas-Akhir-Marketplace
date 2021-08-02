<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'name', 'photo', 'slug', 'blog_url','desc'
    ];

    protected $hidden = [

    ];
}
