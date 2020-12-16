<?php

namespace App\Http\Controllers\Frontend;

use App\City;
use App\Http\Controllers\Controller;
use App\Province;
use Illuminate\Http\Request;

class ProvinceController extends Controller
{
    public function getAllProvince()
    {
        $Provinces = Province::all();
        $response = [
            'Provinces' =>  $Provinces
        ];
        return response()->json($Provinces,200);
    }

    public function getAllCities($province_id)
    {

        $cities  =  City::where('province_id' ,$province_id)->get();
        $response = [
            'cities' =>  $cities
        ];
        return response()->json($cities,200);
    }
}
