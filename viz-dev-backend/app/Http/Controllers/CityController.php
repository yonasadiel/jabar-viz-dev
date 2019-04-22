<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public static function index(Request $request) {
        return response(City::all(), 200);
    }
}
