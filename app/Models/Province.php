<?php

namespace App\Models;
use AzisHapidin\IndoRegion\Traits\ProvinceTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{ use ProvinceTrait;
    protected $table = 'provinces';
}
