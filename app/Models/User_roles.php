<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_roles extends Model
{
    use HasFactory;

    protected $table = 'user_roles';

    protected $fillable = [
        'role_id', 'user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function role(){
        return $this->belongsTo(Role::class);
    }
}
