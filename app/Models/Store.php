<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;
    // protected $table = 'stores';

    protected $fillable = [
        'store_name',
        'categories_id',
        'store_status',
        'id_card',
        'file',
        'type',
        'user_id',
        'bank',
        'no_rek',
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function category(){
        return $this->belongsTo(Category::class,'categories_id','id');
    }

    public function store_status(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    
}
