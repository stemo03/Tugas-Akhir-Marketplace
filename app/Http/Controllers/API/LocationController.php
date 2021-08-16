<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Province;
use App\Models\City;
use Kavist\RajaOngkir\Facades\RajaOngkir;
class LocationController extends Controller
{

    public function getCities($id) 
    {
        $city = City::where('province_id', $id)->pluck('title', 'city_id');
        return json_encode($city); 

    }

    




}
