<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name', 'users_id', 'categories_id','quantities', 'price', 'description', 'slug', 'weight'
    ];

    protected $hidden = [

    ];

    public function galleries(){
        return $this->hasMany( ProductGallery::class, 'products_id', 'id' ); //related model Model, relasi ke mana, locall key
    }

    public function user(){
        return $this->hasOne( User::class, 'id', 'users_id');
    }

    public function category(){
        return $this->belongsTo( Category::class, 'categories_id', 'id');
    }
}
