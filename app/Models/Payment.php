<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'users_id',
		'order_id',
		'pay_url',
    ];

    protected $hidden = [

    ];
	
	public function user(){
        return $this->belongsTo( User::class, 'users_id', 'id');
    }
	
	public function relasi(){
        return $this->belongsTo(Transaction::class,'order_id', 'code');
    }
}
